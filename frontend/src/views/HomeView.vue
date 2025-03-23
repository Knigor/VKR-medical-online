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
import { ref, computed } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/authStore'
import { useSpecializationStore } from '@/stores/specializationStore'
import { useToast } from 'vue-toastification'

import { useDoctorStore } from '@/stores/doctorStore'
const toast = useToast()
const router = useRouter()
const authStore = useAuthStore()
const doctorStore = useDoctorStore()

const specializationStore = useSpecializationStore()

console.log(specializationStore.specializationData)

const filteredOnlineChats = computed(() =>
  doctorStore.doctorChatList.filter((item) => item.statusChat === true),
)

const emit = defineEmits(['update:isModalOpen'])

const popularList = ref([
  { id: 1, textPopular: 'Боль в горле', relatedSpecializations: 'Терапевт', image: 'text_1.jpg' },
  { id: 3, textPopular: 'Простуда', relatedSpecializations: 'Педиатор', image: 'text_2.jpg' },
  {
    id: 5,
    textPopular: 'Боль в суставах',
    relatedSpecializations: 'Терапевт',
    image: 'text_3.jpg',
  },
  {
    id: 2,
    textPopular: 'Последствие травм',
    relatedSpecializations: 'Терапевт',
    image: 'text_4.jpg',
  },
  { id: 6, textPopular: 'Аллергия', relatedSpecializations: 'Дерматолог', image: 'text_5.jpg' },
  {
    id: 4,
    textPopular: 'Отношения с партнером',
    relatedSpecializations: 'Психолог',
    image: 'text_6.jpg',
  },
  {
    id: 7,
    textPopular: 'Сексуальная жизнь',
    relatedSpecializations: 'Гинеколог',
    image: 'text_7.jpg',
  },
  {
    id: 8,
    textPopular: 'Проблемы с сердцем',
    relatedSpecializations: 'Кардиолог',
    image: 'text_8.jpg',
  },
])

const goToPopular = (popular) => {
  if (authStore.id === null) {
    toast.success('Для начала авторизуйтесь')

    return
  } else {
    router.push(`/online/${popular}`)
  }
}
</script>

<template>
  <div class="flex flex-col ml-4 sm:ml-8 lg:ml-[68px] mt-4 sm:mt-8 lg:mt-[68px]">
    <!-- true для обычного пользователя, false для доктора -->
    <div v-if="authStore.doctorId === null">
      <h1
        class="text-2xl sm:text-3xl lg:text-4xl font-golos leading-8 sm:leading-9 lg:leading-10 font-bold"
      >
        Онлайн-консультации с врачами
      </h1>

      <div v-if="filteredOnlineChats.length">
        <h2
          class="mt-6 sm:mt-8 lg:mt-[20px] text-xl sm:text-2xl lg:text-3xl leading-7 sm:leading-8 lg:leading-9 font-golos font-semibold"
        >
          Список онлайн чатов
        </h2>
        <!--ПАЦИЕНТЫ-->
        <div
          class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-[46px] mt-4 sm:mt-6 lg:mt-[43px] mb-8 sm:mb-12 lg:mb-[80px]"
        >
          <CardsOnlineConsultation
            v-for="doctor in filteredOnlineChats"
            :key="doctor.chatId"
            :id="doctor.chatId"
            :patientUsername="doctor.patientUsername"
            :doctorUsername="doctor.doctorUsername"
            :statusChat="doctor.statusChat"
            :patientId="doctor.patientId"
            :doctorId="doctor.doctorId"
          />
        </div>
      </div>

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
              <CardsPopular
                @click="goToPopular(popular.relatedSpecializations)"
                :image="popular.image"
                :popular-text="popular.textPopular"
              />
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
        <!--ВРАЧИ-->
        <div
          class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-[46px] mt-4 sm:mt-6 lg:mt-[43px] mb-8 sm:mb-12 lg:mb-[80px]"
        >
          <CardsOnlineConsultation
            v-for="doctor in filteredOnlineChats"
            :key="doctor.chatId"
            :id="doctor.chatId"
            :patientUsername="doctor.patientUsername"
            :doctorUsername="doctor.doctorUsername"
            :statusChat="doctor.statusChat"
            :patientId="doctor.patientId"
            :doctorId="doctor.doctorId"
          />
        </div>
      </div>
      <h2
        v-if="authStore.id !== null"
        class="mt-6 sm:mt-8 lg:mt-[20px] text-xl sm:text-2xl lg:text-3xl leading-7 sm:leading-8 lg:leading-9 font-golos font-semibold"
      >
        Специалисты
      </h2>
      <div
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-[46px] mt-4 sm:mt-6 lg:mt-[43px] mb-8 sm:mb-12 lg:mb-[80px]"
      >
        <CardsDoctor
          v-for="specialist in specializationStore.specializationData"
          :key="specialist.specializationId"
          :id="specialist.specializationId"
          :name-specialist="specialist.nameSpecialization"
          :avatar_img="specialist.image"
          description="По записи"
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
      <!-- Активация списка если есть активные чаты  !!!!!!!!!сюда -->
      <div v-if="filteredOnlineChats.length">
        <h2
          class="mt-6 sm:mt-8 lg:mt-[20px] text-xl sm:text-2xl lg:text-3xl leading-7 sm:leading-8 lg:leading-9 font-golos font-semibold"
        >
          Список онлайн чатов
        </h2>

        <div
          class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-[46px] mt-4 sm:mt-6 lg:mt-[43px] mb-8 sm:mb-12 lg:mb-[80px]"
        >
          <CardsOnlineConsultation
            v-for="doctor in filteredOnlineChats"
            :key="doctor.chatId"
            :id="doctor.chatId"
            :patientUsername="doctor.patientUsername"
            :doctorUsername="doctor.doctorUsername"
            :statusChat="doctor.statusChat"
            :patientId="doctor.patientId"
            :doctorId="doctor.doctorId"
          />
        </div>
      </div>
      <div class="pt2" v-else>
        <p
          class="mt-6 sm:mt-8 lg:mt-[20px] text-xl text-gray-800 sm:text-2xl lg:text-3xl leading-7 sm:leading-8 lg:leading-9 font-golos font-semibold"
        >
          У вас нету активных чатов
        </p>
        <p
          class="mt-2 sm:mt-3 lg:mt-[6px] text-gray-500 font-golos text-sm sm:text-base lg:text-base leading-5 sm:leading-6 font-normal"
        >
          Перейдите в профиль если еще не заполнили свою карточку
        </p>
      </div>
      <div class="flex justify-center h-[50vh] items-center">
        <Button @click="router.push(`/onlinePersonal/${authStore.doctorId}`)"
          >Моя карточка доктора</Button
        >
      </div>
    </div>
  </div>
</template>
