import { useAuthStore } from '@/stores/authStore'
import publicAPI from '@/plugins/publicApi'
import { useRouter } from 'vue-router'
import { usePatientCardStore } from '@/stores/patientCardStore'
import { useDoctorStore } from '@/stores/doctorStore'

export function useAuth() {
  const authStore = useAuthStore()
  const router = useRouter()
  const patientStore = usePatientCardStore()
  const doctorStore = useDoctorStore()

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
        birthdate: data.birthdate,
        photo_user: data.photo_user,
      })
    } catch (error) {
      console.error('Ошибка авторизации:', error)
      throw error
    }
  }

  async function register(credentials) {
    try {
      await publicAPI('/api/register', 'POST', credentials)
    } catch (error) {
      console.error('Ошибка регистрации:', error)
      throw error
    }
  }

  function logout() {
    authStore.setAccessToken(null)
    authStore.clearPersonalData()
    patientStore.clearPatientCard()
    doctorStore.clearDoctorPersonal()
    router.push('/')
  }

  return { login, logout, register }
}
