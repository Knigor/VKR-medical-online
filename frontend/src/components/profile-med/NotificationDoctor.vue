<template>
  <!-- <div class="fixed inset-0 flex items-center justify-center">
    <button
      type="button"
      @click="openModal"
      class="rounded-md bg-black/20 px-4 py-2 text-sm font-medium text-white hover:bg-black/30 focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75"
    >
      Open dialog
    </button>
  </div> -->
  <TransitionRoot appear :show="isOpen" as="template">
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
              <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">
                Доступные специализации
              </DialogTitle>
              <div class="mt-2">
                <p class="text-sm text-gray-500">
                  Вам нужно выбрать из списка одну из доступных специализаций
                </p>
              </div>

              <div class="mt-2">
                <ul v-for="(item, index) in SpecializationStore.specializationData" :key="index">
                  <li
                    class="cursor-pointer mt-1 hover:bg-pink-200 rounded-xl p-2"
                    @click="copy(item.nameSpecialization)"
                  >
                    {{ item.nameSpecialization }}
                  </li>
                </ul>
                <span v-if="!copied"></span>
                <span class="text-sm text-slate-400 mt-2" v-else>Скопировано!</span>
              </div>

              <div class="mt-4">
                <button
                  type="button"
                  class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                  @click="closeModal"
                >
                  Закрыть
                </button>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle } from '@headlessui/vue'
import { useSpecializationStore } from '@/stores/specializationStore'
import { useClipboard } from '@vueuse/core'
import { useToast } from 'vue-toast-notification'

const toast = useToast()

const SpecializationStore = useSpecializationStore()

const { copy, copied } = useClipboard()

if (copied) toast.success('Скопировано')

defineProps({
  isOpen: Boolean,
})

const emit = defineEmits(['closeModal'])

function closeModal() {
  emit('closeModal')
}
</script>
