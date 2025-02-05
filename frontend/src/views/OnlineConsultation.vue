<template>
  <div class="flex flex-col ml-24 mt-[32px] mr-24">
    <Button class="w-[50px] h-6 flex flex-wrap mb-6" @click="goBack" variant="link">Назад</Button>
    <div>
      <h1 class="font-golos text-2xl font-bold leading-8">Список врачей</h1>
      <ScrollArea class="h-[600px] max-w-[980px] p-4">
        <CardsDoctorsOnline
          v-for="doctor in doctors"
          :id="doctor.id"
          :name="doctor.name"
          :specialization="doctor.specialization"
          :total-count="doctor.totalCount"
          :key="doctor.id"
          :rating="doctor.rating"
          :experience="doctor.expirience"
          :education="doctor.education"
          :qualification="doctor.qualification"
          :completeConsultations="doctor.completeConsultations"
          :time-schedule="doctor.time_schedule"
        />
      </ScrollArea>
    </div>
  </div>
</template>

<script setup>
import Button from '@/components/ui/button/Button.vue'
import { ScrollArea } from '@/components/ui/scroll-area'
import CardsDoctorsOnline from '@/components/online-consultation/CardsDoctorsOnline.vue'
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

const goBack = () => {
  router.push('/')
}

const doctors = ref([
  {
    id: 1,
    name: 'Кретов Игорь Олегович',
    rating: 4.5,
    totalCount: 41,
    expirience: 8,
    specialization: 'Терапевт',
    education:
      '2017 г. - ФГБОУ ВО "Чувашский государственный университет имени И.Н. Ульянова г. Чебоксары, высшее образование по специальности Врачебное дело',
    qualification: 'Профессиональные навыки сбора анамнеза, диагностики, лечения.',
    completeConsultations: 52,
    time_schedule: [
      '2024-12-01 12:45:00.000',
      '2024-12-01 15:45:00.000',
      '2024-12-01 20:10:00.000',
      '2024-11-29 12:45:30.000',
      '2024-12-03 17:00:00.000',
      '2024-12-03 19:00:00.000',
    ],
  },

  {
    id: 2,
    name: 'Швырев Родион Романович',
    rating: 4.5,
    totalCount: 41,
    expirience: 8,
    specialization: 'Терапевт',
    education:
      '2017 г. - ФГБОУ ВО "Чувашский государственный университет имени И.Н. Ульянова г. Чебоксары, высшее образование по специальности Врачебное дело',
    qualification: 'Профессиональные навыки сбора анамнеза, диагностики, лечения.',
    completeConsultations: 52,
    time_schedule: [
      '2024-12-01 12:45:00.000',
      '2024-12-01 15:45:00.000',
      '2024-12-01 20:10:00.000',
      '2024-11-29 12:45:30.000',
      '2024-12-03 17:00:00.000',
      '2024-12-03 19:00:00.000',
    ],
  },
  {
    id: 3,
    name: 'Ефремов Владимир Александрович',
    rating: 4.5,
    totalCount: 41,
    expirience: 8,
    specialization: 'Терапевт',
    education:
      '2017 г. - ФГБОУ ВО "Чувашский государственный университет имени И.Н. Ульянова г. Чебоксары, высшее образование по специальности Врачебное дело',
    qualification: 'Профессиональные навыки сбора анамнеза, диагностики, лечения.',
    completeConsultations: 52,
    time_schedule: [
      '2024-12-01 12:45:00.000',
      '2024-12-01 15:45:00.000',
      '2024-12-01 20:10:00.000',
      '2024-11-29 12:45:30.000',
      '2024-12-03 17:00:00.000',
      '2024-12-03 19:00:00.000',
    ],
  },
  {
    id: 4,
    name: 'Ефремов Владимир Александрович',
    rating: 4.5,
    totalCount: 41,
    expirience: 8,
    specialization: 'Терапевт',
    education:
      '2017 г. - ФГБОУ ВО "Чувашский государственный университет имени И.Н. Ульянова г. Чебоксары, высшее образование по специальности Врачебное дело',
    qualification: 'Профессиональные навыки сбора анамнеза, диагностики, лечения.',
    completeConsultations: 52,
    time_schedule: [
      '2024-12-01 12:45:00.000',
      '2024-12-01 15:45:00.000',
      '2024-12-01 20:10:00.000',
      '2024-11-29 12:45:30.000',
      '2024-12-03 17:00:00.000',
      '2024-12-03 19:00:00.000',
    ],
  },
  {
    id: 5,
    name: 'Ефремов Владимир Александрович',
    rating: 4.5,
    totalCount: 41,
    expirience: 8,
    specialization: 'Терапевт',
    education:
      '2017 г. - ФГБОУ ВО "Чувашский государственный университет имени И.Н. Ульянова г. Чебоксары, высшее образование по специальности Врачебное дело',
    qualification: 'Профессиональные навыки сбора анамнеза, диагностики, лечения.',
    completeConsultations: 52,
    time_schedule: [
      '2024-12-01 12:45:00.000',
      '2024-12-01 15:45:00.000',
      '2024-12-01 20:10:00.000',
      '2024-11-29 12:45:30.000',
      '2024-12-03 17:00:00.000',
      '2024-12-03 19:00:00.000',
    ],
  },
])
</script>

<style lang="scss" scoped></style>
