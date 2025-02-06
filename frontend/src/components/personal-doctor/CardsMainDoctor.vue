<template>
  <div class="flex items-center border w-full max-w-[641px] border-gray-300 rounded-2xl">
    <Avatar class="h-[60px] w-[60px] sm:h-[70px] sm:w-[70px] lg:h-[70px] lg:w-[70px] ml-6">
      <AvatarImage src="/icons/avatar-test.svg" alt="@radix-vue" />
      <AvatarFallback>CN</AvatarFallback>
    </Avatar>
    <div class="flex flex-col mt-4 sm:mt-6 lg:mt-[32px] ml-4 sm:ml-6 lg:ml-[20px]">
      <p
        class="sm:mt-3 lg:mt-[6px] text-gray-500 font-golos text-sm sm:text-base lg:text-base leading-5 sm:leading-6 font-normal"
      >
        {{ doctorStore.doctorData.specialization }}
      </p>
      <h2
        class="font-golos text-lg sm:text-xl lg:text-2xl leading-6 sm:leading-7 lg:leading-8 font-semibold"
      >
        {{ doctorStore.doctorData.name }}
      </h2>
      <div class="flex flex-wrap">
        <Star class="mt-1 mr-1" color="#FBBF24" />
        <p
          class="mt-2 sm:mt-3 lg:mt-[6px] mb-4 sm:mb-6 lg:mb-[21px] text-gray-500 font-golos text-sm sm:text-base lg:text-base leading-5 sm:leading-6 font-normal"
        >
          {{ doctorStore.doctorData.rating }} /
        </p>
        <p
          class="mt-2 ml-1 sm:mt-3 lg:mt-[6px] mb-4 sm:mb-6 lg:mb-[21px] text-gray-500 font-golos text-sm sm:text-base lg:text-base leading-5 sm:leading-6 font-normal"
        >
          {{ doctorStore.doctorData.totalCount }} оценок /
        </p>
        <p
          class="mt-2 ml-1 sm:mt-3 lg:mt-[6px] mb-4 sm:mb-6 lg:mb-[21px] text-gray-500 font-golos text-sm sm:text-base lg:text-base leading-5 sm:leading-6 font-normal"
        >
          {{ doctorStore.doctorData.completeConsultations }} консультаций
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Star } from 'lucide-vue-next'
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'

import { usePersonalDoctorStore } from '@/stores/personalDoctor'

const doctorStore = usePersonalDoctorStore()
</script>

<style lang="scss" scoped></style>
