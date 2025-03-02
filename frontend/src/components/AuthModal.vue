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
          <form @submit.prevent="handleRegister" class="space-y-4">
            <div class="grid w-full max-w-sm items-center gap-3">
              <Label class="font-golos" for="email">Введите ваш email</Label>
              <Input
                v-model="email"
                class="font-golos"
                id="email"
                type="email"
                placeholder="aboba@mail.ru"
              />
            </div>

            <div class="grid w-full max-w-sm items-center gap-3">
              <Label class="font-golos" for="login">Введите ваш логин</Label>
              <Input
                v-model="usernameRegister"
                class="font-golos"
                id="login"
                type="login"
                placeholder="Kafachok"
              />
            </div>

            <div class="grid w-full max-w-sm items-center gap-3">
              <Label class="font-golos" for="fio">Введите ваше ФИО</Label>
              <Input
                v-model="fio"
                class="font-golos"
                id="fio"
                type="fio"
                placeholder="Борис Кислый Борисович"
              />
            </div>
            <div class="flex flex-wrap gap-6">
              <div class="flex flex-col gap-4">
                <p class="font-golos">Выберите вашу роль</p>
                <RadioGroup
                  v-model="selectedRole"
                  class="flex flex-wrap"
                  :disabled="false"
                  orientation="horizontal"
                  default-value="ROLE_USER"
                >
                  <div class="flex items-center space-x-2">
                    <RadioGroupItem id="r1" value="ROLE_USER" />
                    <Label class="font-golos" for="r1">Пациент</Label>
                  </div>
                  <div class="flex items-center space-x-2">
                    <RadioGroupItem id="r2" value="ROLE_DOCTOR" />
                    <Label class="font-golos" for="r2">Врач</Label>
                  </div>
                </RadioGroup>
              </div>

              <div class="flex flex-col gap-4">
                <p class="font-golos">Выберите ваш пол</p>
                <RadioGroup
                  v-model="selectedGender"
                  class="flex flex-wrap"
                  :disabled="false"
                  orientation="horizontal"
                  default-value="male"
                >
                  <div class="flex items-center space-x-2">
                    <RadioGroupItem id="r3" value="male" />
                    <Label class="font-golos" for="r3">Мужской</Label>
                  </div>
                  <div class="flex items-center space-x-2">
                    <RadioGroupItem id="r4" value="female" />
                    <Label class="font-golos" for="r4">Женский</Label>
                  </div>
                </RadioGroup>
              </div>
            </div>

            <div class="grid w-full max-w-sm items-center gap-3">
              <Label class="font-golos" for="password">Введите пароль</Label>
              <Input
                v-model="passwordRegister"
                class="font-golos"
                id="password"
                type="password"
                placeholder="••••••••"
              />
            </div>

            <div class="flex items-center space-x-2">
              <Checkbox @click="terms = !terms" color="#F472B6" id="terms" />
              <Label class="font-golos" for="terms"
                >Согласен на обработку персональных данных</Label
              >
            </div>
            <Button :disabled="isDisabledRegister" type="submit" class="font-golos w-full">
              <div v-if="isLoadingRegister" class="pr-2" role="status">
                <div class="flex flex-wrap gap-2 items-center">
                  <svg
                    aria-hidden="true"
                    class="inline w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-purple-600"
                    viewBox="0 0 100 101"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                      fill="currentColor"
                    />
                    <path
                      d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                      fill="currentFill"
                    />
                  </svg>

                  <span class="font-golos">Регистрация...</span>
                </div>
              </div>
              <div v-else class="flex"><Contact class="w-4 h-4 mr-2" /> Зарегестрироваться</div>
            </Button>

            <div
              v-if="isError"
              class="font-golos text-sm font-medium text-red-500 dark:text-gray-300"
            >
              Проверьть правильность логина и пароля, а так же уникальность
              <span
                class="font-golos text-red-400 hover:underline dark:text-blue-500 cursor-pointer"
              >
                Подробнее
              </span>
            </div>

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
          <form class="space-y-4" @submit.prevent="handleLogin">
            <div class="grid w-full max-w-sm items-center gap-3">
              <Label class="font-golos" for="username">Введите ваш логин</Label>
              <Input
                v-model="username"
                class="font-golos"
                id="username"
                type="username"
                placeholder="Введите ваш логин"
              />
            </div>
            <div class="grid w-full max-w-sm items-center gap-3">
              <Label class="font-golos" for="password">Введите пароль</Label>
              <Input
                v-model="password"
                class="font-golos placeholder-gray-300"
                id="password"
                type="password"
                placeholder="Введите ваш пароль"
              />
            </div>

            <Button :disabled="isDisabled" type="submit" class="font-golos w-full">
              <div v-if="isLoading" class="pr-2" role="status">
                <div class="flex flex-wrap gap-2 items-center">
                  <svg
                    aria-hidden="true"
                    class="inline w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-purple-600"
                    viewBox="0 0 100 101"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                      fill="currentColor"
                    />
                    <path
                      d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                      fill="currentFill"
                    />
                  </svg>

                  <span class="font-golos">Авторизация...</span>
                </div>
              </div>
              <div v-else class="flex"><Contact class="w-4 h-4 mr-2" /> Войти</div>
            </Button>

            <div
              v-if="isError"
              class="font-golos text-sm font-medium text-red-500 dark:text-gray-300"
            >
              Проверьть правильность логина и пароля, а так же уникальность
              <span
                class="font-golos text-red-400 hover:underline dark:text-blue-500 cursor-pointer"
              >
                Подробнее
              </span>
            </div>

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
import { ref, watch } from 'vue'
import { Checkbox } from '@/components/ui/checkbox'
import { Label } from '@/components/ui/label'
import { RadioGroup, RadioGroupItem } from '@/components/ui/radio-group'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'

const registerModalOpen = defineModel('registerModalOpen', false)

defineProps({
  isModalOpen: Boolean,
  isError: Boolean,
})

const emit = defineEmits(['update:isModalOpen', 'login', 'register'])

const closeModal = () => {
  emit('update:isModalOpen', false)
}
// Авторизация
const username = defineModel('username')
const password = defineModel('password')
const isLoading = defineModel('isLoading')
const isDisabled = ref(true)

watch(
  [username, password],
  ([newUsername, newPassword]) => {
    isDisabled.value = !newUsername || !newPassword
  },
  { immediate: true },
)

const handleLogin = () => {
  emit('login', { username: username.value, password: password.value })
}

// регистрация

const passwordRegister = defineModel('passwordRegister')
const usernameRegister = defineModel('usernameRegister')
const email = defineModel('emailRegister')
const selectedRole = defineModel('selectedRole')
const selectedGender = defineModel('selectedGender')
const fio = defineModel('fio')
const isLoadingRegister = defineModel('isLoadingRegister')
const isDisabledRegister = ref(true)
const terms = ref(false)

const handleRegister = () => {
  emit('register', {
    username: usernameRegister.value,
    password: passwordRegister.value,
    email: email.value,
    role: selectedRole.value,
    gender: selectedGender.value,
    fio: fio.value,
  })
}

watch(
  [passwordRegister, usernameRegister, email, selectedRole, selectedGender, fio, terms],
  ([newPassword, newUsername, newEmail, newRole, newGender, newFio, newTerms]) => {
    isDisabledRegister.value =
      !newPassword || !newUsername || !newEmail || !newRole || !newGender || !newFio || !newTerms
  },
  { immediate: true },
)
</script>

<style scoped></style>
