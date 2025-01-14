<script setup>
import { RouterView, RouterLink } from 'vue-router'
import { useColorMode } from '@vueuse/core'

const mode = useColorMode()
</script>

<template>
  <div class="flex flex-col min-h-screen">
    <header class="flex flex-wrap items-center justify-between h-[146px] ml-[68px] mr-[68px]"></header>
    <hr class="max-sm:mt-[20px]"></hr>
    <RouterView />
    <footer class="h-[100px] flex items-center justify-center ">
        <h1 class="text-gray-400 text-align-center">
          Выпусканая квалификационная работа для проведения врачебных
          консультаций в режиме онлайн
        </h1>
      </footer>
  </div>
</template>

<style scoped></style>
