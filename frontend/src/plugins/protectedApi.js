import { useAuthStore } from '@/stores/authStore'
import { useAuth } from '@/composables/auth/useAuth'

export default async function protectedAPI(url, method = 'GET', body = null) {
  const authStore = useAuthStore()
  const token = authStore.accessToken
  const { logout } = useAuth()

  const isFormData = body instanceof FormData

  const headers = {
    Authorization: `Bearer ${token}`,
    ...(isFormData ? {} : { 'Content-Type': 'application/json' }),
  }

  const options = { method, headers }
  if (body) {
    options.body = isFormData ? body : JSON.stringify(body)
  }

  try {
    const response = await fetch(`${import.meta.env.VITE_BASE_URL}${url}`, options)
    const data = await response.json()

    if (data.code === 401) {
      logout()
    }

    if (!response.ok) {
      throw new Error(data.message || 'Ошибка запроса')
    }

    return data
  } catch (error) {
    console.error('Protected API Error:', error)
    throw error
  }
}
