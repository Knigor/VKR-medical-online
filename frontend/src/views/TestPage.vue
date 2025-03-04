<template>
  <div
    ref="editableDiv"
    class="border p-4 w-[800px] rounded-lg bg-white relative"
    contenteditable="true"
    @input="handleInput"
    @click="handleClick"
  >
    <!-- Пример текста с динамическим input -->
    <span class="text-black">Это обычный текст, а вот </span>
    <span class="relative">
      <input
        v-if="isEditing"
        v-model="inputText"
        type="text"
        placeholder="Вставьте текст"
        class="bg-blue-100 text-[#045CFB] border w-full placeholder:text-[#045CFB66] border-blue-400 rounded-3xl px-[6px] py-[2px] focus:ring-0 focus:outline-none resize-none"
        @blur="stopEditing"
        :style="inputStyle"
        rows="1"
      />
      <span
        v-else
        @click="startEditing"
        class="bg-blue-100 border px-[6px] text-center text-[#045CFB] border-blue-400 rounded-3xl"
      >
        {{ inputText || 'Вставьте текст' }}
      </span>
    </span>
    <span class="text-black"> продолжается обычный текст.</span>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const inputText = ref('') // Текст внутри инпута
const isEditing = ref(false) // Флаг для отслеживания редактирования

// Динамическое вычисление стилей для инпута
const inputStyle = computed(() => {
  const width = inputText.value.length ? `${inputText.value.length + 3}ch` : 'auto'
  return {
    minWidth: '10ch',
    width: width,
    whiteSpace: 'pre-wrap',
    wordWrap: 'break-word',
  }
})

const handleInput = (event) => {
  // Обработка ввода
  console.log(event.target.value)
}

const startEditing = () => {
  isEditing.value = true
}

const stopEditing = () => {
  isEditing.value = false
}
</script>

<style scoped>
/* Убираем стандартную обводку при выделении */
input:focus {
  outline: none; /* Убираем обводку по умолчанию */
  box-shadow: none; /* Убираем тень при фокусе */
}
</style>
