import protectedAPI from '@/plugins/protectedApi'
import { usePatientCardStore } from '@/stores/patientCardStore'
import { useAuthStore } from '@/stores/authStore'

export const usePatientCard = () => {
  const editPatientCard = async (data) => {
    const patientCard = usePatientCardStore()

    try {
      const response = await protectedAPI('/api/edit_pacient', 'POST', data)

      patientCard.setPatientCard({
        policy_number: response.data.policy_number,
        blood_type: response.data.blood_type,
        allergies: response.data.allergies,
        chronic_conditions: response.data.chronic_conditions,
      })
    } catch (error) {
      console.error('Ошибка редактирования пациентской карты:', error)
      throw error
    }
  }

  const getPatientCard = async () => {
    const authStore = useAuthStore()
    const patientCard = usePatientCardStore()

    try {
      const response = await protectedAPI(
        `/api/patient/?userId=${authStore.id}&patientId=${authStore.patientId}`,
        'GET',
      )

      patientCard.setPatientCard({
        policy_number: response.data.policy_number,
        blood_type: response.data.blood_type,
        allergies: response.data.allergies,
        chronic_conditions: response.data.chronic_conditions,
      })
    } catch (error) {
      console.error('Ошибка получения пациентской карты:', error)
      throw error
    }
  }

  return { editPatientCard, getPatientCard }
}
