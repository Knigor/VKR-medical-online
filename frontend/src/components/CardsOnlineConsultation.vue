<template>
  <div
    @click="
      goToOnlineConsultation(id, statusChat, doctorUsername, patientUsername, patientId, doctorId)
    "
    class="flex items-center border-gray-300 hover:shadow-md cursor-pointer group border-[1px] rounded-[8px] pr-4 sm:pr-6 lg:pr-8 mr-2"
  >
    <div class="flex flex-col mt-4 sm:mt-6 lg:mt-[32px] ml-4 sm:ml-6 lg:ml-[20px]">
      <h2
        class="font-golos text-lg sm:text-xl lg:text-2xl leading-6 sm:leading-7 lg:leading-8 font-semibold"
      >
        Врач
      </h2>
      <p
        class="mt-2 sm:mt-3 lg:mt-[6px] mb-4 sm:mb-6 lg:mb-[21px] text-gray-500 font-golos text-sm sm:text-base lg:text-base leading-5 sm:leading-6 font-normal"
      >
        {{ doctorUsername }}
      </p>
      <h2
        class="font-golos text-lg sm:text-xl lg:text-2xl leading-6 sm:leading-7 lg:leading-8 font-semibold"
      >
        Пациент:
      </h2>
      <p
        class="mt-2 sm:mt-3 lg:mt-[6px] mb-4 sm:mb-6 lg:mb-[21px] text-gray-500 font-golos text-sm sm:text-base lg:text-base leading-5 sm:leading-6 font-normal"
      >
        {{ patientUsername }}
      </p>
      <Button
        class="text-sm sm:text-base leading-5 group-hover:bg-pink-400 group-hover:text-white sm:leading-6 font-light font-golos w-[90px] sm:w-[100px] lg:w-[106px] h-[36px] sm:h-[40px] lg:h-[44px] mb-3 sm:mb-4 lg:mb-[13px]"
        variant="outline"
      >
        Онлайн чат
      </Button>
    </div>
  </div>
</template>

<script setup>
import { Button } from './ui/button'
import { useRouter } from 'vue-router'

const router = useRouter()

defineProps({
  patientUsername: String,
  doctorUsername: String,
  statusChat: Boolean,
  id: Number,
  patientId: Number,
  doctorId: Number,
})

const goToOnlineConsultation = (
  id,
  statusChat,
  doctorUsername,
  patientUsername,
  patientId,
  doctorId,
) => {
  router.push({
    path: `/chat/${id}`,
    query: {
      statusChat,
      doctorUsername,
      patientUsername,
      patientId,
      doctorId,
    },
  })
}
</script>

<style scoped></style>
