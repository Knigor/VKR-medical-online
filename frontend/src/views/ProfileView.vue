<template>
  <div class="flex flex-nowrap justify-between items-center">
    <div class="flex flex-col mt-[80px] ml-[88px] max-sm:ml-4">
      <h1 class="text-3xl leading-9 font-bold font-golos">Профиль</h1>
      <div class="flex flex-col gap-[34px] mt-[34px]">
        <div class="flex flex-wrap gap-[25px]">
          <div
            :class="{
              visible: route.path.slice(-7) === 'profile',
              invisible: route.path.slice(-7) !== 'profile',
            }"
            class="h-[24px] w-[3px] bg-pink-400"
          ></div>
          <RouterLink
            :style="{ color: route.path.slice(-7) === 'profile' ? activeColor : '' }"
            class="font-golos text-base leading-6 font-medium"
            to="/profile"
          >
            Мои врачи</RouterLink
          >
        </div>
        <!-- {{ route.path }} -->
        <div class="flex flex-wrap gap-[25px]">
          <div
            :class="{
              visible: route.path.slice(-8) === 'settings',
              invisible: route.path.slice(-8) !== 'settings',
            }"
            class="h-[24px] w-[3px] bg-pink-400"
          ></div>

          <RouterLink
            :style="{ color: route.path.slice(-8) === 'settings' ? activeColor : '' }"
            class="font-golos text-base leading-6 font-medium hover:text-pink-400"
            to="/profile/settings"
          >
            Мой профиль</RouterLink
          >
        </div>
        <div class="flex flex-wrap gap-[25px]">
          <div
            :style="{ color: route.path.slice(-4) === 'help' ? activeColor : '' }"
            :class="{
              visible: route.path.slice(-4) === 'help',
              invisible: route.path.slice(-4) !== 'help',
            }"
            class="h-[24px] w-[3px] bg-pink-400"
          ></div>
          <RouterLink
            class="font-golos text-base leading-6 font-medium hover:text-pink-400"
            to="/profile/help"
          >
            Помощь</RouterLink
          >
        </div>
      </div>
      <Button class="bg-pink-400 font-golos mt-[34px]">Выбрать специалиста</Button>
    </div>
    <Profilelist v-if="route.path.slice(-7) === 'profile'" />
    <RouterView />
  </div>
</template>

<script setup>
import { Button } from '@/components/ui/button'
import { RouterView, RouterLink } from 'vue-router'
import { useRoute } from 'vue-router'
import { ref } from 'vue'
import Profilelist from '@/components/Profilelist.vue'

const activeColor = ref('#F472B6')

const route = useRoute()
</script>

<style lang="scss" scoped></style>
