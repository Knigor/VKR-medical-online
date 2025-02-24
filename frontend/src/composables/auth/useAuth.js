import { useAuthStore } from '@/stores/authStore'
import publicAPI from '@/plugins/publicApi'
import { useRouter } from 'vue-router'

export function useAuth() {
  const authStore = useAuthStore()
  const router = useRouter()

  async function login(credentials) {
    try {
      const data = await publicAPI('/api/login_check', 'POST', credentials)

      authStore.setAccessToken(data.token)
      authStore.setPersonalData({
        fio: data['ФИО'],
        id: data.id,
        email: data.email,
        userName: data.username,
        role: data.role[0] ? data.role[0][0] : data.role,
        gender: data.gender,
        doctorId: data.doctorId,
        patientId: data.patientId,
      })
    } catch (error) {
      console.error('Ошибка авторизации:', error)
      throw error
    }
  }

  // async function refreshToken() {
  //   try {
  //     const data = await protectedAPI('/auth/refresh', 'POST')
  //     authStore.setAccessToken(data.access_token)
  //   } catch (error) {
  //     console.error('Ошибка обновления токена:', error)
  //     logout()
  //   }
  // }

  function logout() {
    authStore.setAccessToken(null)
    authStore.clearPersonalData()
    router.push('/')
  }

  return { login, logout }
}
