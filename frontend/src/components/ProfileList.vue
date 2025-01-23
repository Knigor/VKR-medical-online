<template>
  <div class="flex flex-wrap items-center mr-[53px] max-xl:ml-[53px] max-xl:mt-[24px]">
    <FavoriteCardsDoctor v-if="isFavorite" />
    <div
      v-else
      class="flex flex-wrap gap-[53px] items-center mt-[143px] max-xl:ml-[53px] max-xl:mt-[24px]"
    >
      <div class="flex relative items-center">
        <Avatar class="h-[80px] w-[80px] relative left-3 -z-10">
          <AvatarImage src="/icons/doctor_1.svg" alt="@radix-vue" />
          <AvatarFallback>CN</AvatarFallback>
        </Avatar>
        <Avatar class="h-[90px] w-[90px]">
          <AvatarImage src="/icons/doctor_2.svg" alt="@radix-vue" />
          <AvatarFallback>CN</AvatarFallback>
        </Avatar>
        <Avatar class="h-[80px] w-[80px] relative right-3 -z-10">
          <AvatarImage src="/icons/doctor_3.svg" alt="@radix-vue" />
          <AvatarFallback>CN</AvatarFallback>
        </Avatar>
      </div>
      <div class="flex flex-col w-[231px] gap-[11px]">
        <h1 class="text-base leading-6 font-bold font-golos">Консультируйтесь повторно</h1>
        <p class="text-base leading-6 font-normal font-golos">
          С понравившимися врачами после онлайн-консультации
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'
import { ref } from 'vue'
import FavoriteCardsDoctor from './FavoriteCardsDoctor.vue'

const isFavorite = ref(false)
</script>

<style lang="scss" scoped></style>
