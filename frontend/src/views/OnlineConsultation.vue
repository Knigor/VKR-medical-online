<template>
  <div class="flex flex-col ml-24 mt-[32px] mr-24">
    <Button class="w-[50px] h-6 flex flex-wrap mb-6" variant="link">Назад</Button>
    <div>
      <h1 class="font-golos text-2xl font-bold leading-8">Список врачей</h1>
      <ScrollArea class="h-[600px] max-w-[980px] p-4">
        <CardsDoctorsOnline />
        <CardsDoctorsOnline />
        <CardsDoctorsOnline />
        <CardsDoctorsOnline />
        <CardsDoctorsOnline />
        <CardsDoctorsOnline />
      </ScrollArea>
    </div>
  </div>
</template>

<script setup>
import Button from '@/components/ui/button/Button.vue'
import { ScrollArea } from '@/components/ui/scroll-area'
import CardsDoctorsOnline from '@/components/online-consultation/CardsDoctorsOnline.vue'
</script>

<style lang="scss" scoped></style>
