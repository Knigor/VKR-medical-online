import { defineStore } from 'pinia'

export const usePatientCardStore = defineStore('patientCard', {
  state: () => ({
    policy_number: null,
    blood_type: null,
    allergies: null,
    chronic_conditions: null,
  }),
  actions: {
    setPatientCard(data) {
      this.policy_number = data.policy_number
      this.blood_type = data.blood_type
      this.allergies = data.allergies
      this.chronic_conditions = data.chronic_conditions
    },

    clearPatientCard() {
      this.policy_number = null
      this.blood_type = null
      this.allergies = null
      this.chronic_conditions = null
    },
  },
})
