<template>
  <div class="p-6 max-w-7xl mx-auto">
    <Button @click="goBack" class="mb-4 bg-pink-400">Назад</Button>

    <div class="bg-white shadow rounded-lg p-4">
      <h2 class="text-xl font-bold flex items-end gap-2">
        Специализация
        <CircleHelp
          @click="openModal"
          class="cursor-pointer"
          color="#f87171"
          width="24"
          stroke-width="1.5"
        />
      </h2>
      <NotificationDoctor :is-open="isOpen" @closeModal="closeModal" />
      <textarea
        v-model="specialization"
        class="w-full border rounded p-2 mt-2 outline-pink-400"
        placeholder="Введите специализацию..."
      ></textarea>
      <Button @click="saveSpecialization" class="mt-2 bg-pink-400 text-white px-4 py-2 rounded"
        >Сохранить</Button
      >
    </div>

    <div class="bg-white shadow rounded-lg p-4">
      <h2 class="text-xl font-bold">Биография</h2>
      <textarea
        v-model="bio"
        class="w-full border rounded p-2 mt-2 outline-pink-400"
        placeholder="Введите квалификацию..."
      ></textarea>
      <Button @click="saveBio" class="mt-2 bg-pink-400 text-white px-4 py-2 rounded"
        >Сохранить</Button
      >
    </div>

    <div class="bg-white shadow rounded-lg p-4">
      <h2 class="text-xl font-bold">Опыт работы</h2>
      <Input
        v-model="experience"
        class="w-full border rounded p-2 mt-2"
        placeholder="Введите ваш опыт работы"
      ></Input>
      <Button @click="saveExperience" class="mt-2 bg-pink-400 text-white px-4 py-2 rounded"
        >Сохранить</Button
      >
    </div>

    <div class="bg-white shadow rounded-lg p-4">
      <h2 class="text-xl font-bold">Квалификация</h2>
      <textarea
        v-model="qualification"
        class="w-full border rounded p-2 mt-2 outline-pink-400"
        placeholder="Введите квалификацию..."
      ></textarea>
      <Button @click="saveQualification" class="mt-2 bg-pink-400 text-white px-4 py-2 rounded"
        >Сохранить</Button
      >
    </div>

    <div class="bg-white shadow rounded-lg p-4 mt-4">
      <h2 class="text-xl font-bold">Образование</h2>
      <textarea
        v-model="education"
        class="w-full border rounded p-2 mt-2 outline-pink-400"
        placeholder="Введите образование..."
      ></textarea>
      <Button @click="saveEducation" class="mt-2 bg-pink-400 text-white px-4 py-2 rounded"
        >Сохранить</Button
      >
    </div>

    <div class="flex gap-4">
      <div class="bg-white shadow rounded-lg p-4 mt-4 flex-1">
        <h2 class="text-xl font-bold">Запись на приём</h2>

        <input v-model="selectedDate" type="date" class="border rounded p-2 w-full mt-2" />

        <div class="flex flex-wrap gap-2 mt-2">
          <Button
            v-for="time in times"
            :key="time"
            @click="toggleTime(time)"
            :class="{
              'bg-blue-500 text-white': selectedTimes.includes(time),
              'bg-gray-200 text-black': !selectedTimes.includes(time),
            }"
            class="px-4 py-2 rounded hover:text-white"
          >
            {{ time }}
          </Button>
        </div>

        <div class="flex gap-2 mt-4">
          <input v-model="customTime" type="time" class="border rounded p-2 flex-1" />
          <Button
            @click="addCustomTime"
            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded"
            >Добавить</Button
          >
        </div>

        <div class="flex gap-2 mt-2">
          <Button
            @click="clearAppointments"
            class="bg-gray-500 hover:bg-gray-400 text-white px-4 py-2 rounded"
            >Очистить</Button
          >
          <Button @click="saveAppointments" class="bg-pink-400 text-white px-4 py-2 rounded"
            >Сохранить</Button
          >
          <Button
            @click="deleteAppointments"
            class="bg-red-500 hover:bg-red-400 text-white px-4 py-2 rounded"
            >Удалить все расписание</Button
          >
        </div>
      </div>

      <div class="bg-white shadow rounded-lg p-4 mt-4 flex-1">
        <h2 class="text-xl font-bold">Выбранные даты</h2>
        <ScheduleSkeleton v-if="isPending" />
        <div
          v-else
          v-for="appointment in dateConsultation"
          :key="appointment.day"
          class="border rounded p-4 mt-2"
        >
          <h3 class="font-bold">{{ appointment.day }}</h3>
          <div class="flex flex-wrap gap-2 mt-2">
            <span
              v-for="time in appointment.time"
              :key="time"
              class="bg-gray-200 px-3 py-1 rounded"
              >{{ time }}</span
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useRouter } from 'vue-router'
import Button from '@/components/ui/button/Button.vue'
import { useDoctorStore } from '@/stores/doctorStore'
import Input from '@/components/ui/input/Input.vue'
import { useDoctor } from '@/composables/doctor/useDoctor'
import { useAuthStore } from '@/stores/authStore'
import { useToast } from 'vue-toastification'
import ScheduleSkeleton from '@/components/skeleton/ScheduleSkeleton.vue'
import { CircleHelp } from 'lucide-vue-next'
import NotificationDoctor from '@/components/profile-med/NotificationDoctor.vue'

const toast = useToast()

