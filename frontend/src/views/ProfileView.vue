<template>
  <div className="flex flex-wrap justify-between">
    <div className="flex flex-col mt-[80px] ml-[88px]">
      <h1 className="text-3xl leading-9 font-bold font-golos ">Профиль</h1>
      <div className="flex flex-col gap-[34px] mt-[34px]">
        <p class="font-golos text-base leading-6 font-medium" to="/profile">Мои врачи</p>
        <p class="font-golos text-base leading-6 font-medium" to="/profile/settings">Мой профиль</p>
        <p class="font-golos text-base leading-6 font-medium" to="/profile/help">Помощь</p>
      </div>
      <Button class="bg-pink-400 font-golos">Выбрать специалиста</Button>
    </div>
    <!-- <Outlet /> -->
  </div>
</template>

<script setup>
import { Button } from '@/components/ui/button'
</script>

<style lang="scss" scoped></style>
