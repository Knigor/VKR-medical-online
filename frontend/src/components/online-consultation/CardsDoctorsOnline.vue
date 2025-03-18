<template>
  <div
    class="flex items-center justify-between border-gray-300 mt-6 group border-[1px] rounded-[8px] pr-4 sm:pr-6 lg:pr-8 mr-2"
  >
    <div v-if="!isSkeleton" @click="goToDoctor" class="flex items-center cursor-pointer">
      <Avatar class="h-[60px] w-[60px] sm:h-[70px] sm:w-[70px] lg:h-[70px] lg:w-[70px] ml-6">
        <AvatarImage :src="avatarSrc" alt="@radix-vue" />
        <AvatarFallback>CN</AvatarFallback>
      </Avatar>
      <div class="flex flex-col mt-4 sm:mt-6 lg:mt-[32px] ml-4 sm:ml-6 lg:ml-[20px]">
        <p
          class="sm:mt-3 lg:mt-[6px] text-gray-500 font-golos text-sm sm:text-base lg:text-base leading-5 sm:leading-6 font-normal"
        >
          {{ specialization }}
        </p>
        <h2
          class="font-golos text-lg sm:text-xl lg:text-2xl leading-6 sm:leading-7 lg:leading-8 font-semibold"
        >
          {{ name }}
        </h2>
        <div class="flex flex-wrap">
          <p
            class="mt-2 ml-1 sm:mt-3 lg:mt-[6px] mb-4 sm:mb-6 lg:mb-[21px] text-gray-500 font-golos text-sm sm:text-base lg:text-base leading-5 sm:leading-6 font-normal"
          >
            {{ completeConsultations }} консультаций
          </p>
        </div>
      </div>
    </div>

    <div
      v-else
      role="status"
      class="space-y-8 animate-pulse md:space-y-0 md:space-x-8 rtl:space-x-reverse md:flex md:items-center"
    >
      <div
        class="flex items-center justify-center w-full h-48 bg-gray-300 rounded-sm sm:w-96 dark:bg-gray-700"
      >
        <svg
          class="w-2 h-2 text-gray-200 dark:text-gray-600"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="currentColor"
          viewBox="0 0 20 18"
        >
          <path
            d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z"
          />
        </svg>
      </div>
      <div class="w-full">
        <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-48 mb-4"></div>
        <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-48 mb-4"></div>
        <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-48 mb-4"></div>
        <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[180px] mb-2.5"></div>
      </div>
    </div>

    <SendConsultation
      :statusChat="statusChat"
      :schedule="schedule"
      :name="name"
      :specialization="specialization"
      :doctorId="id"
      :chatId="chatId"
    />
  </div>
</template>

<script setup>
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'
import { useRouter, useRoute } from 'vue-router'
import SendConsultation from './SendConsultation.vue'
import { computed, ref } from 'vue'
import { useDoctor } from '@/composables/doctor/useDoctor'

// import { usePersonalDoctorStore } from '@/stores/personalDoctor'

const isSkeleton = ref(false)

const router = useRouter()

const route = useRoute()

const props = defineProps({
  id: Number,
  name: String,
  specialization: String,
  rating: Number,
  experience: Number,
  education: String,
  qualification: String,
  completeConsultations: Number,
  timeSchedule: Array,
  totalCount: Number,
  photo: String,
  schedule: Array,
  statusChat: Boolean,
  chatId: Number,
})

const avatarSrc = computed(() => {
  return import.meta.env.VITE_BASE_URL + props.photo
})
const { getDoctorPersonalOnline } = useDoctor()
// const doctorStore = usePersonalDoctorStore()

const goToDoctor = async () => {
  isSkeleton.value = true
  try {
    await getDoctorPersonalOnline(props.id)
    router.push({ name: 'doctorPersonal', params: { id: route.params.id, idPersonal: props.id } })
  } catch (error) {
    console.error('Ошибка при загрузке данных:', error)
  } finally {
    isSkeleton.value = false
  }
}
</script>

<style scoped></style>
