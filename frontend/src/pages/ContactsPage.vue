<script setup lang="ts">
import { ref, reactive, watch, onMounted, nextTick } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useReveal, reinitReveals } from '@/composables/useReveal'
import { sendContactForm } from '@/api/contact'

useReveal()
const route = useRoute()
const router = useRouter()

const activeTab = ref((route.query.tab as string) || 'info')
const tabs = [
  { id: 'info', label: 'Контактная информация' },
  { id: 'req', label: 'Реквизиты' },
  { id: 'form', label: 'Форма обратной связи' },
  { id: 'map', label: 'Карта проезда' },
]

function setTab(id: string) {
  activeTab.value = id
  router.replace({ query: { tab: id } })
  nextTick(() => reinitReveals())
}

watch(() => route.query.tab, (val) => {
  if (val && val !== activeTab.value) {
    activeTab.value = val as string
    nextTick(() => reinitReveals())
  }
})

onMounted(() => { if (route.query.tab) activeTab.value = route.query.tab as string })

// Быстрый запрос
const quickSent = ref(false)
const quickLoading = ref(false)
const quickError = ref('')
const quickForm = reactive({ name: '', phone: '', email: '', subject: 'Стать партнёром', message: '' })

async function submitQuick() {
  quickError.value = ''
  if (!quickForm.name || !quickForm.email || !quickForm.message) {
    quickError.value = 'Заполните обязательные поля (имя, email, сообщение)'
    return
  }
  quickLoading.value = true
  try {
    await sendContactForm(quickForm)
    quickSent.value = true
  } catch (e: any) {
    quickError.value = e.response?.data?.message || 'Ошибка отправки. Попробуйте позже.'
  } finally {
    quickLoading.value = false
  }
}

// Полная форма обратной связи
const formSent = ref(false)
const formLoading = ref(false)
const formError = ref('')
const agreed = ref(false)
const fullForm = reactive({ firstName: '', lastName: '', company: '', email: '', phone: '', subject: '', message: '' })

async function submitFull() {
  formError.value = ''
  if (!fullForm.firstName || !fullForm.lastName || !fullForm.email || !fullForm.subject || !fullForm.message) {
    formError.value = 'Заполните все обязательные поля (*)'
    return
  }
  if (!agreed.value) {
    formError.value = 'Необходимо согласие с политикой обработки данных'
    return
  }
  formLoading.value = true
  try {
    await sendContactForm({
      name: fullForm.firstName + ' ' + fullForm.lastName,
      email: fullForm.email,
      phone: fullForm.phone || undefined,
      company: fullForm.company || undefined,
      subject: fullForm.subject,
      message: fullForm.message,
    })
    formSent.value = true
  } catch (e: any) {
    formError.value = e.response?.data?.message || 'Ошибка отправки. Попробуйте позже.'
  } finally {
    formLoading.value = false
  }
}
</script>

