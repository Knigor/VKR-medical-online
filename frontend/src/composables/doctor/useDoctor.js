import { useAuthStore } from '@/stores/authStore'
import { useDoctorStore } from '@/stores/doctorStore'
import protectedAPI from '@/plugins/protectedApi'

export const useDoctor = () => {
  const authStore = useAuthStore()
  const doctorStore = useDoctorStore()

  const getDoctorPersonal = async () => {
    try {
      const response = await protectedAPI(`/api/doctor?doctorId=${authStore.doctorId}`)

      doctorStore.setDoctorDataPersonal(response.data)
    } catch (error) {
      console.error('Ошибка получения личных данных врача:', error)
      throw error
    }
  }

  const getDoctorPersonalOnline = async (doctorId) => {
    try {
      const response = await protectedAPI(`/api/doctor?doctorId=${doctorId}`)

      doctorStore.setDoctorPersonalOnline(response.data)
    } catch (error) {
      console.error('Ошибка получения личных данных врача:', error)
      throw error
    }
  }

  const getDoctorList = async (searchQuery) => {
    try {
      const response = await protectedAPI(`/api/specializations/search?query=${searchQuery}`)

      doctorStore.setDoctorList(response.data)
    } catch (error) {
      console.error('Ошибка получения списка врачей:', error)
      throw error
    }
  }

  const editDoctorPersonal = async (data) => {
    try {
      const response = await protectedAPI('/api/edit_doctor', 'POST', data)
      doctorStore.setDoctorDataPersonal(response.data)
    } catch (error) {
      console.error('Ошибка редактирования личных данных врача:', error)
      throw error
    }
  }

  const setScheduleDoctor = async (data) => {
    try {
      await protectedAPI('/api/schedule', 'POST', data)
    } catch (error) {
      console.error('Ошибка получения списка врачей:', error)
      throw error
    }
  }

  const deleteScheduleDoctor = async (data) => {
    try {
      await protectedAPI('/api/schedule/delete', 'DELETE', data)
    } catch (error) {
      console.error('Ошибка получения списка врачей:', error)
      throw error
    }
  }

  return {
    getDoctorPersonal,
    getDoctorPersonalOnline,
    getDoctorList,
    setScheduleDoctor,
    deleteScheduleDoctor,
    editDoctorPersonal,
  }
}
