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
    birthdate: null,
    photo_user: null,
  }),
  actions: {
    setAccessToken(token) {
      this.accessToken = token
    },

    setPersonalData(data) {
      this.id = data.id
      this.fio = data.fio
      this.email = data.email
      this.userName = data.userName
      this.role = data.role
      this.gender = data.gender
      this.birthdate = data.birthdate
      this.photo_user = data.photo_user
      this.patientId = data.patientId
      this.doctorId = data.doctorId
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
      this.birthdate = null
      this.photo_user = null
    },
  },
  persist: true,
})
