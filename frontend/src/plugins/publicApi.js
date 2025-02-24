export default async function publicAPI(url, method = 'GET', body = null) {
  const options = { method }

  if (body) {
    options.body = JSON.stringify(body)
    options.headers = { 'Content-Type': 'application/json' }
  }

  try {
    const response = await fetch(`${import.meta.env.VITE_BASE_URL}${url}`, options)
    const data = await response.json()

    if (!response.ok) {
      throw new Error(data.message || 'Ошибка запроса')
    }

    return data
  } catch (error) {
    console.error('API Error:', error)
    throw error
  }
}
