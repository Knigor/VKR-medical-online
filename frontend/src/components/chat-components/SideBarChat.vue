<template>
  <div class="flex flex-col gap-2">
    <div
      v-for="user in users"
      :key="user.id"
      class="flex items-center p-2 rounded-lg hover:bg-gray-200 cursor-pointer"
    >
      <div class="w-10 h-10 bg-blue-300 rounded-full flex items-center justify-center text-white">
        {{ user.name[0] }}
      </div>
      <div class="ml-4 text-sm font-medium">{{ user.name }}</div>
    </div>
  </div>
</template>

<script setup>
const users = [
  { id: 1, name: 'Иван' },
  { id: 2, name: 'Мария' },
  { id: 3, name: 'Алексей' },
  { id: 4, name: 'Екатерина' },
]
</script>
