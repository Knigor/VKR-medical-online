<template>
  <div class="flex flex-col mt-[64px]">
    <div class="grid w-[560px] items-center gap-3 mt-[12px]">
      <Label class="font-golos" for="name">Как к вам обращаться?</Label>
      <Input v-model="fio" class="font-golos" id="name" type="name" placeholder="Егор" />
    </div>
    <div class="flex flex-nowrap gap-[40px] mt-[12px]">
      <div class="flex flex-col w-[260px] gap-9">
        <p class="font-golos mt-3">Выберите ваш пол</p>
        <RadioGroup
          v-model="selectedGender"
          class="flex flex-wrap gap-4"
          :disabled="false"
          orientation="horizontal"
          default-value="default"
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
      <div class="grid items-center w-[260px] gap-3 mt-4">
        <label class="font-golos" for="date">Дата рождения</label>
        <div class="relative">
          <input
            v-model="birthdate"
            id="date"
            type="date"
            class="font-golos w-full pl-4 pr-10 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500"
            placeholder="aboba@mail.ru"
          />
        </div>
      </div>
    </div>
    <div class="flex flex-nowrap gap-[40px] mt-[12px]">
      <div v-if="authStore.patientId" class="grid items-center w-[260px] gap-3 mt-4">
        <Label class="font-golos" for="text">Личная карточка пациента</Label>
        <Button class="bg-pink-400" type="button" @click="openModal">Открыть</Button>

        <!-- Модалочка -->
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
                    class="w-full max-w-[800px] transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                  >
                    <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">
                      Личная карточка пациента
                    </DialogTitle>
                    <div class="mt-2">
                      <PacientCard
                        v-model:policeNumber="policeNumber"
                        v-model:allergies="allergies"
                        v-model:chronicDiseases="chronicDiseases"
                        @select-person="handleSelectedPerson"
                      />
                    </div>

                    <div class="mt-4 flex gap-2.5">
                      <button
                        type="button"
                        class="inline-flex justify-center rounded-md border border-transparent bg-pink-400 px-4 py-2 text-sm font-medium text-white hover:bg-pink-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                        @click="handleEditCardPatient"
                      >
                        {{ !isLoading ? 'Сохранить' : '' }}
                        <Loader v-if="isLoading" />
                      </button>

                      <button
                        type="button"
                        class="inline-flex justify-center rounded-md border border-transparent bg-gray-100 px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
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
      </div>

      <div v-else class="grid items-center w-[260px] gap-3 mt-4">
        <Label class="font-golos" for="text">Личная информация доктора</Label>
        <Button @click="router.push(`/onlinePersonal/${authStore.doctorId}`)" class="bg-pink-400"
          >Открыть</Button
        >
      </div>

      <div class="grid items-center w-[260px] gap-3 mt-4">
        <Label class="font-golos" for="email">Логин</Label>
        <Input
          v-model="username"
          class="font-golos"
          id="username"
          type="username"
          placeholder="Kafachok"
        />
      </div>
    </div>

    <div class="flex relative items-end justify-between">
      <div class="grid w-[460px] items-center gap-1.5 mt-[12px]">
        <Label for="picture">Фото профиля</Label>
        <Input @change="handleFileChange" class="mt-1 hover:bg-gray-100" id="picture" type="file" />
      </div>

      <Avatar
        @click="isModalProfile = !isModalProfile"
        class="h-[80px] w-[80px] relative bottom-[-15px]"
      >
        <AvatarImage :src="filePreview || authStore.foto_url" alt="@radix-vue" />
        <AvatarFallback>CN</AvatarFallback>
      </Avatar>
    </div>
    <Button
      @click="handleEditProfile"
      variant="outline"
      :disabled="false"
      type="submit"
      class="font-golos w-full mt-[26px]"
    >
      <Contact class="w-4 h-4 mr-2" /> {{ !isLoading ? 'Сохранить изменения' : '' }}
      <Loader v-if="isLoading" />
    </Button>
  </div>
</template>

<script setup>
import { Contact } from 'lucide-vue-next'
import { ref } from 'vue'
import { Label } from '@/components/ui/label'
import { RadioGroup, RadioGroupItem } from '@/components/ui/radio-group'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'
import { useAuthStore } from '@/stores/authStore'
import { useProfile } from '@/composables/profile/useProfile'
import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle } from '@headlessui/vue'
import { useToast } from 'vue-toastification'
import PacientCard from './profile-med/PacientCard.vue'
import { usePatientCardStore } from '@/stores/patientCardStore'
import { usePatientCard } from '@/composables/patient-card/usePatientCard'
import { useRouter } from 'vue-router'
import Loader from '@/components/Loader.vue'
const isOpen = ref(false)

const router = useRouter()
const toast = useToast()

const { editProfile } = useProfile()
const { editPatientCard } = usePatientCard()

function closeModal() {
  isOpen.value = false
}
function openModal() {
  isOpen.value = true
}

const authStore = useAuthStore()
const username = ref(authStore.userName)
const fio = ref(authStore.fio)
const selectedGender = ref(authStore.gender)
const birthdate = ref(authStore.birthdate)
const file = ref(null)
const filePreview = ref(null)
const handleFileChange = (event) => {
  const selectedFile = event.target.files[0]
  if (selectedFile) {
    file.value = selectedFile
    filePreview.value = URL.createObjectURL(selectedFile)
  }
}

const patientCardStore = usePatientCardStore()

// карточка пациента

const selectedPerson = ref(patientCardStore.blood_type)
const allergies = ref(patientCardStore.allergies)
const chronicDiseases = ref(patientCardStore.chronic_conditions)
const policeNumber = ref(patientCardStore.policy_number)

const handleSelectedPerson = (person) => {
  selectedPerson.value = person
  console.log('Выбранный человек:', selectedPerson.value)
}
// лоадер
const isLoading = ref(false)

const handleEditCardPatient = async () => {
  isOpen.value = true
  isLoading.value = true
  try {
    const formData = new FormData()
    formData.append('userId', authStore.id)
    formData.append('patientId', authStore.patientId)
    formData.append('blood_type', selectedPerson.value)
    formData.append('allergies', allergies.value)
    formData.append('chronic_conditions', chronicDiseases.value)
    formData.append('policy_number', policeNumber.value)

    await editPatientCard(formData)

    isOpen.value = false

    toast.success('Карточка пациента успешно обновлена')
  } catch (error) {
    console.error(error)
    toast.error('Произошла ошибка при обновлении карточки пациента')
  } finally {
    isLoading.value = false
  }
}

const handleEditProfile = async () => {
  try {
    isLoading.value = true
    const formData = new FormData()
    formData.append('userId', authStore.id)
    formData.append('gender', selectedGender.value)
    formData.append('username', username.value)
    formData.append('fio', fio.value)

    if (birthdate.value) {
      formData.append('birthdate', birthdate.value)
    }

    if (file.value) {
      formData.append('photo_user', file.value)
    }

    await editProfile(formData)

    toast.success('Профиль успешно обновлен')
  } catch (error) {
    console.error(error)
    toast.error('Произошла ошибка при обновлении профиля')
  } finally {
    isLoading.value = false
  }
}
</script>

<style lang="scss" scoped></style>
