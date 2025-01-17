<template>
  <!-- Main modal -->

  <div
    v-if="isModalOpen"
    class="fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-[calc(100%-0rem)] max-h-full bg-black bg-opacity-50"
  >
    <!-- Окно для регистрации-->

    <div v-if="registerModalOpen" class="relative p-4 w-full max-w-md max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <!-- Modal header -->
        <div
          class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600"
        >
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white font-golos">
            Зарегестрироваться
          </h3>
          <button
            @click="closeModal"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
          >
            <svg
              class="w-3 h-3"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 14 14"
            >
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
              />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <div class="p-4 md:p-5">
          <form class="space-y-4" action="#">
            <div class="grid w-full max-w-sm items-center gap-3">
              <Label class="font-golos" for="email">Введите ваш email</Label>
              <Input class="font-golos" id="email" type="email" placeholder="aboba@mail.ru" />
            </div>

            <div class="grid w-full max-w-sm items-center gap-3">
              <Label class="font-golos" for="login">Введите ваш логин</Label>
              <Input class="font-golos" id="login" type="login" placeholder="Kafachok" />
            </div>

            <div class="grid w-full max-w-sm items-center gap-3">
              <Label class="font-golos" for="fio">Введите ваше ФИО</Label>
              <Input class="font-golos" id="fio" type="fio" placeholder="Борис Кислый Борисович" />
            </div>
            <div class="flex flex-wrap gap-6">
              <div class="flex flex-col gap-4">
                <p class="font-golos">Выберите вашу роль</p>
                <RadioGroup
                  class="flex flex-wrap"
                  :disabled="false"
                  orientation="horizontal"
                  default-value="default"
                >
                  <div class="flex items-center space-x-2">
                    <RadioGroupItem id="r1" value="default" />
                    <Label class="font-golos" for="r1">Пациент</Label>
                  </div>
                  <div class="flex items-center space-x-2">
                    <RadioGroupItem id="r2" value="comfortable" />
                    <Label class="font-golos" for="r2">Врач</Label>
                  </div>
                </RadioGroup>
              </div>

              <div class="flex flex-col gap-4">
                <p class="font-golos">Выберите ваш пол</p>
                <RadioGroup
                  class="flex flex-wrap"
                  :disabled="false"
                  orientation="horizontal"
                  default-value="default"
                >
                  <div class="flex items-center space-x-2">
                    <RadioGroupItem id="r1" value="default" />
                    <Label class="font-golos" for="r1">Мужской</Label>
                  </div>
                  <div class="flex items-center space-x-2">
                    <RadioGroupItem id="r2" value="comfortable" />
                    <Label class="font-golos" for="r2">Женский</Label>
                  </div>
                </RadioGroup>
              </div>
            </div>

            <div class="grid w-full max-w-sm items-center gap-3">
              <Label class="font-golos" for="password">Введите пароль</Label>
              <Input class="font-golos" id="password" type="password" placeholder="••••••••" />
            </div>

            <div class="flex items-center space-x-2">
              <Checkbox color="#F472B6" id="terms" />
              <Label class="font-golos" for="terms"
                >Согласен на обработку персональных данных</Label
              >
            </div>
            <!-- <div class="flex justify-between">
                <div class="flex items-start">
                  <div class="flex items-center h-5">
                    <input
                      id="remember"
                      type="checkbox"
                      value=""
                      class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                      required
                    />
                  </div>
                  <label
                    for="remember"
                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                    >Remember me</label
                  >
                </div>
                <a href="#" class="text-sm text-blue-700 hover:underline dark:text-blue-500"
                  >Lost Password?</a
                >
              </div> -->
            <Button :disabled="true" type="submit" class="font-golos w-full">
              <Contact class="w-4 h-4 mr-2" /> Зарегестрироваться
            </Button>

            <div class="font-golos text-sm font-medium text-gray-500 dark:text-gray-300">
              Уже есть аккаут?
              <span
                @click="registerModalOpen = false"
                class="font-golos text-slate-400 hover:underline dark:text-blue-500 cursor-pointer"
                >Авторизоваться</span
              >
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Окно для Авторизации-->

    <div v-else class="relative p-4 w-full max-w-md max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <!-- Modal header -->
        <div
          class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600"
        >
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white font-golos">
            Войдите в аккаунт
          </h3>
          <button
            @click="closeModal"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
          >
            <svg
              class="w-3 h-3"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 14 14"
            >
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
              />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <div class="p-4 md:p-5">
          <form class="space-y-4" action="#">
            <div class="grid w-full max-w-sm items-center gap-3">
              <Label class="font-golos" for="email">Введите ваш email</Label>
              <Input class="font-golos" id="email" type="email" placeholder="aboba@mail.ru" />
            </div>
            <div class="grid w-full max-w-sm items-center gap-3">
              <Label class="font-golos" for="password">Введите пароль</Label>
              <Input class="font-golos" id="password" type="password" placeholder="••••••••" />
            </div>

            <!-- <div class="flex justify-between">
                <div class="flex items-start">
                  <div class="flex items-center h-5">
                    <input
                      id="remember"
                      type="checkbox"
                      value=""
                      class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                      required
                    />
                  </div>
                  <label
                    for="remember"
                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                    >Remember me</label
                  >
                </div>
                <a href="#" class="text-sm text-blue-700 hover:underline dark:text-blue-500"
                  >Lost Password?</a
                >
              </div> -->
            <Button :disabled="false" type="submit" class="font-golos w-full">
              <Contact class="w-4 h-4 mr-2" /> Войти
            </Button>

            <div class="font-golos text-sm font-medium text-gray-500 dark:text-gray-300">
              Нет аккаунт?
              <span
                @click="registerModalOpen = true"
                class="font-golos text-slate-400 hover:underline dark:text-blue-500 cursor-pointer"
              >
                Зарегестрироваться
              </span>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Contact } from 'lucide-vue-next'
import { ref } from 'vue'
import { Checkbox } from '@/components/ui/checkbox'
import { Label } from '@/components/ui/label'
import { RadioGroup, RadioGroupItem } from '@/components/ui/radio-group'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'

const registerModalOpen = ref(false)

defineProps({
  isModalOpen: Boolean,
})

const emit = defineEmits(['update:isModalOpen'])

const closeModal = () => {
  emit('update:isModalOpen', false)
}
</script>

<style lang="scss" scoped></style>
