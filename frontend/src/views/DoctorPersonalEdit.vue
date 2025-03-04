<template>
  <div class="p-6 max-w-3xl mx-auto">
    <Button @click="goBack" class="mb-4 bg-pink-400">Назад</Button>

    <div class="bg-white shadow rounded-lg p-4">
      <h2 class="text-xl font-bold">Специализация</h2>
      <Listbox v-model="selectedPerson">
        <div class="relative mt-1">
          <ListboxButton
            class="relative w-full cursor-default rounded-lg bg-white py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white/75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm"
          >
            <span class="block truncate">{{ selectedPerson.name }}</span>
            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
              <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
            </span>
          </ListboxButton>

          <transition
            leave-active-class="transition duration-100 ease-in"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
          >
            <ListboxOptions
              class="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm"
            >
              <ListboxOption
                v-slot="{ active, selected }"
                v-for="person in people"
                :key="person.name"
                :value="person"
                as="template"
              >
                <li
                  :class="[
                    active ? 'bg-pink-100 text-pink-900' : 'text-gray-900',
                    'relative cursor-default select-none py-2 pl-10 pr-4',
                  ]"
                >
                  <span :class="[selected ? 'font-medium' : 'font-normal', 'block truncate']">{{
                    person.name
                  }}</span>
                  <span
                    v-if="selected"
                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-pink-600"
                  >
                  </span>
                </li>
              </ListboxOption>
            </ListboxOptions>
          </transition>
        </div>
      </Listbox>
      <Button @click="saveQualification" class="mt-2 bg-pink-400 text-white px-4 py-2 rounded"
        >Сохранить</Button
      >
    </div>

    <div class="bg-white shadow rounded-lg p-4">
      <h2 class="text-xl font-bold">Тип Тап</h2>
      <textarea
        v-model="qualification"
        class="w-full border rounded p-2 mt-2"
        placeholder="Введите квалификацию..."
      ></textarea>
      <Button @click="saveQualification" class="mt-2 bg-pink-400 text-white px-4 py-2 rounded"
        >Сохранить</Button
      >
    </div>

    <div class="bg-white shadow rounded-lg p-4">
      <h2 class="text-xl font-bold">Квалификация</h2>
      <textarea
        v-model="qualification"
        class="w-full border rounded p-2 mt-2"
        placeholder="Введите квалификацию..."
      ></textarea>
      <Button @click="saveQualification" class="mt-2 bg-pink-400 text-white px-4 py-2 rounded"
        >Сохранить</Button
      >
    </div>

    <div class="bg-white shadow rounded-lg p-4 mt-4">
      <h2 class="text-xl font-bold">Образование</h2>
      <textarea
        v-model="education"
        class="w-full border rounded p-2 mt-2"
        placeholder="Введите образование..."
      ></textarea>
      <Button @click="saveEducation" class="mt-2 bg-pink-400 text-white px-4 py-2 rounded"
        >Сохранить</Button
      >
    </div>

    <div class="flex gap-4">
      <div class="bg-white shadow rounded-lg p-4 mt-4 flex-1">
        <h2 class="text-xl font-bold">Запись на приём</h2>

        <input v-model="selectedDate" type="date" class="border rounded p-2 w-full mt-2" />

        <div class="flex flex-wrap gap-2 mt-2">
          <Button
            v-for="time in times"
            :key="time"
            @click="toggleTime(time)"
            :class="{
              'bg-blue-500 text-white': selectedTimes.includes(time),
              'bg-gray-200 text-black': !selectedTimes.includes(time),
            }"
            class="px-4 py-2 rounded hover:text-white"
          >
            {{ time }}
          </Button>
        </div>

        <div class="flex gap-2 mt-4">
          <input v-model="customTime" type="time" class="border rounded p-2 flex-1" />
          <Button
            @click="addCustomTime"
            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded"
            >Добавить</Button
          >
        </div>

        <div class="flex gap-2 mt-2">
          <Button
            @click="clearAppointments"
            class="bg-gray-500 hover:bg-gray-400 text-white px-4 py-2 rounded"
            >Очистить</Button
          >
          <Button @click="saveAppointments" class="bg-pink-400 text-white px-4 py-2 rounded"
            >Сохранить</Button
          >
        </div>
      </div>

      <div class="bg-white shadow rounded-lg p-4 mt-4 flex-1">
        <h2 class="text-xl font-bold">Выбранные даты</h2>
        <div
          v-for="appointment in dateConsultation"
          :key="appointment.id"
          class="border rounded p-4 mt-2"
        >
          <h3 class="font-bold">{{ appointment.day }}</h3>
          <div class="flex flex-wrap gap-2 mt-2">
            <span
              v-for="time in appointment.time"
              :key="time"
              class="bg-gray-200 px-3 py-1 rounded"
              >{{ time }}</span
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { Listbox, ListboxButton, ListboxOptions, ListboxOption } from '@headlessui/vue'
import Button from '@/components/ui/button/Button.vue'

const people = [
  { name: 'Терапевт' },
  { name: 'Педиатор' },
  { name: 'Дерматолог' },
  { name: 'Психолог' },
  { name: 'Гинеколог' },
  { name: 'Кардиолог' },
]
const selectedPerson = ref(people[0])

const router = useRouter()
const goBack = () => router.go(-1)

const qualification = ref('')
const education = ref('')
const selectedDate = ref('')
const selectedTimes = ref([])
const times = ref(['10:00', '13:00', '20:00'])
const customTime = ref('')

const dateConsultation = ref([
  { id: 1, day: '5 февраля', time: ['10:00', '13:00', '20:00', '20:00', '20:00', '20:00'] },
  { id: 2, day: '6 февраля', time: ['11:00', '13:00', '20:00'] },
  { id: 3, day: '7 февраля', time: ['12:00', '13:00', '20:00'] },
  { id: 4, day: '14 февраля', time: ['10:00', '13:00', '20:00'] },
])

const toggleTime = (time) => {
  if (selectedTimes.value.includes(time)) {
    selectedTimes.value = selectedTimes.value.filter((t) => t !== time)
  } else {
    selectedTimes.value.push(time)
  }
}

const addCustomTime = () => {
  if (customTime.value && !times.value.includes(customTime.value)) {
    times.value.push(customTime.value)
    customTime.value = ''
  }
}

const clearAppointments = () => {
  selectedTimes.value = []
  selectedDate.value = ''
}

const saveQualification = () => console.log('Квалификация сохранена:', qualification.value)
const saveEducation = () => console.log('Образование сохранено:', education.value)
const saveAppointments = () => {
  if (!selectedDate.value) {
    console.log('Выберите дату')
    return
  }
  const formattedAppointments = selectedTimes.value.map((time) => {
    return `${selectedDate.value.split('-').reverse().join('.')}:${time}:00`
  })
  console.log('Запись сохранена:', formattedAppointments)
}
</script>

<style scoped>
.bg-white {
  background-color: #fff;
}
.shadow {
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
.rounded {
  border-radius: 8px;
}
.p-4 {
  padding: 1rem;
}
</style>
