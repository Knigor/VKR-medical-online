<template>
  <div
    class="flex flex-col w-[152px] items-center pt-[33px] mt-[43px] border-gray-300 border-[1px] h-[190px] hover:shadow-md cursor-pointer"
  >
    <img class="w-[80px] h-[80px]" :src="`/popular/${image}`" />
    <div :style="{ backgroundImage: `url(/popular/${image})` }"></div>
    <p class="text-base leading-6 font-normal font-golos ml-2 pr-2 mt-[17px] text-center">
      {{ popularText }}
    </p>
  </div>
</template>

<script setup>
defineProps({
  popularText: String,
  image: String,
})
</script>

<style lang="scss" scoped></style>
