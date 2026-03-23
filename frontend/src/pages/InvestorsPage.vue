<script setup lang="ts">
import { ref, watch, onMounted, nextTick } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useReveal, reinitReveals } from '@/composables/useReveal'
import BarChart from '@/components/BarChart.vue'

useReveal()
const route = useRoute()
const router = useRouter()

const activeTab = ref((route.query.tab as string) || 'why')
const tabs = [
  { id: 'why', label: 'Почему мы' },
  { id: 'fin', label: 'Финансовые показатели' },
  { id: 'report', label: 'Отчётность' },
  { id: 'gov', label: 'Корп. управление' },
  { id: 'strategy', label: 'Стратегия' },
  { id: 'cal', label: 'Календарь' },
  { id: 'inv-contacts', label: 'Контакты' },
]

function setTab(id: string) {
  activeTab.value = id
  router.replace({ query: { tab: id } })
  window.scrollTo({ top: 0, behavior: 'smooth' })
  nextTick(() => reinitReveals())
}

watch(() => route.query.tab, (val) => {
  if (val && val !== activeTab.value) {
    activeTab.value = val as string
    nextTick(() => reinitReveals())
  }
})

onMounted(() => { if (route.query.tab) activeTab.value = route.query.tab as string })

const formSent = ref(false)
function sendForm() { formSent.value = true }

const finData = [
  { yr: '2018', vol: '438 804 кг', growth: '—', status: 'Запуск' },
  { yr: '2019', vol: '1 108 428 кг', growth: '+153%', status: 'Рост' },
  { yr: '2020', vol: '1 498 665 кг', growth: '+35%', status: 'Стабилизация' },
  { yr: '2021', vol: '1 497 672 кг', growth: '≈0%', status: 'Укрепление' },
  { yr: '2022', vol: '1 694 827 кг', growth: '+13%', status: 'Рост' },
  { yr: '2023', vol: '2 732 786 кг', growth: '+61%', status: 'Скачок' },
  { yr: '2024', vol: '5 783 600 кг', growth: '+111%', status: 'Прорыв' },
  { yr: '2025', vol: '6 011 826 кг', growth: '+4%', status: 'Консолидация' },
]

const calItems = [
  { month: 'Апр', day: '15', title: 'Публикация годового отчёта 2025', desc: 'Операционные показатели, объёмы поставок, ключевые события года.', badge: 'Запланировано' },
  { month: 'Май', day: '22', title: 'AgroRus 2026 — участие в выставке', desc: 'Международная выставка агропромышленного комплекса.', badge: 'Запланировано' },
  { month: 'Июн', day: '10', title: 'Встреча с инвесторами Q2 2026', desc: 'Презентация результатов I полугодия.', badge: 'Запланировано' },
  { month: 'Сен', day: '01', title: 'Запуск B2B-платформы (бета)', desc: 'Онлайн-система заказов для партнёров.', badge: 'Технологический этап' },
  { month: 'Окт', day: '15', title: 'Выход в Северо-Западный ФО', desc: 'Старт работы с клиентами СЗФО.', badge: 'Стратегический этап' },
  { month: 'Дек', day: '20', title: 'Годовой отчёт для инвесторов', desc: 'Итоги 2026 года, планы на 2027.', badge: 'Ежегодно' },
]

const reports = [
  { icon: '📊', name: 'Бухгалтерская отчётность 2024', desc: 'Баланс, отчёт о финансовых результатах за 2024 год.', tag: 'Аудировано' },
  { icon: '📊', name: 'Бухгалтерская отчётность 2023', desc: 'Годовая отчётность за 2023 год.', tag: 'Аудировано' },
  { icon: '📈', name: 'Инвестиционный меморандум', desc: 'Полное описание бизнес-модели, стратегии и условий.', tag: 'Конфиденциально' },
  { icon: '📋', name: 'Управленческая отчётность Q4 2025', desc: 'Квартальные операционные показатели.', tag: 'По запросу' },
]
</script>

