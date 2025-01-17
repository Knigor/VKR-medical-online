<template>
  <div class="flex flex-wrap h-screen items-center justify-center gap-[32px]">
    <div class="w-[200px] h-[194px] bg-[url('/icons/404_2.0.svg')]"></div>
    <div class="flex flex-col items-center">
      <h1 class="font-golos font-bold text-[42px] cursor-default">404</h1>
      <p class="mt-[16px] font-golos font-regular text-[21px] fill-black cursor-default">
        Страница не найдена
      </p>

      <Button variant="outline" @click="goBack" class="mt-[12px]">Вернуться обратно</Button>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'
import { Button } from './ui/button'

const router = useRouter()

const goBack = () => {
  router.back()
}
</script>

<style scoped></style>
