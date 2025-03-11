<template>
  <div class="flex flex-col ml-24 mt-[32px] mr-24">
    <Button class="w-[50px] h-6 flex flex-wrap mb-6" @click="goBack" variant="link">Назад</Button>
    <div class="flex flex-wrap gap-4">
      <div class="flex flex-col gap-4">
        <CardsMainDoctor
          :photo="doctorStore.doctorPersonalOnline?.photo_user"
          :complete-consultations="doctorStore.doctorPersonalOnline?.complete_consultation"
          :name="doctorStore.doctorPersonalOnline.fullName"
        />
        <ExperienceDoctor :qualification="doctorStore.doctorPersonalOnline.qualification" />
        <EducationDoctor />
      </div>
      <div>
        <SendOnlineConsultation />
      </div>
    </div>
    <!-- Скелетончики -->
    <!-- <div v-else class="flex flex-wrap gap-4">
      <div class="flex flex-col gap-4">
        <div role="status" class="max-w-sm animate-pulse">
          <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-48 mb-4"></div>
          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[360px] mb-2.5"></div>
          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 mb-2.5"></div>
          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[330px] mb-2.5"></div>
          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[300px] mb-2.5"></div>
          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[360px]"></div>
          <span class="sr-only">Loading...</span>
        </div>
        <div role="status" class="max-w-sm animate-pulse">
          <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-48 mb-4"></div>
          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[360px] mb-2.5"></div>
          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 mb-2.5"></div>
          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[330px] mb-2.5"></div>
          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[300px] mb-2.5"></div>
          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[360px]"></div>
          <span class="sr-only">Loading...</span>
        </div>
        <div role="status" class="max-w-sm animate-pulse">
          <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-48 mb-4"></div>
          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[360px] mb-2.5"></div>
          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 mb-2.5"></div>
          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[330px] mb-2.5"></div>
          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[300px] mb-2.5"></div>
          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[360px]"></div>
          <span class="sr-only">Loading...</span>
        </div>
      </div>
      <div>
        <div role="status" class="max-w-sm animate-pulse">
          <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-48 mb-4"></div>
          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[360px] mb-2.5"></div>
          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 mb-2.5"></div>
          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[330px] mb-2.5"></div>
          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[300px] mb-2.5"></div>
          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[360px]"></div>
          <span class="sr-only">Loading...</span>
        </div>
      </div>
    </div> -->
  </div>
</template>

<script setup>
import CardsMainDoctor from '@/components/personal-doctor/CardsMainDoctor.vue'
import Button from '@/components/ui/button/Button.vue'
import { useRouter, useRoute } from 'vue-router'
import ExperienceDoctor from '@/components/personal-doctor/ExperienceDoctor.vue'
import EducationDoctor from '@/components/personal-doctor/EducationDoctor.vue'
import SendOnlineConsultation from '@/components/personal-doctor/SendOnlineConsultation.vue'
import { useDoctorStore } from '@/stores/doctorStore'
import { useDoctor } from '@/composables/doctor/useDoctor'

const doctorStore = useDoctorStore()

// const isPending = ref(false)
// const route = useRoute()
// onMounted(async () => {
//   try {
//     isPending.value = true
//     await getDoctorPersonalOnline(route.params.idPersonal)
//   } catch (error) {
//     console.error('Ошибка при загрузке данных:', error)
//   } finally {
//     isPending.value = false
//   }
// })

const router = useRouter()
const goBack = () => {
  router.go(-1)
}
</script>

<style lang="scss" scoped></style>
