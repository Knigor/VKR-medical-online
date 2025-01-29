<template>
  <div class="flex flex-col mt-[64px]">
    <div class="grid w-[560px] items-center gap-3 mt-[12px]">
      <Label class="font-golos" for="name">Как к вам обращаться?</Label>
      <Input class="font-golos" id="name" type="name" placeholder="Егор" />
    </div>
    <div class="flex flex-nowrap gap-[40px] mt-[12px]">
      <div class="flex flex-col w-[260px] gap-9">
        <p class="font-golos mt-3">Выберите ваш пол</p>
        <RadioGroup
          class="flex flex-wrap gap-4"
          :disabled="false"
          orientation="horizontal"
          default-value="default"
        >
          <div class="flex items-center space-x-2">
            <RadioGroupItem id="r3" value="default" />
            <Label class="font-golos" for="r3">Мужской</Label>
          </div>
          <div class="flex items-center space-x-2">
            <RadioGroupItem id="r4" value="comfortable" />
            <Label class="font-golos" for="r4">Женский</Label>
          </div>
        </RadioGroup>
      </div>
      <div class="grid items-center w-[260px] gap-3 mt-4">
        <label class="font-golos" for="date">Дата рождения</label>
        <div class="relative">
          <input
            id="date"
            type="date"
            class="font-golos w-full pl-4 pr-10 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500"
            placeholder="aboba@mail.ru"
          />
        </div>
      </div>
    </div>
    <div class="flex flex-nowrap gap-[40px] mt-[12px]">
      <div class="grid items-center w-[260px] gap-3 mt-4">
        <Label class="font-golos" for="number">Телефон</Label>
        <Input
          class="font-golos"
          id="number"
          type="text"
          v-model="formattedPhone"
          placeholder="+7 (XXX) XXX-XX-XX"
          @input="handleInput"
        />
      </div>
      <div class="grid items-center w-[260px] gap-3 mt-4">
        <Label class="font-golos" for="email">Email</Label>
        <Input class="font-golos" id="email" type="email" placeholder="aboba@mail.ru" />
      </div>
    </div>

    <div class="flex relative items-end justify-between">
      <div class="grid w-[460px] items-center gap-1.5 mt-[12px]">
        <Label for="picture">Фото профиля</Label>
        <Input class="mt-1 hover:bg-gray-100 cursor-pointer" id="picture" type="file" />
      </div>

      <Avatar
        @click="isModalProfile = !isModalProfile"
        class="h-[80px] w-[80px] relative bottom-[-15px]"
      >
        <AvatarImage src="/icons/avatar-test.svg" alt="@radix-vue" />
        <AvatarFallback>CN</AvatarFallback>
      </Avatar>
    </div>
    <Button variant="outline" :disabled="false" type="submit" class="font-golos w-full mt-[26px]">
      <Contact class="w-4 h-4 mr-2" /> Сохранить изменения
    </Button>
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
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'

const formattedPhone = ref('') // Хранит отформатированный номер
</script>

<style lang="scss" scoped></style>
