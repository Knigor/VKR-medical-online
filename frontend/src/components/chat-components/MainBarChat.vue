<template>
  <div class="flex flex-col gap-4 mr-4">
    <div
      v-for="message in messages"
      :key="message.id"
      :class="[
        message.isSentByUser ? 'self-end' : 'self-start',
        'max-w-xs p-3 rounded-lg',
        message.isSentByUser ? 'bg-blue-500 text-white' : 'bg-gray-200 text-black',
      ]"
    >
      <template v-if="message.type === 'text'">
        <div class="text-sm">{{ message.text }}</div>
      </template>

      <template v-else-if="message.type === 'image'">
        <img
          :src="message.imageUrl"
          class="max-w-xs rounded-lg pr-6"
          alt="Отправленное изображение"
        />
      </template>
    </div>
  </div>
</template>

<script setup>
defineProps({
  messages: {
    type: Array,
    required: true,
  },
})
</script>
