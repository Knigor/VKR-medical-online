<template>
  <div>
    <div v-if="messages.length">
      <div v-for="(message, index) in messages" :key="index" class="mb-4">
        <div
          :class="{
            ' items-end mr-4': message.isSentByUser,
            ' items-start ': !message.isSentByUser,
          }"
          class="flex flex-col gap-2"
        >
          <p class="text-gray-600 text-sm">
            {{ message.senderName }} - {{ formatTime(message.timestamp) }}
          </p>
          <div
            :class="{
              'bg-blue-100 text-blue-900 ': message.isSentByUser,
              'bg-gray-200 text-gray-900 ': !message.isSentByUser,
            }"
            class="p-2 rounded-lg max-w-xs flex"
          >
            <p v-if="message.text">{{ message.text }}</p>
            <img v-if="message.imageUrl" :src="message.imageUrl" class="w-40 h-40 rounded-lg" />
          </div>
        </div>
      </div>
    </div>
    <div v-else>
      <p>В данном чате еще нету сообщений, отправьте сообщение первым</p>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue'

const props = defineProps({
  messages: Array,
})

// Функция для форматирования времени
const formatTime = (timestamp) => {
  const date = new Date(timestamp)
  return `${date.getHours()}:${String(date.getMinutes()).padStart(2, '0')}`
}
</script>
