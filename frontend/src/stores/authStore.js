import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    accessToken: null,
    id: null,
    fio: null,
    email: null,
    userName: null,
    role: null,
    gender: null,
    doctorId: null,
    patientId: null,
  }),
  actions: {
    setAccessToken(token) {
      this.accessToken = token
    },
    setPersonalData(data) {
      this.fio = data.fio
      this.id = data.id
      this.email = data.email
      this.userName = data.userName
      this.role = data.role
      this.gender = data.gender
      this.doctorId = data.doctorId
      this.patientId = data.patientId
    },
    clearPersonalData() {
      this.fio = null
      this.id = null
      this.email = null
      this.userName = null
      this.role = null
      this.gender = null
      this.doctorId = null
      this.patientId = null
    },
  },
  getters: {},
})
