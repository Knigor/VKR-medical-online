import protectedAPI from '@/plugins/protectedApi'
import { useSpecializationStore } from '@/stores/specializationStore'

export const useSpecialization = () => {
  const specializationStore = useSpecializationStore()

  const getSpecialization = async (images) => {
    try {
      const response = await protectedAPI('/api/specializations/all')

      // Добавляем картинку каждому объекту
      const updatedData = response.data.map((item, index) => ({
        ...item,
        image: images[index] || null, // В случае если картинка не передана
      }))

      specializationStore.setSpecializationData(updatedData)
    } catch (error) {
      console.error('Ошибка получения специализации:', error)
    }
  }

  return { getSpecialization }
}
