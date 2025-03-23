<template>
  <div class="flex flex-col gap-2">
    <div
      @click="
        goToOnlineConsultation(id, statusChat, doctorUsername, patientUsername, patientId, doctorId)
      "
      class="flex items-center p-2 rounded-lg hover:bg-gray-200 cursor-pointer"
    >
      <div v-if="authStore.patientId !== null" class="flex items-center">
        <div class="w-10 h-10 bg-blue-300 rounded-full flex items-center justify-center text-white">
          {{ doctorUsername[0] }}
        </div>
        <div class="ml-4 text-sm font-medium">{{ doctorUsername }}</div>
      </div>
      <div v-else class="flex items-center">
        <div class="w-10 h-10 bg-blue-300 rounded-full flex items-center justify-center text-white">
          {{ patientUsername[0] }}
        </div>
        <div class="ml-4 text-sm font-medium">{{ patientUsername }}</div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useAuthStore } from '@/stores/authStore'
import { useRouter } from 'vue-router'

const router = useRouter()
const authStore = useAuthStore()

defineProps({
  patientUsername: String,
  doctorUsername: String,
  statusChat: Boolean,
  id: Number,
  patientId: Number,
  doctorId: Number,
})

const goToOnlineConsultation = (
  id,
  statusChat,
  doctorUsername,
  patientUsername,
  patientId,
  doctorId,
) => {
  router.push({
    path: `/chat/${id}`,
    query: {
      statusChat,
      doctorUsername,
      patientUsername,
      patientId,
      doctorId,
    },
  })
}

// const users = [
//   { id: 1, name: 'Иван' },
//   { id: 2, name: 'Мария' },
//   { id: 3, name: 'Алексей' },
//   { id: 4, name: 'Екатерина' },
// ]
</script>
