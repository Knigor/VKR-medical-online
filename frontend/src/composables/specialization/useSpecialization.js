import protectedAPI from '@/plugins/protectedApi'
import { useSpecializationStore } from '@/stores/specializationStore'

export const useSpecialization = () => {
  const specializationStore = useSpecializationStore()

  const getSpecialization = async (images) => {
    try {
      const response = await protectedAPI('/api/specializations/all')

      // Массив популярных тем, соответствующих специализациям
      const popularTopicsMapping = {
        7: [
          { id: 1, textPopular: 'Боль в горле' },
          { id: 3, textPopular: 'Простуда' },
          { id: 5, textPopular: 'Боль в суставах' },
        ],
        8: [
          { id: 2, textPopular: 'Последствие травм' },
          { id: 6, textPopular: 'Аллергия' },
        ],
        9: [{ id: 4, textPopular: 'Отношения с партнером' }],
        10: [{ id: 7, textPopular: 'Сексуальная жизнь' }],
        11: [{ id: 8, textPopular: 'Проблемы с сердцем' }],
        15: [
          { id: 1, textPopular: 'Боль в горле' },
          { id: 2, textPopular: 'Последствие травм' },
          { id: 3, textPopular: 'Простуда' },
          { id: 5, textPopular: 'Боль в суставах' },
          { id: 6, textPopular: 'Аллергия' },
        ],
      }

      // Добавляем картинку и популярные темы к каждому элементу специализации
      const updatedData = response.data.map((item, index) => ({
        ...item,
        image: images[index] || null, // В случае если картинка не передана
        popularTopics: popularTopicsMapping[item.specializationId] || [], // Добавляем популярные темы
      }))

      // Сохраняем обновленные данные в store
      specializationStore.setSpecializationData(updatedData)
    } catch (error) {
      console.error('Ошибка получения специализации:', error)
    }
  }

  return { getSpecialization }
}
