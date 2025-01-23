<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { HeartPulse, IdCard } from 'lucide-vue-next'
import { Button } from './components/ui/button'
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'
import { ref } from 'vue'
import AuthModal from '@/components/AuthModal.vue'
import { useRouter } from 'vue-router'
import { useToast } from 'vue-toastification'
const toast = useToast()

const logOut = () => {
  isAuth.value = false
  toast.success('Hello world!')
}

const isAuth = ref(true)
const isModalProfile = ref(false)
const isModalOpen = ref(false) // модальное окно для авторизации

const router = useRouter()

const goToProfile = () => {
  router.push({ name: 'profile' })
}
</script>

<template>
  <div class="flex flex-col min-h-screen">
    <header
      class="flex flex-wrap items-center justify-between h-[146px] ml-[68px] mr-[68px] max-sm:mr-1 max-sm:ml-1 max-sm:justify-start max-sm:gap-4"
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

      <div v-if="isAuth" class="mt-2 flex flex-wrap items-center gap-[5px]">
        <div
          @click="goToProfile"
          class="flex flex-wrap items-center gap-[5px] hover:text-[#F472B6] hover:delay-50"
        >
          <IdCard class="cursor-pointer" size="40" stroke-width="1" />
          <p class="text-base leading-6 font-normal mr-[6px] cursor-pointer font-golos">Профиль</p>
        </div>
        <Avatar @click="isModalProfile = !isModalProfile" class="cursor-pointer h-[40px] w-[40px]">
          <AvatarImage src="/icons/avatar-test.svg" alt="@radix-vue" />
          <AvatarFallback>CN</AvatarFallback>
        </Avatar>

        <div
          v-if="isModalProfile"
          class="w-[234px] h-[90px] shadow-2xl border-[1px] bg-white z-30 top-[110px] right-[70px] absolute stroke-gray-300"
        >
          <div class="flex flex-col ml-[23px] mt-[12px]">
            <p
              class="text-lg leading-7 font-normal text-black mb-[5px] cursor-pointer w-[53px] hover:text-[#F472B6] font-golos"
            >
              Егор
            </p>
            <hr class="w-[187px]" />
            <p
              @click="logOut"
              class="mb-[11px] mt-[11px] text-base leading-6 font-light text-black cursor-pointer w-[49px] hover:text-[#F472B6] font-golos"
            >
              Выйти
            </p>
          </div>
        </div>
      </div>

      <div v-else class="mt-2">
        <Button @click="isModalOpen = true" variant="outline">
          <span class="text-base leading-8 font-light font-golos">Войти</span>
        </Button>
      </div>
    </header>
    <hr class="max-sm:mt-[20px]" />
    <RouterView />
    <footer class="h-[100px] flex items-center justify-center">
      <h1 class="text-gray-400 text-align-center font-golos max-sm:ml-4">
        Выпусканая квалификационная работа для проведения врачебных консультаций в режиме онлайн
      </h1>
    </footer>

    <AuthModal v-model:isModalOpen="isModalOpen" />
  </div>
</template>

<style scoped></style>
