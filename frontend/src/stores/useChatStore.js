import { defineStore } from 'pinia'
import io from 'socket.io-client'

export const useChatStore = defineStore('chat', {
  state: () => ({
    socket: null,
    messages: [],
    chatId: null,
  }),

  actions: {
    connectSocket(chatId) {
      if (this.socket) return
      this.chatId = chatId
      this.socket = io('http://localhost:5000', {
        query: { chatId },
      })

      this.socket.on('new-message', (message) => {
        this.messages.push(message)
      })
    },

    sendMessage(message, senderId) {
      if (!this.chatId || !this.socket) return
      this.socket.emit('send-message', { chatId: this.chatId, message, senderId })
    },

    disconnectSocket() {
      if (this.socket) {
        this.socket.disconnect()
        this.socket = null
      }
    },
  },
})
