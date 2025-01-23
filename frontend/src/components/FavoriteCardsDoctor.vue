<template>
  <div>
    <h1 class="text-2xl leading-9 font-bold font-golos">Ваши врачи</h1>
    <ScrollArea class="h-[230px] w-[704px] rounded-md pr-4">
      <div
        v-for="doctor in doctorsList"
        :key="doctor.id"
        class="flex items-center border-gray-300 border-[1px] rounded-[8px] pr-4 sm:pr-6 lg:pr-8 mt-4"
      >
        <Avatar class="h-[72px] w-[72px] sm:h-[100px] sm:w-[100px] lg:h-[120px] lg:w-[120px] ml-6">
          <AvatarImage src="/icons/avatar-test.svg" alt="@radix-vue" />
          <AvatarFallback>CN</AvatarFallback>
        </Avatar>
        <div class="flex flex-col mt-4 sm:mt-6 lg:mt-[32px] ml-4 sm:ml-6 lg:ml-[20px]">
          <div class="flex gap-2">
            <span class="text-base leading-6 font-normal text-gray-500 font-golos">{{
              doctor.specializationDoctor
            }}</span>
          </div>

          <h2
            class="font-golos text-lg sm:text-xl lg:text-2xl leading-6 sm:leading-7 lg:leading-8 font-semibold"
          >
            {{ doctor.name }}
          </h2>
          <div class="flex gap-3">
            <div class="flex gap-1 items-center">
              <span class="font-golos text-sm text-black">Рейтинг - {{ doctor.rating }}</span>
              <Star color="yellow" fill="#eede2b" stroke-width="1" size="20px" />
            </div>

            <span class="font-golos text-sm text-black">Стаж - {{ doctor.experience }} лет</span>
          </div>
          <Button
            class="text-sm mt-4 sm:text-base leading-5 sm:leading-6 font-light font-golos w-[450px] h-[36px] sm:h-[40px] lg:h-[44px] mb-3 sm:mb-4 lg:mb-[13px]"
            variant="outline"
          >
            Записаться на прием
          </Button>
        </div>
      </div>
    </ScrollArea>
  </div>
</template>

<script setup>
import { Button } from './ui/button'
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'
import { ref, reactive } from 'vue'
import { ScrollArea } from '@/components/ui/scroll-area'
import { Star } from 'lucide-vue-next'

const doctorsList = ref([
  {
    id: 1,
    name: 'Дежурный терапевт',
    status: 'По записи',
    specializationDoctor: 'Терапевт, Гастроэнтеролог',
    rating: 4.5,
    experience: 8,
  },
  {
    id: 2,
    name: 'Дежурный терапевт',
    status: 'По записи',
    specializationDoctor: 'Терапевт, Гастроэнтеролог',
    rating: 4.5,
    experience: 8,
  },
  {
    id: 3,
    name: 'Дежурный терапевт',
    status: 'По записи',
    specializationDoctor: 'Терапевт, Гастроэнтеролог',
    rating: 4.5,
    experience: 8,
  },
])
</script>

<style scoped></style>
