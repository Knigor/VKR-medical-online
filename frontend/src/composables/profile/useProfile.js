import { useAuthStore } from '@/stores/authStore'
import protectedAPI from '@/plugins/protectedApi'

export const useProfile = () => {
  const authStore = useAuthStore()

  const editProfile = async (data) => {
    try {
      const response = await protectedAPI('/api/user_edit', 'POST', data)

      authStore.setPersonalData({
        fio: response.data['ФИО'],
        id: response.data.id,
        email: response.data.email,
        userName: response.data.username,
        role: response.data.role[0] ? response.data.role[0][0] : response.data.role,
        gender: response.data.gender,
        birthdate: response.data.birthdate,
        photo_user: response.data.photo_user,
        doctorId: response.data.doctorId,
        patientId: response.data.patientId,
      })
    } catch (error) {
      console.error('Ошибка редактирования профиля:', error)
      throw error
    }
  }

  return { editProfile }
}