<template>
  <div class="page-wrap">
  <div class="page-hero">
    <div class="breadcrumb">Главная › <span>Инвесторам</span></div>
    <p class="section-label">Инвесторам</p>
    <h1 class="section-title" style="font-size:clamp(2rem,5vw,3.5rem)">Инвестиционные возможности</h1>
    <p class="section-sub">Агрофорвард приглашает к сотрудничеству частных и институциональных инвесторов.</p>
  </div>

  <div class="sec sec-dark">
    <div class="container">
      <div class="sub-tabs">
        <button v-for="t in tabs" :key="t.id" class="sub-tab" :class="{ active: activeTab === t.id }" @click="setTab(t.id)">{{ t.label }}</button>
      </div>

      <!-- ПОЧЕМУ МЫ -->
      <div v-if="activeTab === 'why'">
        <div class="why-grid">
          <div>
            <p class="section-label reveal">Инвестиционный тезис</p>
            <h2 class="section-title reveal rd1">Почему Агрофорвард</h2>
            <div class="section-divider reveal rd2"></div>
            <div class="thesis-block reveal rd2">
              <p>Агрофорвард — это <strong style="color:var(--white)">стабильный, прибыльный бизнес</strong> с прозрачной финансовой структурой. Рынок мясного сырья растёт <strong style="color:var(--terra)">3–5% ежегодно</strong>.</p>
            </div>
            <div class="adv-grid reveal rd3">
              <div class="adv-item"><div class="adv-ico">📈</div><div class="adv-body"><strong>Растущий рынок</strong><span>Стабильный спрос, импортозамещение, рост 3–5% в год.</span></div></div>
              <div class="adv-item"><div class="adv-ico">🏢</div><div class="adv-body"><strong>50+ корпоративных клиентов</strong><span>Долгосрочные контракты 12–36 мес.</span></div></div>
              <div class="adv-item"><div class="adv-ico">⚡</div><div class="adv-body"><strong>Масштабируемая модель</strong><span>Потенциал роста выручки в 3× за 5 лет.</span></div></div>
              <div class="adv-item"><div class="adv-ico">🔒</div><div class="adv-body"><strong>Финансовая устойчивость</strong><span>Положительный денежный поток. Аудированная отчётность.</span></div></div>
              <div class="adv-item"><div class="adv-ico">👥</div><div class="adv-body"><strong>Опытная команда</strong><span>Глубокие знания рынка мясного сырья.</span></div></div>
              <div class="adv-item"><div class="adv-ico">📊</div><div class="adv-body"><strong>Прозрачность</strong><span>Регулярная отчётность, аудит, открытость.</span></div></div>
            </div>
          </div>
          <div class="reveal rd2">
            <div class="kpi-row" style="flex-direction:column">
              <div class="kpi"><div class="kpi-val">6 011 826 кг</div><div class="kpi-lbl">Объём поставок 2025</div><div class="kpi-trend">↗ +10% к 2024</div></div>
              <div class="kpi"><div class="kpi-val">20<em>+ млн</em></div><div class="kpi-lbl">Кг суммарно 2018–2025</div><div class="kpi-trend">↗ Накопленный результат</div></div>
              <div class="kpi"><div class="kpi-val">3–5<em>%</em></div><div class="kpi-lbl">Рост рынка ежегодно</div></div>
              <div class="kpi"><div class="kpi-val">20–25<em>%</em></div><div class="kpi-lbl">Целевой темп роста</div><div class="kpi-trend">↗ Стратегия 2026–2030</div></div>
            </div>
            <div class="cta-box">
              <p>Для получения подробной инвестиционной информации свяжитесь с нами.</p>
              <button class="btn-p btn-sm" @click="setTab('inv-contacts')">Связаться с командой</button>
            </div>
          </div>
        </div>
      </div>

      <!-- ФИНАНСОВЫЕ ПОКАЗАТЕЛИ -->
      <div v-if="activeTab === 'fin'">
        <p class="section-label reveal">Цифры</p>
        <h2 class="section-title reveal rd1">Финансовые показатели</h2>
        <div class="section-divider reveal rd2"></div>
        <div class="kpi-row reveal rd2" style="margin-bottom:2.5rem">
          <div class="kpi"><div class="kpi-val">6<em> млн кг</em></div><div class="kpi-lbl">Поставок в 2025</div><div class="kpi-trend">↗ +10%</div></div>
          <div class="kpi"><div class="kpi-val">5,7<em> млн кг</em></div><div class="kpi-lbl">Поставок в 2024</div><div class="kpi-trend">↗ +111%</div></div>
          <div class="kpi"><div class="kpi-val">2,7<em> млн кг</em></div><div class="kpi-lbl">Поставок в 2023</div><div class="kpi-trend">↗ +61%</div></div>
          <div class="kpi"><div class="kpi-val">50<em>+</em></div><div class="kpi-lbl">Активных клиентов</div></div>
        </div>
        <div class="reveal rd3" style="margin-bottom:2rem"><BarChart /></div>
        <h3 class="section-title reveal rd2" style="font-size:1.4rem;margin-bottom:1.5rem">Динамика объёмов поставок (кг)</h3>
        <div class="reveal rd2" style="overflow-x:auto">
          <table class="fin-table">
            <thead><tr><th>Год</th><th>Объём поставок</th><th>Рост</th><th>Статус</th></tr></thead>
            <tbody>
              <tr v-for="d in finData" :key="d.yr"><td>{{ d.yr }}</td><td class="num">{{ d.vol }}</td><td class="pos">{{ d.growth }}</td><td>{{ d.status }}</td></tr>
            </tbody>
          </table>
        </div>
        <div class="nda-block reveal rd3">
          <p>📊 Выручка, рентабельность и прочие финансовые показатели предоставляются по запросу после подписания NDA.</p>
          <button class="btn-o btn-sm" @click="setTab('inv-contacts')">Запросить отчётность</button>
        </div>
      </div>

      <!-- ОТЧЁТНОСТЬ -->
      <div v-if="activeTab === 'report'">
        <p class="section-label reveal">Документы</p>
        <h2 class="section-title reveal rd1">Отчётность</h2>
        <div class="section-divider reveal rd2"></div>
        <p class="section-sub reveal rd2" style="margin-bottom:2.5rem">Часть документов предоставляется по запросу после верификации инвестора.</p>
        <div style="display:flex;flex-direction:column;gap:1rem" class="reveal rd2">
          <div v-for="r in reports" :key="r.name" class="cert-card">
            <div class="cert-icon">{{ r.icon }}</div>
            <div class="cert-body">
              <div class="cert-name">{{ r.name }}</div>
              <div class="cert-desc">{{ r.desc }}</div>
              <span class="cert-tag">{{ r.tag }}</span>
              <div><div class="cert-dl">⬇ Запросить документ</div></div>
            </div>
          </div>
        </div>
      </div>

      <!-- КОРПОРАТИВНОЕ УПРАВЛЕНИЕ -->
      <div v-if="activeTab === 'gov'">
        <p class="section-label reveal">Структура</p>
        <h2 class="section-title reveal rd1">Корпоративное управление</h2>
        <div class="section-divider reveal rd2"></div>
        <div class="gov-principles reveal rd2">
          <div class="gov-card"><div class="gov-ico">👁️</div><div class="gov-body"><strong>Прозрачность</strong><p>Регулярное раскрытие информации. Открытая коммуникация с инвесторами.</p></div></div>
          <div class="gov-card"><div class="gov-ico">⚖️</div><div class="gov-body"><strong>Подотчётность</strong><p>Чёткое разделение полномочий. Регулярный внешний аудит.</p></div></div>
          <div class="gov-card"><div class="gov-ico">🛡️</div><div class="gov-body"><strong>Ответственность</strong><p>Соблюдение законодательства РФ. Защита интересов сторон.</p></div></div>
          <div class="gov-card"><div class="gov-ico">🤝</div><div class="gov-body"><strong>Справедливость</strong><p>Равное отношение ко всем участникам. Прозрачные процедуры.</p></div></div>
        </div>
        <h3 class="section-title reveal rd3" style="font-size:1.3rem;margin-top:3rem;margin-bottom:1.2rem">Политики и кодексы</h3>
        <div class="policy-list reveal rd3">
          <div class="policy-item">📄 Кодекс корпоративного управления</div>
          <div class="policy-item">📄 Политика по предотвращению конфликта интересов</div>
          <div class="policy-item">📄 Положение о коммерческой тайне</div>
          <div class="policy-item">📄 Политика по работе с инсайдерской информацией</div>
          <div class="policy-item">📄 Политика обработки персональных данных</div>
        </div>
      </div>

      <!-- СТРАТЕГИЯ -->
      <div v-if="activeTab === 'strategy'">
        <p class="section-label reveal">План 2026–2030</p>
        <h2 class="section-title reveal rd1">Стратегия развития</h2>
        <div class="section-divider reveal rd2"></div>
        <div class="thesis-block reveal rd2" style="margin-bottom:2.5rem">
          <p style="font-style:italic">"Стратегия направлена на укрепление лидерских позиций и масштабирование бизнеса. Три направления: расширение географии, увеличение доли рынка и развитие сервисов."</p>
        </div>
        <div class="strategy-phases reveal rd2">
          <div class="phase"><div class="phase-num">1</div><div class="phase-period">2026–2027</div><div class="phase-title">Географическая экспансия</div><ul class="phase-list"><li>Выход на рынки СЗФО</li><li>Усиление в Поволжье</li><li>Инвестиции в логистику</li></ul></div>
          <div class="phase"><div class="phase-num">2</div><div class="phase-period">2027–2028</div><div class="phase-title">Технологический скачок</div><ul class="phase-list"><li>Внедрение ERP</li><li>Автоматизация складов</li><li>B2B-платформа</li><li>Личные кабинеты</li></ul></div>
          <div class="phase"><div class="phase-num">3</div><div class="phase-period">2028–2030</div><div class="phase-title">Лидерство</div><ul class="phase-list"><li>Сибирь и Дальний Восток</li><li>Консалтинг для переработчиков</li><li>IPO как перспектива</li><li>Импорт из СНГ</li></ul></div>
        </div>
        <h3 class="section-title reveal rd3" style="font-size:1.3rem;margin-top:3rem;margin-bottom:1.5rem">Стратегические приоритеты</h3>
        <div class="cards-2 reveal rd3">
          <div class="card"><div class="card-icon">📈</div><div class="card-title">Рост выручки</div><div class="card-text">Целевой темп 20–25% ежегодно.</div><div class="card-bar"></div></div>
          <div class="card"><div class="card-icon">⚙️</div><div class="card-title">Операционная эффективность</div><div class="card-text">Снижение издержек на 15% за счёт ERP.</div><div class="card-bar"></div></div>
          <div class="card"><div class="card-icon">🌐</div><div class="card-title">Диверсификация</div><div class="card-text">Расширение линейки, импорт, консалтинг.</div><div class="card-bar"></div></div>
          <div class="card"><div class="card-icon">👥</div><div class="card-title">Команда</div><div class="card-text">Привлечение топ-менеджеров. KPI-мотивация.</div><div class="card-bar"></div></div>
        </div>
      </div>

      <!-- КАЛЕНДАРЬ -->
      <div v-if="activeTab === 'cal'">
        <p class="section-label reveal">События</p>
        <h2 class="section-title reveal rd1">Календарь инвестора</h2>
        <div class="section-divider reveal rd2"></div>
        <div class="cal-list reveal rd2">
          <div v-for="c in calItems" :key="c.day + c.month" class="cal-item">
            <div class="cal-date"><div class="cal-month">{{ c.month }}</div><div class="cal-day">{{ c.day }}</div></div>
            <div class="cal-body"><strong>{{ c.title }}</strong><p>{{ c.desc }}</p><span class="cal-badge">{{ c.badge }}</span></div>
          </div>
        </div>
      </div>

      <!-- КОНТАКТЫ ДЛЯ ИНВЕСТОРОВ -->
      <div v-if="activeTab === 'inv-contacts'">
        <p class="section-label reveal">Связь</p>
        <h2 class="section-title reveal rd1">Контакты для инвесторов</h2>
        <div class="section-divider reveal rd2"></div>
        <div class="inv-contacts-grid reveal rd2">
          <div>
            <div class="cinfo"><div class="cinfo-ic">👤</div><div class="cinfo-body"><strong>Ответственный за IR</strong><p>Генеральный директор<br>Агрофорвард</p></div></div>
            <div class="cinfo"><div class="cinfo-ic">✉️</div><div class="cinfo-body"><strong>Email для инвесторов</strong><p>investors@agroforward.ru</p></div></div>
            <div class="cinfo"><div class="cinfo-ic">📞</div><div class="cinfo-body"><strong>Телефон</strong><p>+7 (495) 000-00-00</p></div></div>
            <div class="cinfo"><div class="cinfo-ic">🕐</div><div class="cinfo-body"><strong>Время ответа</strong><p>В течение 1–2 рабочих дней</p></div></div>
            <div class="inv-note">
              <p>Для получения инвестиционного меморандума и условий участия — заполните форму.</p>
            </div>
          </div>
          <div>
            <template v-if="!formSent">
              <div class="form-field"><label>Имя и фамилия</label><input type="text" placeholder="Иван Петров"></div>
              <div class="form-field"><label>Организация</label><input type="text" placeholder="Название фонда"></div>
              <div class="form-field"><label>Email</label><input type="email" placeholder="investor@fund.ru"></div>
              <div class="form-field"><label>Телефон</label><input type="tel" placeholder="+7 (000) 000-00-00"></div>
              <div class="form-field"><label>Интерес</label><select><option>Инвестиционный меморандум</option><option>Финансовая отчётность</option><option>Условия участия</option><option>Общие вопросы</option></select></div>
              <div class="form-field"><label>Сообщение</label><textarea placeholder="Расскажите о вашем интересе…"></textarea></div>
              <button class="btn-p" style="width:100%" @click="sendForm">Отправить запрос</button>
            </template>
            <div v-else class="form-success">Спасибо! Ваш запрос отправлен. Мы свяжемся с вами в ближайшее время.</div>
          </div>
        </div>
      </div>

    </div>
  </div>
  </div>
