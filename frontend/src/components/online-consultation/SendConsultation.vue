<template>
  <div class="h-full min-w-[240px]">
    <h1 class="text-base leading-6 font-semibold mt-4">Расписание врача</h1>
    <div class="flex gap-1 items-center">
      <ShieldAlert fill="none" color="#D1D5DB" size="21" />
      <span class="text-gray-300 font-golos text-sm leading-5 font-normal"
        >Запись по местному времени</span
      >
    </div>
    <div class="flex flex-wrap gap-2 mt-4">
      <Button
        v-for="(date, index) in dateConsultation.slice(0, 3)"
        :key="date.id"
        @click="index === 2 ? (showModal = true) : selectDate(date)"
        variant="outline"
        class="rounded-full"
        :class="
          selectedDateId === date.id
            ? 'bg-pink-300 border-pink-300 text-white hover:bg-pink-300 hover:text-white'
            : ''
        "
      >
        {{ index === 2 ? 'Другой день' : date.day }}
      </Button>
    </div>
    <div class="flex flex-wrap gap-4 mt-4 mb-4 max-w-[400px]" v-if="selectedTime.length">
      <Button
        variant="outline"
        class="rounded-2xl hover:bg-pink-300 hover:text-white hover:border-pink-300"
        v-for="t in selectedTime"
        :key="t"
        @click="selectTime(t, selectedDate)"
        >{{ t }}</Button
      >
    </div>

    <!-- Модалка для другого времени-->
    <TransitionRoot appear :show="showModal" as="template">
      <Dialog as="div" @close="closeModal" class="relative z-10">
        <TransitionChild
          as="template"
          enter="duration-300 ease-out"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="duration-200 ease-in"
          leave-from="opacity-100"
          leave-to="opacity-0"
        >
          <div class="fixed inset-0 bg-black/25" />
        </TransitionChild>

        <div class="fixed inset-0 overflow-y-auto">
          <div class="flex min-h-full items-center justify-center p-4 text-center">
            <TransitionChild
              as="template"
              enter="duration-300 ease-out"
              enter-from="opacity-0 scale-95"
              enter-to="opacity-100 scale-100"
              leave="duration-200 ease-in"
              leave-from="opacity-100 scale-100"
              leave-to="opacity-0 scale-95"
            >
              <DialogPanel
                class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
              >
                <DialogTitle as="h3" class="text-lg font-medium leading-6 font-golos text-gray-900">
                  Выбор времени
                </DialogTitle>
                <div v-for="date in dateConsultation" :key="date.id" class="mt-2">
                  <p class="text-sm font-golos text-gray-500">
                    {{ date.day }}
                  </p>
                  <Button
                    variant="outline"
                    class="rounded-2xl mt-2 mr-2 hover:bg-pink-300 hover:text-white hover:border-pink-300"
                    v-for="t in date.time"
                    :key="t"
                    @click="selectTime(t, date.day)"
                    >{{ t }}</Button
                  >
                </div>

                <div class="mt-4">
                  <button
                    type="button"
                    class="inline-flex justify-center rounded-md border border-transparent bg-pink-300 px-4 py-2 text-sm font-medium text-white hover:bg-pink-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                    @click="closeModal"
                  >
                    Назад
                  </button>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>

    <!-- Модалка для записи на консультацию -->

    <TransitionRoot appear :show="sendModal" as="template">
      <Dialog as="div" @close="closeModalSend" class="relative z-10">
        <TransitionChild
          as="template"
          enter="duration-300 ease-out"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="duration-200 ease-in"
          leave-from="opacity-100"
          leave-to="opacity-0"
        >
          <div class="fixed inset-0 bg-black/25" />
        </TransitionChild>

        <div class="fixed inset-0 overflow-y-auto">
          <div class="flex min-h-full items-center justify-center p-4 text-center">
            <TransitionChild
              as="template"
              enter="duration-300 ease-out"
              enter-from="opacity-0 scale-95"
              enter-to="opacity-100 scale-100"
              leave="duration-200 ease-in"
              leave-from="opacity-100 scale-100"
              leave-to="opacity-0 scale-95"
            >
              <DialogPanel
                class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
              >
                <DialogTitle as="h3" class="text-lg font-medium leading-6 font-golos text-gray-900">
                  Запись на приём
                </DialogTitle>
                <div class="mt-2">
                  <p class="text-sm font-golos text-gray-500">{{ name }}</p>
                </div>
                <div class="mt-2">
                  <p class="text-sm font-golos text-gray-500">{{ specialization }}</p>
                </div>
                <div class="mt-2">
                  <p class="text-sm font-golos text-gray-500">Дата: {{ selectedDate }}</p>
                  <p class="text-sm font-golos text-gray-500">Время: {{ selectedTimeSlot }}</p>
                </div>

                <div class="mt-4 flex gap-4">
                  <button
                    type="button"
                    class="inline-flex justify-center rounded-md border border-gray-100 border-transparent bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                    @click="closeModalSend"
                  >
                    Отменить
                  </button>
                  <button
                    type="button"
                    class="inline-flex justify-center rounded-md border border-transparent bg-pink-300 px-4 py-2 text-sm font-medium text-white hover:bg-pink-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                    @click="closeModalSend"
                  >
                    Записаться
                  </button>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { ShieldAlert } from 'lucide-vue-next'
import Button from '../ui/button/Button.vue'
import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle } from '@headlessui/vue'

defineProps({
  name: String,
  specialization: String,
})

const dateConsultation = ref([
  { id: 1, day: '5 февраля', time: ['10:00', '13:00', '20:00', '20:00', '20:00', '20:00'] },
  { id: 2, day: '6 февраля', time: ['11:00', '13:00', '20:00'] },
  { id: 3, day: '7 февраля', time: ['12:00', '13:00', '20:00'] },
  { id: 4, day: '14 февраля', time: ['10:00', '13:00', '20:00'] },
])

const selectedTime = ref([])
const selectedDateId = ref(null) // ID выбранной даты
const showModal = ref(false)
const sendModal = ref(false)

const selectedDate = ref(null)
const selectedTimeSlot = ref(null)

const closeModalSend = () => {
  sendModal.value = false
  selectedDateId.value = null
  selectDate(dateConsultation.value[0])
}

const closeModal = () => {
  showModal.value = false
}

const selectTime = (time, date) => {
  selectedTimeSlot.value = time
  selectedDate.value = date
  showModal.value = false
  sendModal.value = true
}

// Устанавливаем время и активную кнопку при загрузке
onMounted(() => {
  selectedDate.value = dateConsultation.value[0].day
  selectDate(dateConsultation.value[0])
})

// Функция выбора даты
const selectDate = (date) => {
  selectedTime.value = date.time
  selectedDate.value = date.day
  selectedDateId.value = date.id
  showModal.value = false // Закрываем модалку при выборе
}
</script>
