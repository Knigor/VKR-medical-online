<template>
  <div class="flex flex-col ml-24 mt-[32px] mr-24">
    <Button class="w-[50px] h-6 flex flex-wrap mb-6" @click="goBack" variant="link">Назад</Button>
    <div class="flex flex-wrap gap-4">
      <div class="flex flex-col gap-6">
        <div class="flex">
          <CardsMainDoctor />
        </div>

        <ExperienceDoctor />
        <EducationDoctor />
      </div>
      <SendOnlineConsultation />
    </div>
  </div>
</template>

<script setup>
import { usePersonalDoctorStore } from '@/stores/personalDoctor'
import CardsMainDoctor from '@/components/personal-doctor/CardsMainDoctor.vue'
import Button from '@/components/ui/button/Button.vue'
import { useRouter } from 'vue-router'
import ExperienceDoctor from '@/components/personal-doctor/ExperienceDoctor.vue'
import EducationDoctor from '@/components/personal-doctor/EducationDoctor.vue'
import SendOnlineConsultation from '@/components/personal-doctor/SendOnlineConsultation.vue'

const router = useRouter()
const goBack = () => {
  router.back()
}
const doctorStore = usePersonalDoctorStore()

console.log(doctorStore.doctorData)
</script>

<style lang="scss" scoped></style>
