import { defineStore } from 'pinia'

export const useDoctorStore = defineStore('doctor', {
  state: () => ({
    doctorDataPersonal: {},
    doctorList: [],
    doctorChatList: [],
    doctorPersonalOnline: {},
  }),
  actions: {
    setDoctorChatList(data) {
      this.doctorChatList = data
    },
    setDoctorDataPersonal(data) {
      this.doctorDataPersonal = data
    },
    setDoctorList(data) {
      this.doctorList = data
    },
    clearDoctorPersonal() {
      this.doctorDataPersonal = {}
    },
    setDoctorPersonalOnline(data) {
      this.doctorPersonalOnline = data
    },
    clearDoctorPersonalOnline() {
      this.doctorPersonalOnline = {}
    },
  },
})
