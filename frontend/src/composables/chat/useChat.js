import protectedAPI from '@/plugins/protectedApi'
import { useDoctorStore } from '@/stores/doctorStore'

export const useChat = () => {
  const doctorStore = useDoctorStore()

  const getChatList = async (patientId) => {
    try {
      const response = await protectedAPI(`/api/chats?patientId=${patientId}`)

      if (response.message === 'No chats found') {
        doctorStore.setDoctorChatList([])
      } else {
        doctorStore.setDoctorChatList(response)
      }

      const updatedDoctorList = doctorStore.doctorList.map((doctor) => {
        const chat = doctorStore.doctorChatList.find((chat) => chat.doctorId === doctor.doctorId)

        doctor.statusChat = chat ? chat.statusChat : null

        doctor.chatId = chat ? chat.chatId : null

        return doctor
      })

      doctorStore.setDoctorList(updatedDoctorList)
    } catch (error) {
      console.error('Ошибка получения списка врачей:', error)
      throw error
    }
  }

  const getChatListPacient = async (patientId) => {
    try {
      const response = await protectedAPI(`/api/chats?patientId=${patientId}`)

      doctorStore.setDoctorChatList(response)
    } catch (error) {
      console.error('Ошибка получения списка врачей:', error)
    }
  }
  const getChatListDoctor = async (doctorId) => {
    try {
      const response = await protectedAPI(`/api/chats?doctorId=${doctorId}`)

      doctorStore.setDoctorChatList(response)
    } catch (error) {
      console.error('Ошибка получения списка врачей:', error)
    }
  }

  const chatStart = async (data) => {
    try {
      await protectedAPI(`/api/chat/start`, 'POST', data)
    } catch (error) {
      console.error('Ошибка создания чата:', error)
      throw error
    }
  }

  const closeChatAPI = async (data) => {
    try {
      await protectedAPI(`/api/chat/close`, 'POST', data)
    } catch (error) {
      console.error('Ошибка закрытия чата:', error)
      throw error
    }
  }

  return { getChatList, chatStart, getChatListDoctor, getChatListPacient, closeChatAPI }
}
