<template>
  <div class="flex flex-col items-center mt-[64px]">
    <Avatar class="h-[200px] w-[200px]">
      <AvatarImage src="/icons/doctor_3.svg" alt="@radix-vue" />
      <AvatarFallback>CN</AvatarFallback>
    </Avatar>
    <h1 class="text-4xl leading-10 font-medium font-golos">
      Для обратной связи можно написать нам
    </h1>
    <div class="flex mt-[34px] gap-[24px]">
      <Button class="bg-blue-400 font-golos hover:bg-blue-500"
        ><Send stroke-width="1" stroke="#60A5FA" fill="white" /> Telegram
      </Button>
      <Button class="bg-pink-400 font-golos">Обратная связь</Button>
    </div>
  </div>
</template>

<script setup>
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'
import { ref } from 'vue'
import Button from './ui/button/Button.vue'
import { Send } from 'lucide-vue-next'
</script>

<style lang="scss" scoped></style>