</template>

<style scoped>
.why-grid {
  display: grid;
  grid-template-columns: 1fr 1.2fr;
  gap: 4rem;
  align-items: start;
}
.thesis-block {
  background: rgba(213,97,84,.07);
  border-left: 3px solid var(--terra);
  padding: 1.5rem;
  border-radius: 0 4px 4px 0;
  margin-bottom: 2rem;
}
.thesis-block p { font-size: .95rem; line-height: 1.8; color: var(--cream-d); }
.cta-box {
  margin-top: 1.5rem;
  background: rgba(4,82,58,.15);
  border: 1px solid rgba(4,82,58,.3);
  border-radius: 4px;
  padding: 1.5rem;
}
.cta-box p { font-size: .82rem; color: var(--muted); line-height: 1.7; margin-bottom: 1rem; }
.nda-block {
  margin-top: 2rem;
  background: rgba(4,82,58,.1);
  border: 1px solid rgba(4,82,58,.2);
  border-radius: 4px;
  padding: 1.5rem;
}
.nda-block p { font-size: .85rem; color: var(--muted); line-height: 1.7; margin-bottom: 1rem; }
.inv-contacts-grid {
  display: grid;
  grid-template-columns: 1fr 1.3fr;
  gap: 3.5rem;
  align-items: start;
}
.inv-note {
  margin-top: 2rem;
  background: rgba(213,97,84,.08);
  border: 1px solid rgba(213,97,84,.2);
  border-radius: 4px;
  padding: 1.4rem;
}
.inv-note p { font-size: .83rem; color: var(--cream-d); line-height: 1.7; }
.form-success {
  padding: 2rem;
  background: rgba(4,82,58,.2);
  border: 1px solid var(--green-l);
  border-radius: 4px;
  color: var(--cream);
  text-align: center;
}

@media (max-width: 768px) {
  .why-grid { grid-template-columns: 1fr; }
  .inv-contacts-grid { grid-template-columns: 1fr; }
}
</style>
