<script setup>
import CardsDoctor from '@/components/CardsDoctor.vue'
import CardsPopular from '@/components/CardsPopular.vue'
import {
  Carousel,
  CarouselContent,
  CarouselItem,
  CarouselNext,
  CarouselPrevious,
} from '@/components/ui/carousel'
</script>

<template>
  <div class="flex flex-col ml-4 sm:ml-8 lg:ml-[68px] mt-4 sm:mt-8 lg:mt-[68px]">
    <h1
      class="text-2xl sm:text-3xl lg:text-4xl font-golos leading-8 sm:leading-9 lg:leading-10 font-bold"
    >
      Онлайн-консультации с врачами
    </h1>
    <h2
      class="mt-4 sm:mt-6 lg:mt-[20px] text-xl sm:text-2xl lg:text-3xl leading-7 sm:leading-8 lg:leading-9 font-golos font-semibold"
    >
      Популярные темы
    </h2>

    <Carousel
      class="w-full"
      :opts="{
        align: 'start',
      }"
    >
      <CarouselContent>
        <CarouselItem
          v-for="(_, index) in 12"
          :key="index"
          class="basis-1/2 sm:basis-1/3 md:basis-1/4 lg:basis-[190px] 2xl:basis-1/5 flex"
        >
          <div class="pr-14 flex">
            <CardsPopular />
          </div>
        </CarouselItem>
      </CarouselContent>
      <CarouselPrevious
        class="absolute z-30 left-[-16px] sm:left-[-24px] top-[50%] translate-y-[-50%] bg-white w-8 h-8 sm:w-10 sm:h-10 lg:w-[40px] lg:h-[40px]"
      />
      <CarouselNext
        class="absolute z-30 right-[16px] sm:right-[6px] top-[50%] translate-y-[-50%] bg-white w-8 h-8 sm:w-10 sm:h-10 lg:w-[40px] lg:h-[40px]"
      />
    </Carousel>

    <h2
      class="mt-6 sm:mt-8 lg:mt-[20px] text-xl sm:text-2xl lg:text-3xl leading-7 sm:leading-8 lg:leading-9 font-golos font-semibold"
    >
      Специалисты
    </h2>

    <div
      class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-[46px] mt-4 sm:mt-6 lg:mt-[43px] mb-8 sm:mb-12 lg:mb-[80px]"
    >
      <CardsDoctor />
      <CardsDoctor />
      <CardsDoctor />
      <CardsDoctor />
      <CardsDoctor />
      <CardsDoctor />
      <CardsDoctor />
      <CardsDoctor />
    </div>
  </div>
</template>
