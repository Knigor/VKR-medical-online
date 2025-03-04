<template>
  <div class="editor-container">
    <editor-content :editor="editor" class="tiptap" />
  </div>
</template>

<script>
import StarterKit from '@tiptap/starter-kit'
import { Editor, EditorContent } from '@tiptap/vue-3'
import { InputNode } from './InputNode' // Импортируем кастомный узел

export default {
  components: {
    EditorContent,
  },

  props: {
    modelValue: {
      type: String,
      default: '',
    },
  },

  emits: ['update:modelValue'],

  data() {
    return {
      editor: null,
    }
  },

  watch: {
    modelValue(value) {
      const isSame = this.editor.getHTML() === value
      if (isSame) return
      this.editor.commands.setContent(value, false)
    },
  },

  mounted() {
    this.editor = new Editor({
      extensions: [
        StarterKit,
        InputNode, // Добавляем кастомный узел
      ],
      content: this.modelValue,
      onUpdate: () => {
        this.$emit('update:modelValue', this.editor.getHTML())
      },
    })
  },

  beforeUnmount() {
    this.editor.destroy()
  },
}
</script>

<style lang="scss">
.editor-container {
  .tiptap {
    min-height: 200px;
    border: 1px solid #e2e8f0;
    border-radius: 0.375rem;
    padding: 1rem;

    :first-child {
      margin-top: 0;
    }

    .custom-input {
      border: 1px solid #cbd5e0;
      border-radius: 0.25rem;
      padding: 0.25rem 0.5rem;
      background-color: #f7fafc;
      color: #2d3748;
      display: inline-block;
      min-width: 100px; // Минимальная ширина инпута
    }
  }
}
</style>