<template>
  <div class="page-wrap">
  <div class="page-hero">
    <div class="breadcrumb">Главная › <span>Контакты</span></div>
    <p class="section-label">Контакты</p>
    <h1 class="section-title" style="font-size:clamp(2rem,5vw,3.5rem)">Свяжитесь с нами</h1>
    <p class="section-sub">Готовы обсудить партнёрство, условия поставки или ответить на ваши вопросы.</p>
  </div>

  <div class="sec sec-dark">
    <div class="container">
      <div class="sub-tabs">
        <button v-for="t in tabs" :key="t.id" class="sub-tab" :class="{ active: activeTab === t.id }" @click="setTab(t.id)">{{ t.label }}</button>
      </div>

      <!-- КОНТАКТНАЯ ИНФОРМАЦИЯ -->
      <div v-if="activeTab === 'info'" class="reveal">
        <div class="contacts-layout">
          <div>
            <div class="contact-info-block">
              <h3>Центральный офис</h3>
              <div class="cinfo"><div class="cinfo-ic">📍</div><div class="cinfo-body"><strong>Адрес</strong><p>Россия, г. Москва<br>Центральный офис</p></div></div>
              <div class="cinfo"><div class="cinfo-ic">📞</div><div class="cinfo-body"><strong>Основной телефон</strong><p>+7 (495) 000-00-00</p></div></div>
              <div class="cinfo"><div class="cinfo-ic">✉️</div><div class="cinfo-body"><strong>Email</strong><p>info@agroforward.ru</p></div></div>
              <div class="cinfo"><div class="cinfo-ic">🕐</div><div class="cinfo-body"><strong>Режим работы</strong><p>Понедельник — Пятница<br>9:00 — 18:00 МСК</p></div></div>
            </div>
            <div class="contact-info-block">
              <h3>Отделы</h3>
              <div class="cinfo"><div class="cinfo-ic">🛒</div><div class="cinfo-body"><strong>Коммерческий отдел</strong><p>sales@agroforward.ru<br>+7 (495) 000-00-01</p></div></div>
              <div class="cinfo"><div class="cinfo-ic">🚛</div><div class="cinfo-body"><strong>Логистика и поставки</strong><p>logistics@agroforward.ru<br>+7 (495) 000-00-02</p></div></div>
              <div class="cinfo"><div class="cinfo-ic">💼</div><div class="cinfo-body"><strong>Инвесторам</strong><p>investors@agroforward.ru</p></div></div>
            </div>
          </div>
          <div>
            <div class="quick-form-wrap">
              <h3 style="font-family:var(--font-display);font-size:1.2rem;color:var(--white);margin-bottom:1.5rem">Быстрый запрос</h3>
              <template v-if="!quickSent">
                <div class="form-field"><label>Имя *</label><input v-model="quickForm.name" type="text" placeholder="Иван Петров"></div>
                <div class="form-row">
                  <div class="form-field"><label>Телефон</label><input v-model="quickForm.phone" type="tel" placeholder="+7 (000) 000-00-00"></div>
                  <div class="form-field"><label>Email *</label><input v-model="quickForm.email" type="email" placeholder="ivan@company.ru"></div>
                </div>
                <div class="form-field"><label>Тема</label><select v-model="quickForm.subject"><option>Стать партнёром</option><option>Запрос цен</option><option>Документация</option><option>Инвестиции</option><option>Другое</option></select></div>
                <div class="form-field"><label>Сообщение *</label><textarea v-model="quickForm.message" placeholder="Ваш вопрос или запрос…"></textarea></div>
                <div v-if="quickError" class="form-error">{{ quickError }}</div>
                <button class="btn-p" style="width:100%" :disabled="quickLoading" @click="submitQuick">{{ quickLoading ? 'Отправка...' : 'Отправить' }}</button>
              </template>
              <div v-else class="form-success">Отправлено ✓</div>
            </div>
          </div>
        </div>
      </div>

      <!-- РЕКВИЗИТЫ -->
      <div v-if="activeTab === 'req'" class="reveal">
        <p class="section-label">Юридические данные</p>
        <h2 class="section-title" style="margin-bottom:1rem">Реквизиты компании</h2>
        <div class="req-grid">
          <div class="req-block">
            <h3 style="font-family:var(--font-display);color:var(--white);margin-bottom:1rem;font-size:1.1rem">Основные реквизиты</h3>
            <table class="req-table">
              <tr><td>Полное наименование</td><td>ООО «Агрофорвард»</td></tr>
              <tr><td>Сокращённое</td><td>ООО «Агрофорвард»</td></tr>
              <tr><td>ОГРН</td><td>—</td></tr>
              <tr><td>ИНН</td><td>—</td></tr>
              <tr><td>КПП</td><td>—</td></tr>
              <tr><td>ОКВЭД</td><td>46.32 — Оптовая торговля мясом</td></tr>
              <tr><td>Год основания</td><td>2017</td></tr>
            </table>
          </div>
          <div class="req-block">
            <h3 style="font-family:var(--font-display);color:var(--white);margin-bottom:1rem;font-size:1.1rem">Банковские реквизиты</h3>
            <table class="req-table">
              <tr><td>Банк</td><td>—</td></tr>
              <tr><td>БИК</td><td>—</td></tr>
              <tr><td>Р/с</td><td>—</td></tr>
              <tr><td>К/с</td><td>—</td></tr>
            </table>
            <p style="font-size:.78rem;color:var(--muted);margin-top:1rem;line-height:1.6">Полные реквизиты предоставляются при заключении договора.</p>
          </div>
        </div>
      </div>

      <!-- ФОРМА -->
      <div v-if="activeTab === 'form'" class="reveal">
        <p class="section-label">Обратная связь</p>
        <h2 class="section-title" style="margin-bottom:2rem">Форма обратной связи</h2>
        <div style="max-width:640px">
          <template v-if="!formSent">
            <div class="form-row">
              <div class="form-field"><label>Имя *</label><input v-model="fullForm.firstName" type="text" placeholder="Иван"></div>
              <div class="form-field"><label>Фамилия *</label><input v-model="fullForm.lastName" type="text" placeholder="Петров"></div>
            </div>
            <div class="form-field"><label>Компания</label><input v-model="fullForm.company" type="text" placeholder="ООО «Название»"></div>
            <div class="form-row">
              <div class="form-field"><label>Email *</label><input v-model="fullForm.email" type="email" placeholder="ivan@company.ru"></div>
              <div class="form-field"><label>Телефон</label><input v-model="fullForm.phone" type="tel" placeholder="+7 (000) 000-00-00"></div>
            </div>
            <div class="form-field"><label>Тема обращения *</label>
              <select v-model="fullForm.subject"><option value="">Выберите тему...</option><option>Новое партнёрство</option><option>Запрос цен</option><option>Документация</option><option>Инвестиции</option><option>Логистика</option><option>Жалоба</option><option>Другое</option></select>
            </div>
            <div class="form-field"><label>Сообщение *</label><textarea v-model="fullForm.message" placeholder="Подробно опишите ваш запрос…" style="min-height:160px"></textarea></div>
            <div style="display:flex;align-items:center;gap:.8rem;margin-bottom:1.2rem">
              <input v-model="agreed" type="checkbox" id="agree" style="width:16px;height:16px;accent-color:var(--terra)">
              <label for="agree" style="font-size:.8rem;color:var(--muted);text-transform:none;letter-spacing:0">Я согласен с политикой обработки персональных данных</label>
            </div>
            <div v-if="formError" class="form-error">{{ formError }}</div>
            <button class="btn-p" :disabled="formLoading" @click="submitFull">{{ formLoading ? 'Отправка...' : 'Отправить обращение' }}</button>
          </template>
          <div v-else class="form-success">Ваше обращение отправлено. Мы свяжемся с вами в ближайшее время.</div>
        </div>
      </div>

      <!-- КАРТА -->
      <div v-if="activeTab === 'map'" class="reveal">
        <p class="section-label">Как добраться</p>
        <h2 class="section-title" style="margin-bottom:2rem">Карта проезда</h2>
        <div class="map-placeholder">
          <span>🗺️</span>
          <p>Интерактивная карта<br>(Яндекс.Карты / Google Maps)</p>
          <a href="https://maps.yandex.ru" target="_blank" class="btn-o btn-sm">Открыть Яндекс.Карты</a>
        </div>
        <div class="cards-3" style="margin-top:2rem">
          <div class="card"><div class="card-icon">🚇</div><div class="card-title">Метро</div><div class="card-text">Ближайшая станция метро. 5 минут пешком.</div><div class="card-bar"></div></div>
          <div class="card"><div class="card-icon">🚗</div><div class="card-title">На автомобиле</div><div class="card-text">Бесплатная парковка на территории.</div><div class="card-bar"></div></div>
          <div class="card"><div class="card-icon">🚌</div><div class="card-title">Автобус</div><div class="card-text">Остановка в 2 минутах ходьбы.</div><div class="card-bar"></div></div>
        </div>
      </div>

    </div>
  </div>
  </div>
</template>

<style scoped>
.quick-form-wrap {
  background: rgba(255,255,255,.03);
  border: 1px solid var(--border);
  border-radius: 4px;
  padding: 2rem;
}
.form-success {
  padding: 2rem;
  background: rgba(4,82,58,.2);
  border: 1px solid var(--green-l);
  border-radius: 4px;
  color: var(--cream);
  text-align: center;
  font-size: 1rem;
}
.req-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 2rem;
}
.req-block {
  background: rgba(255,255,255,.03);
  border: 1px solid var(--border);
  border-radius: 4px;
  padding: 2rem;
}

.form-error {
  padding: .8rem 1rem;
  background: rgba(213,97,84,.15);
  border: 1px solid var(--terra);
  border-radius: 4px;
  color: var(--terra);
  font-size: .85rem;
  margin-bottom: 1rem;
}

@media (max-width: 768px) {
  .req-grid { grid-template-columns: 1fr; }
}
</style>
