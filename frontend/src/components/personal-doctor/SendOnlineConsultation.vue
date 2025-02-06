<template>
  <div class="flex items-center border w-full h-full max-w-[641px] border-gray-300 rounded-2xl">
    <div class="flex flex-col gap-2 ml-6 mt-4 mb-2">
      <h1 class="text-2xl leading-8 font-bold font-golos">Запись на приём</h1>
      <p class="text-lg leading-7 font-normal font-golos">
        {{ doctorStore.doctorData.specialization }}
      </p>
    </div>
  </div>
</template>

<script setup>
import { usePersonalDoctorStore } from '@/stores/personalDoctor'

const doctorStore = usePersonalDoctorStore()
</script>

<style lang="scss" scoped></style>
