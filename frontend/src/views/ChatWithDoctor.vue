<template>
  <div class="flex mt-8 ml-16 flex-col">
    <h1 class="text-3xl leading-9 font-semibold font-golos">Онлайн чат</h1>
    <div class="flex gap-4 mt-4 mr-14 min-h-[400px] max-h-[460px] flex-1">
      <!-- Левая панель для пользователей -->
      <div class="w-1/4 bg-gray-100 p-4 rounded-lg shadow-md">
        <SideBarChat />
      </div>

      <!-- Основная часть чата -->
      <div class="flex-1 bg-white p-4 rounded-lg border shadow-md flex flex-col">
        <!-- Сообщения с прокруткой -->
        <div ref="chatContainer" class="flex-1 overflow-y-auto mb-4 max-h-[100vh]">
          <MainBarChat :messages="messages" />
        </div>

        <!-- Ввод сообщения -->
        <div class="flex items-center border-t pt-4 mt-4 gap-2">
          <input
            v-model="newMessage"
            type="text"
            class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
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
          <button
            @click="triggerFileInput"
            class="p-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400"
          >
            📷
          </button>
          <button
            @click="sendMessage"
            class="p-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
          >
            Отправить
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, nextTick } from 'vue'
import SideBarChat from '@/components/chat-components/SideBarChat.vue'
import MainBarChat from '@/components/chat-components/MainBarChat.vue'

const messages = ref([
  { id: 1, text: 'Привет!', isSentByUser: true, type: 'text' },
  { id: 2, text: 'Здравствуйте, как дела?', isSentByUser: false, type: 'text' },
])

const newMessage = ref('')
const fileInput = ref(null)
const chatContainer = ref(null)

const scrollToBottom = () => {
  nextTick(() => {
    if (chatContainer.value) {
      chatContainer.value.scrollTop = chatContainer.value.scrollHeight
    }
  })
}

const sendMessage = () => {
  if (newMessage.value.trim()) {
    messages.value.push({
      id: Date.now(),
      text: newMessage.value,
      isSentByUser: true,
      type: 'text',
    })
    newMessage.value = ''
    scrollToBottom()
  }
}

const triggerFileInput = () => {
  fileInput.value.click()
}

const handleFileUpload = (event) => {
  const file = event.target.files[0]
  if (file) {
    const reader = new FileReader()
    reader.onload = (e) => {
      messages.value.push({
        id: Date.now(),
        imageUrl: e.target.result,
        isSentByUser: true,
        type: 'image',
      })
      scrollToBottom()
    }
    reader.readAsDataURL(file)
  }
}

onMounted(scrollToBottom)
</script>

<style scoped></style>
