<template>
  <div
    class="flex items-center justify-between border-gray-300 mt-6 group border-[1px] rounded-[8px] pr-4 sm:pr-6 lg:pr-8 mr-2"
  >
    <div @click="goToDoctor" class="flex items-center cursor-pointer">
      <Avatar class="h-[60px] w-[60px] sm:h-[70px] sm:w-[70px] lg:h-[70px] lg:w-[70px] ml-6">
        <AvatarImage src="/icons/avatar-test.svg" alt="@radix-vue" />
        <AvatarFallback>CN</AvatarFallback>
      </Avatar>
      <div class="flex flex-col mt-4 sm:mt-6 lg:mt-[32px] ml-4 sm:ml-6 lg:ml-[20px]">
        <p
          class="sm:mt-3 lg:mt-[6px] text-gray-500 font-golos text-sm sm:text-base lg:text-base leading-5 sm:leading-6 font-normal"
        >
          {{ specialization }}
        </p>
        <h2
          class="font-golos text-lg sm:text-xl lg:text-2xl leading-6 sm:leading-7 lg:leading-8 font-semibold"
        >
          {{ name }}
        </h2>
        <div class="flex flex-wrap">
          <Star class="mt-1 mr-1" color="#FBBF24" />
          <p
            class="mt-2 sm:mt-3 lg:mt-[6px] mb-4 sm:mb-6 lg:mb-[21px] text-gray-500 font-golos text-sm sm:text-base lg:text-base leading-5 sm:leading-6 font-normal"
          >
            {{ rating }} /
          </p>
          <p
            class="mt-2 ml-1 sm:mt-3 lg:mt-[6px] mb-4 sm:mb-6 lg:mb-[21px] text-gray-500 font-golos text-sm sm:text-base lg:text-base leading-5 sm:leading-6 font-normal"
          >
            {{ totalCount }} оценок /
          </p>
          <p
            class="mt-2 ml-1 sm:mt-3 lg:mt-[6px] mb-4 sm:mb-6 lg:mb-[21px] text-gray-500 font-golos text-sm sm:text-base lg:text-base leading-5 sm:leading-6 font-normal"
          >
            {{ completeConsultations }} консультаций
            {{ route.params.id }}
            {{ id }}
          </p>
        </div>
      </div>
    </div>

    <SendConsultation :name="name" :specialization="specialization" />
  </div>
</template>

<script setup>
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'
import { useRouter, useRoute } from 'vue-router'
import { Star } from 'lucide-vue-next'
import SendConsultation from './SendConsultation.vue'
import { usePersonalDoctorStore } from '@/stores/personalDoctor'

const router = useRouter()

const route = useRoute()

const props = defineProps({
  id: Number,
  name: String,
  specialization: String,
  rating: Number,
  experience: Number,
  education: String,
  qualification: String,
  completeConsultations: Number,
  timeSchedule: Array,
  totalCount: Number,
})

const doctorStore = usePersonalDoctorStore()

const goToDoctor = () => {
  console.log('doctorStore:', doctorStore) // Посмотрим, что вернет store
  console.log('setDoctorData:', doctorStore.setDoctorData) // Проверяем метод
  doctorStore.setDoctorData(props)
  router.push({ name: 'doctorPersonal', params: { id: route.params.id, idPersonal: props.id } })
}
</script>

<style scoped></style>
