<template>
  <div class="flex mt-8 ml-16 flex-col">
    <h1 class="text-3xl leading-9 font-semibold font-golos">Онлайн чат</h1>

    <Button class="w-[75px] h-6 flex flex-wrap mb-6" @click="goBack" variant="link"
      >На главную</Button
    >

    <div class="flex gap-4 mt-4 mr-14 min-h-[400px] max-h-[460px] flex-1">
      <!-- Левая панель -->
      <div v-if="filteredOnlineChats.length" class="w-1/4 bg-gray-100 p-4 rounded-lg shadow-md">
        <SideBarChat
          v-for="doctor in filteredOnlineChats"
          :key="doctor.chatId"
          :id="doctor.chatId"
          :patientUsername="doctor.patientUsername"
          :doctorUsername="doctor.doctorUsername"
          :statusChat="doctor.statusChat"
          :patientId="doctor.patientId"
          :doctorId="doctor.doctorId"
        />
      </div>

      <!-- Основная часть чата -->
      <div class="flex-1 bg-white p-4 rounded-lg border shadow-md flex flex-col">
        <div ref="chatContainer" class="flex-1 overflow-y-auto mb-4 max-h-[100vh]">
          <MainBarChat :messages="messages" />
        </div>

        <!-- Ввод сообщения -->
        <!-- Ввод сообщения -->
        <div class="flex items-center border-t pt-4 mt-4 gap-2">
          <button
            @click="closeChat"
            class="p-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
          >
            Завершить чат
          </button>
          <input
            v-model="newMessage"
            type="text"
            class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500"
            placeholder="Введите сообщение"
            @keyup.enter="sendMessage"
          />
          <input
            type="file"
            ref="fileInput"
            class="hidden"
            accept="image/*"
            @change="handleFileUpload"
          />
          <button @click="triggerFileInput" class="p-2 hover:bg-gray-200 rounded-2xl border">
            <Camera />
          </button>
          <button
            @click="sendImage"
            v-if="imagePreview"
            class="p-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600"
          >
            Отправить изображение
          </button>
          <button
            @click="sendMessage"
            class="p-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600"
          >
            Отправить
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount, nextTick, computed, watch } from 'vue'
import SideBarChat from '@/components/chat-components/SideBarChat.vue'
import MainBarChat from '@/components/chat-components/MainBarChat.vue'
import { useAuthStore } from '@/stores/authStore'
import io from 'socket.io-client'
import { useRoute, useRouter } from 'vue-router'
import { Camera } from 'lucide-vue-next'
import Button from '@/components/ui/button/Button.vue'
import { useDoctorStore } from '@/stores/doctorStore'
import { useChat } from '@/composables/chat/useChat'

const { closeChatAPI, getChatListPacient, getChatListDoctor } = useChat()
const doctorStore = useDoctorStore()

const filteredOnlineChats = computed(() =>
  doctorStore.doctorChatList.filter((item) => item.statusChat === true),
)

const route = useRoute()
const router = useRouter()
const authStore = useAuthStore()
const socket = io('http://localhost:5000')

const goBack = () => router.push('/')

// Данные чата
const chatId = ref(route.params.idChat)
// const statusChat = route.query.statusChat
const doctorUsername = route.query.doctorUsername || ''
const patientUsername = route.query.patientUsername || ''
const patientId = route.query.patientId ? Number(route.query.patientId) : null
const doctorId = route.query.doctorId ? Number(route.query.doctorId) : null

// Определяем, кто текущий пользователь
const isDoctor = computed(() => authStore.doctorId && authStore.doctorId === doctorId)
const isPatient = computed(() => authStore.patientId && authStore.patientId === patientId)

// Проверка, правильно ли определилась роль
console.log('isDoctor:', isDoctor.value)
console.log('isPatient:', isPatient.value)