const { setScheduleDoctor, deleteScheduleDoctor, getDoctorPersonal, editDoctorPersonal } =
  useDoctor()
const authStore = useAuthStore()
const doctorStore = useDoctorStore()
const router = useRouter()
const goBack = () => router.go(-1)

const specialization = ref(
  doctorStore.doctorDataPersonal?.specializations[0]?.nameSpecialization || [],
)
const qualification = ref(doctorStore.doctorDataPersonal.qualification)
const education = ref(doctorStore.doctorDataPersonal.education)
const experience = ref(doctorStore.doctorDataPersonal.experience)
const bio = ref(doctorStore.doctorDataPersonal.bio)

const selectedDate = ref('')
const selectedTimes = ref([])
const times = ref(['10:00', '13:00', '20:00'])
const customTime = ref('')

const isPending = ref(false)
// модалка
const isOpen = ref(false)

function openModal() {
  isOpen.value = true
}

function closeModal() {
  isOpen.value = false
}

const schedule = computed(() => doctorStore.doctorDataPersonal?.schedule || [])

// удаляем все расписание
const deleteAppointments = async () => {
  isPending.value = true
  try {
    await deleteScheduleDoctor({ doctorId: authStore.doctorId })
    await getDoctorPersonal()
    toast.success('Расписание успешно удалено')
  } catch (error) {
    console.error('Ошибка при удалении расписания:', error)
  } finally {
    isPending.value = false
  }
}

// Функция для группировки расписания по датам
const dateConsultation = computed(() => {
  return Object.entries(
    schedule.value.reduce((acc, item) => {
      const date = item.time_schedule.split(' ')[0] // Берём дату без времени
      if (!acc[date]) {
        acc[date] = []
      }
      acc[date].push(item.time_schedule.split(' ')[1]) // Добавляем время
      return acc
    }, {}),
  ).map(([date, times]) => ({
    day: new Date(date).toLocaleDateString('ru-RU', { day: '2-digit', month: 'long' }),
    time: times.sort(), // Сортируем времена по возрастанию
  }))
})

const toggleTime = (time) => {
  if (selectedTimes.value.includes(time)) {
    selectedTimes.value = selectedTimes.value.filter((t) => t !== time)
  } else {
    selectedTimes.value.push(time)
  }
}

const addCustomTime = () => {
  if (customTime.value && !times.value.includes(customTime.value)) {
    times.value.push(customTime.value)
    customTime.value = ''
  }
}

const clearAppointments = () => {
  selectedTimes.value = []
  selectedDate.value = ''
}

// сохраняем опыт работы
const saveExperience = async () => {
  const formData = new FormData()
  formData.append('doctorId', authStore.doctorId)
  formData.append('experience', experience.value)

  try {
    await editDoctorPersonal(formData)

    toast.success('Опыт успешно сохранен')
  } catch (error) {
    console.error('Ошибка при сохранении опыта:', error)
  }
}

// сохраняем образование

const saveEducation = async () => {
  const formData = new FormData()
  formData.append('doctorId', authStore.doctorId)
  formData.append('education', education.value)

  try {
    await editDoctorPersonal(formData)

    toast.success('Образование успешно сохранено')
  } catch (error) {
    console.error('Ошибка при сохранении образования:', error)
  }
}

// сохраняем квалификацию
const saveQualification = async () => {
  const formData = new FormData()
  formData.append('doctorId', authStore.doctorId)
  formData.append('qualification', qualification.value)

  try {
    await editDoctorPersonal(formData)

    toast.success('Квалификация успешно сохранена')
  } catch (error) {
    console.error('Ошибка при сохранении квалификации:', error)
  }
}

// сохраняем специализацию

const saveSpecialization = async () => {
  const formData = new FormData()
  formData.append('doctorId', authStore.doctorId)
  formData.append('specializationName', specialization.value)

  try {
    await editDoctorPersonal(formData)

    toast.success('Специализация успешно сохранена')
  } catch (error) {
    console.error('Ошибка при сохранении специализации:', error)
  }
}

// сохраняем биографию
const saveBio = async () => {
  const formData = new FormData()
  formData.append('doctorId', authStore.doctorId)
  formData.append('bio', bio.value)

  try {
    await editDoctorPersonal(formData)

    toast.success('Биография успешно сохранена')
  } catch (error) {
    console.error('Ошибка при сохранении биографии:', error)
  }
}

// отправляем дату
const saveAppointments = async () => {
  isPending.value = true

  if (!selectedDate.value) {
    console.log('Выберите дату')
    return
  }

  try {
    const formattedAppointments = selectedTimes.value.map((time) => {
      return `${selectedDate.value} ${time}` // Формат: YYYY-MM-DD HH:mm
    })

    console.log('Отправляемые данные:', {
      doctorId: authStore.doctorId,
      time_schedule: formattedAppointments,
    })

    await setScheduleDoctor({
      doctorId: authStore.doctorId,
      time_schedule: formattedAppointments,
    })

    await getDoctorPersonal()

    toast.success('Расписание успешно сохранено')
  } catch (error) {
    console.error('Ошибка при сохранении расписания:', error)
  } finally {
    isPending.value = false
  }
}
</script>

<style scoped>
.bg-white {
  background-color: #fff;
}
.shadow {
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
.rounded {
  border-radius: 8px;
}
.p-4 {
  padding: 1rem;
}
</style>
