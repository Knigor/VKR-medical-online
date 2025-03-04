<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { HeartPulse, IdCard } from 'lucide-vue-next'
import { Button } from './components/ui/button'
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'
import { ref, onMounted } from 'vue'
import AuthModal from '@/components/AuthModal.vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from './stores/authStore'
import { useAuth } from './composables/auth/useAuth'
import { usePatientCard } from './composables/patient-card/usePatientCard'
import { useSpecialization } from './composables/specialization/useSpecialization'

const authStore = useAuthStore()

const { logout, login, register } = useAuth()
const isModalProfile = ref(false)
const isModalOpen = ref(false) // модальное окно для авторизации
const isError = ref(false)
const router = useRouter()
const registerModalOpen = ref(false)

const { getPatientCard } = usePatientCard()
const { getSpecialization } = useSpecialization()

onMounted(async () => {
  if (authStore.accessToken) {
    try {
      isLoadingMain.value = true

      await Promise.all([
        getSpecialization(),
        authStore.patientId ? getPatientCard() : Promise.resolve(),
      ])
    } catch (error) {
      console.error('Ошибка при загрузке данных:', error)
    } finally {
      isLoadingMain.value = false
    }
  }
})

const isLoadingMain = ref(false)

// авторизация
const username = ref('')
const password = ref('')
const isLoading = ref(false)

const handleLogin = async (body) => {
  isLoading.value = true
  isError.value = false

  try {
    await login(body)
    isModalOpen.value = false
    username.value = ''
    password.value = ''

    isLoadingMain.value = true

    await Promise.all([
      getSpecialization(),
      authStore.patientId ? getPatientCard() : Promise.resolve(),
    ])
  } catch (error) {
    console.error(error, 'абоба')
    isError.value = true
  } finally {
    isLoading.value = false
    isLoadingMain.value = false
  }
}

// регистрация

const passwordRegister = ref('')
const usernameRegister = ref('')
const emailRegister = ref('')
const selectedRole = ref('')
const selectedGender = ref('')
const fio = ref('')
const isLoadingRegister = ref(false)

const handleRegister = async (body) => {
  isLoadingRegister.value = true
  isError.value = false
  try {
    await register(body)
    usernameRegister.value = ''
    passwordRegister.value = ''
    emailRegister.value = ''
    selectedRole.value = ''
    selectedGender.value = ''
    fio.value = ''
    registerModalOpen.value = false
  } catch (error) {
    console.error(error, 'абоба')
    isError.value = true
  } finally {
    isLoadingRegister.value = false
  }
}

const handleLogOut = () => {
  logout()
}

const goToProfile = () => {
  router.push({ name: 'profile' })
}
</script>

<template>
  <div class="flex flex-col min-h-screen">
    <header
      class="flex flex-wrap items-center justify-between max-h-[146px] h-[146px] ml-[68px] mr-[68px] max-sm:mr-1 max-sm:ml-1 max-sm:justify-start max-sm:gap-4"
    >
      <div class="flex flex-wrap items-center gap-[5px]">
        <HeartPulse size="40" color="#F472B6" />
        <RouterLink to="/">
          <h1
            class="text-3xl font-golos leading-9 font-semibold sm:text-3xl lg:text-4xl sm:leading-9 lg:leading-10"
          >
            Твоё здоровье
          </h1>
        </RouterLink>
      </div>

      <div v-if="authStore.id !== null" class="mt-2 flex flex-wrap items-center gap-[5px]">
        <div
          @click="goToProfile"
          class="flex flex-wrap items-center gap-[5px] hover:text-[#F472B6] hover:delay-50"
        >
          <IdCard class="cursor-pointer" size="40" stroke-width="1" />
          <p class="text-base leading-6 font-normal mr-[6px] cursor-pointer font-golos">Профиль</p>
        </div>
        <Avatar @click="isModalProfile = !isModalProfile" class="cursor-pointer h-[40px] w-[40px]">
          <AvatarImage :src="authStore.foto_url" alt="@radix-vue" />
          <AvatarFallback>CN</AvatarFallback>
        </Avatar>

        <div
          v-if="isModalProfile"
          class="w-[234px] h-[90px] shadow-2xl border-[1px] bg-white z-30 top-[110px] right-[70px] absolute stroke-gray-300"
        >
          <div class="flex flex-col ml-[23px] mt-[12px]">
            <p
              class="text-lg leading-7 font-normal text-black mb-[5px] cursor-pointer hover:text-[#F472B6] font-golos"
            >
              {{ authStore.fio.split(' ')[0] }} {{ authStore.fio.split(' ')[1] }}
            </p>
            <hr class="w-[187px]" />
            <p
              @click="handleLogOut"
              class="mb-[11px] mt-[11px] text-base leading-6 font-light text-black cursor-pointer w-[49px] hover:text-[#F472B6] font-golos"
            >
              Выйти
            </p>
          </div>
        </div>
      </div>

      <div v-else class="mt-2">
        <Button @click="isModalOpen = !isModalOpen" variant="outline">
          <span class="text-base leading-8 font-light font-golos">Войти</span>
        </Button>
      </div>
    </header>
    <hr class="max-sm:mt-[20px]" />

    <div v-if="isLoadingMain" class="justify-center items-center flex" role="status">
      <svg
        aria-hidden="true"
        class="w-14 h-14 text-gray-200 animate-spin dark:text-gray-600 fill-pink-600"
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
      <span class="sr-only">Loading...</span>
    </div>
    <RouterView v-else />
    <footer class="h-[100px] flex items-center justify-center">
      <h1 class="text-gray-400 text-align-center font-golos max-sm:ml-4">
        Выпусканая квалификационная работа для проведения врачебных консультаций в режиме онлайн
      </h1>
    </footer>

    <AuthModal
      v-model:is-loading="isLoading"
      v-model:password="password"
      v-model:username="username"
      v-model:selectedGender="selectedGender"
      v-model:selectedRole="selectedRole"
      v-model:fio="fio"
      v-model:passwordRegister="passwordRegister"
      v-model:usernameRegister="usernameRegister"
      v-model:emailRegister="emailRegister"
      v-model:isLoadingRegister="isLoadingRegister"
      @login="handleLogin"
      @register="handleRegister"
      v-model:registerModalOpen="registerModalOpen"
      v-model:isModalOpen="isModalOpen"
      v-model:isError="isError"
    />
  </div>
</template>

<style scoped></style>
