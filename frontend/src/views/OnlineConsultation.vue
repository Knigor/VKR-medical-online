<template>
  <div class="flex flex-col ml-24 mt-[32px] mr-24">
    <Button class="w-[50px] h-6 flex flex-wrap mb-6" @click="goBack" variant="link">Назад</Button>
    <div>
      <h1 class="font-golos text-2xl font-bold leading-8">Список врачей</h1>
      <div
        v-if="isPending"
        role="status"
        class="space-y-8 pr-4 mt-6 animate-pulse md:space-y-0 md:space-x-8 rtl:space-x-reverse md:flex md:items-center"
      >
        <div
          class="flex items-center justify-center w-full h-48 bg-gray-300 rounded-sm sm:w-96 dark:bg-gray-700"
        >
          <svg
            class="w-10 h-10 text-gray-200 dark:text-gray-600"
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
          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[480px] mb-2.5"></div>
          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 mb-2.5"></div>
          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[440px] mb-2.5"></div>
          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[460px] mb-2.5"></div>
          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[360px]"></div>
        </div>
        <span class="sr-only">Loading...</span>
      </div>
      <ScrollArea v-else class="h-[600px] max-w-[980px] p-4">
        <CardsDoctorsOnline
          v-for="doctor in doctorStore.doctorList"
          :id="doctor.doctorId"
          :name="doctor.data.fullName"
          :specialization="doctor.nameSpecialization"
          :total-count="doctor.totalCount"
          :key="doctor.data.doctorId"
          :rating="doctor.rating"
          :experience="doctor.data.experience"
          :education="doctor.data.education"
          :qualification="doctor.data.qualification"
          :completeConsultations="doctor.data.complete_consultation"
          :time-schedule="doctor.data.schedule"
          :photo="doctor.data.photo_user"
          :schedule="doctor.data.schedule"
        />
      </ScrollArea>
    </div>
  </div>
</template>

<script setup>
import Button from '@/components/ui/button/Button.vue'
import { ScrollArea } from '@/components/ui/scroll-area'
import CardsDoctorsOnline from '@/components/online-consultation/CardsDoctorsOnline.vue'
import { onMounted, ref } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useDoctorStore } from '@/stores/doctorStore'
import { useDoctor } from '@/composables/doctor/useDoctor'

const doctorStore = useDoctorStore()
const router = useRouter()
const route = useRoute()
const { getDoctorList } = useDoctor()

const goBack = () => {
  router.push('/')
}

const isPending = ref(false)

onMounted(async () => {
  try {
    isPending.value = true
    await getDoctorList(route.params.id)
  } catch (error) {
    console.error('Ошибка при загрузке данных:', error)
  } finally {
    isPending.value = false
  }
})
</script>

<style lang="scss" scoped></style>
