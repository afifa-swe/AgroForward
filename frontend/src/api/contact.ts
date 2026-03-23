import api from './client'

export interface ContactPayload {
  name: string
  email: string
  phone?: string
  company?: string
  subject?: string
  message: string
}

export async function sendContactForm(payload: ContactPayload) {
  const { data } = await api.post('/contact', payload)
  return data
}
