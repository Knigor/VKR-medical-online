<template>
  <div>
    <!-- Полис (Номер) -->
    <div class="mb-4">
      <label for="policeNumber" class="block text-sm font-medium text-gray-700">Номер полиса</label>
      <Input
        id="policeNumber"
        v-model="policeNumber"
        type="text"
        class="mt-2 p-1.5 block w-full rounded-md shadow-sm sm:text-sm"
        placeholder="Введите номер полиса"
      />
    </div>

    <!-- Группа крови -->
    <div class="mb-4">
      <label for="bloodType" class="block text-sm font-medium text-gray-700">Группа крови</label>
      <Listbox v-model="selectedPerson" @update:modelValue="emitSelection">
        <div class="relative mt-1">
          <ListboxButton
            class="relative w-full cursor-default rounded-lg bg-white py-2 pl-3 pr-10 text-left border focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white/75 focus-visible:ring-offset-2 focus-visible:ring-offset-pink-300 sm:text-sm"
          >
            <span class="block truncate">{{ selectedPerson }}</span>
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
                :key="person"
                :value="person"
                as="template"
              >
                <li
                  :class="[
                    active ? 'bg-pink-100 text-pink-900' : 'text-gray-900',
                    'relative cursor-default select-none py-2 pl-10 pr-4',
                  ]"
                >
                  <span :class="[selected ? 'font-medium' : 'font-normal', 'block truncate']">
                    {{ person }}
                  </span>
                  <span
                    v-if="selected"
                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-amber-600"
                  >
                  </span>
                </li>
              </ListboxOption>
            </ListboxOptions>
          </transition>
        </div>
      </Listbox>
    </div>

    <!-- Аллергии -->
    <div class="mb-4">
      <label for="allergies" class="block text-sm font-medium text-gray-700">Аллергии</label>
      <textarea
        id="allergies"
        v-model="allergies"
        rows="3"
        class="mt-1 p-2 block w-full rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        placeholder="Перечислите аллергии (если есть)"
      ></textarea>
    </div>

    <!-- Хронические заболевания -->
    <div class="mb-4">
      <label for="chronicDiseases" class="block text-sm font-medium text-gray-700"
        >Хронические заболевания</label
      >
      <textarea
        id="chronicDiseases"
        v-model="chronicDiseases"
        rows="3"
        class="mt-1 p-2 block w-full border rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        placeholder="Перечислите хронические заболевания (если есть)"
      ></textarea>
    </div>
  </div>
</template>

<script setup>
import { Input } from '@/components/ui/input'
import { Listbox, ListboxButton, ListboxOptions, ListboxOption } from '@headlessui/vue'
import { ref, defineEmits } from 'vue'

const people = ['O-', 'O+', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-']

const emit = defineEmits(['select-person'])

const selectedPerson = ref(people[0])

const emitSelection = (value) => {
  emit('select-person', value)
}

const allergies = defineModel('allergies')
const chronicDiseases = defineModel('chronicDiseases')
const policeNumber = defineModel('policeNumber')
</script>

<style scoped></style>
