import protectedAPI from '@/plugins/protectedApi'
import { useSpecializationStore } from '@/stores/specializationStore'

export const useSpecialization = () => {
  const specializationStore = useSpecializationStore()

  const getSpecialization = async () => {
    try {
      const response = await protectedAPI('/api/specializations/all')
      specializationStore.setSpecializationData(response.data)
    } catch (error) {
      console.error('Ошибка получения специализации:', error)
    }
  }

  return { getSpecialization }
}
