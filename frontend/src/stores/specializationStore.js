import { defineStore } from 'pinia'

export const useSpecializationStore = defineStore('specialization', {
  state: () => ({
    specializationData: [],
  }),
  actions: {
    setSpecializationData(data) {
      this.specializationData = data
    },
    clearSpecializationData() {
      this.specializationData = []
    },
  },
})