// Определяем текущего пользователя и собеседника
const username = computed(() => (isDoctor.value ? doctorUsername : patientUsername))
const receiver = computed(() => (isDoctor.value ? patientUsername : doctorUsername))

const messages = ref([])
const newMessage = ref('')
const fileInput = ref(null)
const chatContainer = ref(null)

const closeChat = async () => {
  const isConfirmed = confirm('Вы уверены, что хотите завершить чат?')

  try {
    if (isConfirmed) {
      await closeChatAPI({ chatId: chatId.value })

      await Promise.all([
        authStore.patientId
          ? getChatListPacient(authStore.patientId)
          : getChatListDoctor(authStore.doctorId),
      ])
      router.push('/')
    } else {
      console.log('Чат не был завершен.')
    }
  } catch (error) {
    console.error('Ошибка при завершении чата:', error)
  }
}

// Подключение к WebSocket
socket.on('connect', () => {
  console.log('Подключено к WebSocket серверу')
  if (!username.value) return
  socket.emit('login', { username: username.value })
  socket.emit('join_chat', { chat_id: chatId.value, receiver: receiver.value })
})

watch(
  () => route.params.idChat,
  (newId) => {
    chatId.value = newId
    messages.value = [] // Очистка сообщений при смене чата
    socket.emit('join_chat', { chat_id: newId, receiver: receiver.value }) // Переподключаемся к новому чату
  },
)

socket.on('chat_history', (data) => {
  console.log('Получена история:', data) // Проверка данных
  messages.value = data.history.map((msg) => ({
    text: msg.message,
    imageUrl: msg.image || null,
    isSentByUser: msg.username === username.value,
    senderName: msg.username === doctorUsername ? doctorUsername : patientUsername, // Отображаем ФИО
    timestamp: msg.timestamp || new Date().toISOString(), // Время отправки
  }))
  scrollToBottom()
})

// Обработка входящих сообщений
socket.on('message', (data) => {
  console.log('Получено сообщение:', data) // Проверка данных
  const newMessage = {
    text: data.message,
    imageUrl: data.image || null, // Используем только данные из сокета
    isSentByUser: data.username === username.value,
    senderName: data.username === doctorUsername ? doctorUsername : patientUsername,
    timestamp: data.timestamp || new Date().toISOString(),
  }

  messages.value.push(newMessage) // Добавляем только сообщения от сокета
  scrollToBottom()
})

// Прокрутка вниз при новых сообщениях
const scrollToBottom = () => {
  nextTick(() => {
    if (chatContainer.value) {
      chatContainer.value.scrollTop = chatContainer.value.scrollHeight
    }
  })
}

// Отправка текстового сообщения
const sendMessage = () => {
  if (!newMessage.value.trim()) return

  const messageData = {
    chat_id: chatId.value,
    message: newMessage.value,
    username: username.value,
    receiver: receiver.value,
    timestamp: new Date().toISOString(), // Добавляем время отправки
  }

  socket.emit('message', messageData)
  console.log('Отправляемое сообщение:', messageData)
  newMessage.value = ''
}

// Отправка изображения
const triggerFileInput = () => {
  fileInput.value.click()
}

const imagePreview = ref(null)

// Обработчик загрузки файла
const handleFileUpload = (event) => {
  const file = event.target.files[0]
  if (!file) return

  const reader = new FileReader()
  reader.onload = (e) => {
    imagePreview.value = e.target.result
  }
  reader.readAsDataURL(file)
}

// Отправка изображения
const sendImage = () => {
  if (!imagePreview.value) return

  const imageData = {
    chat_id: chatId,
    image: imagePreview.value,
    username: username.value,
    receiver: receiver.value,
    timestamp: new Date().toISOString(),
  }

  socket.emit('message', imageData)

  // Очистка превью после отправки
  imagePreview.value = null
}

onMounted(scrollToBottom)

// Отключение WebSocket при выходе из компонента
onBeforeUnmount(() => {
  socket.disconnect()
})
</script>

<style scoped></style>
