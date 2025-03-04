import { Node } from '@tiptap/core'

export const InputNode = Node.create({
  name: 'inputNode', // Имя узла
  group: 'inline', // Группа (inline, block и т.д.)
  content: 'text*', // Содержимое узла
  inline: true, // Инлайновый элемент
  atom: true, // Атомарный элемент (не разбивается на части)

  // Добавляем атрибуты для инпута
  addAttributes() {
    return {
      value: {
        default: '', // Значение по умолчанию
      },
    }
  },

  // Парсинг HTML
  parseHTML() {
    return [
      {
        tag: 'span[data-type="input"]', // Ищем span с атрибутом data-type="input"
        getAttrs: (dom) => ({
          value: dom.getAttribute('data-value'), // Получаем значение из атрибута data-value
        }),
      },
    ]
  },

  // Рендеринг HTML
  renderHTML({ node }) {
    return [
      'span',
      {
        'data-type': 'input', // Добавляем атрибут data-type
        'data-value': node.attrs.value, // Добавляем значение
        class: 'custom-input', // Класс для стилизации
      },
      node.attrs.value || 'Введите текст', // Отображаемое значение
    ]
  },

  // Создаем NodeView для инпута
  addNodeView() {
    return ({ node, editor, getPos }) => {
      const input = document.createElement('input') // Создаем элемент input
      input.value = node.attrs.value || '' // Устанавливаем значение
      input.classList.add('custom-input') // Добавляем класс для стилизации

      // Обработчик изменения значения
      input.addEventListener('input', (event) => {
        const value = event.target.value
        editor.commands.updateAttributes('inputNode', { value }) // Обновляем атрибуты узла
      })

      // Обработчик клика (для фокуса)
      input.addEventListener('click', (event) => {
        event.stopPropagation() // Останавливаем всплытие события
        input.focus() // Фокусируемся на инпуте
      })

      // Обработчик фокуса (для синхронизации с редактором)
      input.addEventListener('focus', () => {
        editor.commands.focus() // Передаем фокус редактору
      })

      return {
        dom: input, // Возвращаем input как DOM-элемент
      }
    }
  },
})
