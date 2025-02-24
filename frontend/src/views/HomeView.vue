<script setup>
import CardsDoctor from '@/components/CardsDoctor.vue'
import CardsOnlineConsultation from '@/components/CardsOnlineConsultation.vue'
import CardsPopular from '@/components/CardsPopular.vue'
import {
  Carousel,
  CarouselContent,
  CarouselItem,
  CarouselNext,
  CarouselPrevious,
} from '@/components/ui/carousel'
import Button from '@/components/ui/button/Button.vue'
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

const specialistList = ref([
  {
    id: 1,
    description: 'По записи',
    specialization: 'Терапевт',
  },
  {
    id: 2,
    description: 'По записи',
    specialization: 'Педиатор',
  },
  {
    id: 3,
    description: 'По записи',
    specialization: 'Дерматолог',
  },
  {
    id: 4,
    description: 'По записи',
    specialization: 'Психолог',
  },
  {
    id: 5,
    description: 'По записи',
    specialization: 'Гинеколог',
  },
  {
    id: 6,
    description: 'По записи',
    specialization: 'Кардиолог',
  },
])

const popularList = ref([
  {
    id: 1,
    textPopular: 'Боль в горле',
  },
  {
    id: 2,
    textPopular: 'Последствие травм',
  },
  {
    id: 3,
    textPopular: 'Простуда',
  },
  {
    id: 4,
    textPopular: 'Отношения с партнером',
  },
  {
    id: 5,
    textPopular: 'Боль в суставах',
  },
  {
    id: 6,
    textPopular: 'Аллергия',
  },
  {
    id: 7,
    textPopular: 'Сексуальная жизнь',
  },
  {
    id: 8,
    textPopular: 'Проблемы с сердцем',
  },
])
</script>

<template>
  <div class="flex flex-col ml-4 sm:ml-8 lg:ml-[68px] mt-4 sm:mt-8 lg:mt-[68px]">
    <!-- true для обычного пользователя, false для доктора -->
    <div v-if="false">
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
            v-for="popular in popularList"
            :key="popular.id"
            class="sm:basis-1/3 md:basis-1/4 lg:basis-[200px] flex"
          >
            <div class="pr-14 flex">
              <CardsPopular :popular-text="popular.textPopular" />
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
      <!--Активация списка если есть активные чаты-->
      <div v-if="false">
        <h2
          class="mt-6 sm:mt-8 lg:mt-[20px] text-xl sm:text-2xl lg:text-3xl leading-7 sm:leading-8 lg:leading-9 font-golos font-semibold"
        >
          Список онлайн чатов
        </h2>

        <div
          class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-[46px] mt-4 sm:mt-6 lg:mt-[43px] mb-8 sm:mb-12 lg:mb-[80px]"
        >
          <CardsOnlineConsultation
            v-for="specialist in specialistList"
            :key="specialist.id"
            :id="specialist.id"
            :name-specialist="specialist.specialization"
            :description="specialist.description"
          />
        </div>
      </div>

      <h2
        class="mt-6 sm:mt-8 lg:mt-[20px] text-xl sm:text-2xl lg:text-3xl leading-7 sm:leading-8 lg:leading-9 font-golos font-semibold"
      >
        Специалисты
      </h2>

      <div
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-[46px] mt-4 sm:mt-6 lg:mt-[43px] mb-8 sm:mb-12 lg:mb-[80px]"
      >
        <CardsDoctor
          v-for="specialist in specialistList"
          :key="specialist.id"
          :id="specialist.id"
          :name-specialist="specialist.specialization"
          :description="specialist.description"
        />
      </div>
    </div>
    <!-- true для обычного пользователя, false для доктора -->
    <div v-else>
      <h1
        class="text-2xl sm:text-3xl lg:text-4xl font-golos leading-8 sm:leading-9 lg:leading-10 font-bold"
      >
        Онлайн-консультации с врачами
      </h1>
      <!-- Активация списка если есть активные чаты -->
      <div v-if="true">
        <h2
          class="mt-6 sm:mt-8 lg:mt-[20px] text-xl sm:text-2xl lg:text-3xl leading-7 sm:leading-8 lg:leading-9 font-golos font-semibold"
        >
          Список онлайн чатов
        </h2>

        <div
          class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-[46px] mt-4 sm:mt-6 lg:mt-[43px] mb-8 sm:mb-12 lg:mb-[80px]"
        >
          <CardsOnlineConsultation
            v-for="specialist in specialistList"
            :key="specialist.id"
            :id="specialist.id"
            :name-specialist="specialist.specialization"
            :description="specialist.description"
          />
        </div>
      </div>
      <div class="flex justify-center h-[50vh] items-center">
        <Button @click="router.push(`/onlinePersonal/${1}`)">Моя карточка доктора</Button>
      </div>
    </div>
  </div>
</template>
