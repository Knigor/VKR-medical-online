import { defineStore } from 'pinia'
import { ref } from 'vue'

export const usePersonalDoctorStore = defineStore('personalDoctor', () => {
  const doctorData = ref(null)

  function setDoctorData(data) {
    doctorData.value = data
  }

  return { doctorData, setDoctorData }
})
