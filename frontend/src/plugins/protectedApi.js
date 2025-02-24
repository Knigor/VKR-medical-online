import { useAuthStore } from '@/stores/authStore'

export default async function protectedAPI(url, method = 'GET', body = null) {
  const authStore = useAuthStore()
  const token = authStore.accessToken

  const headers = {
    'Content-Type': 'application/json',
    Authorization: `Bearer ${token}`,
  }

  const options = { method, headers }
  if (body) {
    options.body = JSON.stringify(body)
  }

  try {
    const response = await fetch(`${import.meta.env.VITE_BASE_URL}${url}`, options)
    const data = await response.json()

    if (!response.ok) {
      throw new Error(data.message || 'Ошибка запроса')
    }

    return data
  } catch (error) {
    console.error('Protected API Error:', error)
    throw error
  }
}
