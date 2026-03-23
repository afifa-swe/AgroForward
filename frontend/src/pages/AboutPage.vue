<script setup lang="ts">
import { ref, watch, onMounted, nextTick } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useReveal, reinitReveals } from '@/composables/useReveal'

useReveal()
const route = useRoute()
const router = useRouter()

const activeTab = ref((route.query.tab as string) || 'history')

const tabs = [
  { id: 'history', label: 'История' },
  { id: 'mission', label: 'Миссия и ценности' },
  { id: 'team', label: 'Команда' },
  { id: 'certs', label: 'Лицензии' },
  { id: 'geo', label: 'География' },
  { id: 'partners', label: 'Партнёры' },
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

onMounted(() => {
  if (route.query.tab) activeTab.value = route.query.tab as string
})

const timeline = [
  { yr: '2017', name: 'Основание', desc: 'Регистрация компании, первые рамочные договора. Команда из двух специалистов. Первые контракты с мясокомбинатами ЦФО.', vol: '' },
  { yr: '2018', name: 'Выход на рынок', desc: 'Начало масштабирования, выстраивание логистической базы, привлечение первых агрохолдингов.', vol: '438 804 кг' },
  { yr: '2019', name: 'Первый рывок', desc: 'Расширение географии за пределы ЦФО. Устойчивые маршруты и партнёрства с транспортными компаниями.', vol: '1 108 428 кг' },
  { yr: '2020', name: 'Пандемия — стресс-тест', desc: 'Ритмичность поставок сохранена. Переработка процессов под новые санитарные требования.', vol: '1 498 665 кг' },
  { yr: '2021', name: 'Укрепление позиций', desc: 'Ключевые сертификаты и аккредитации. Выход на федеральные сети и промышленных переработчиков.', vol: '1 497 672 кг' },
  { yr: '2022', name: 'Технологизация', desc: 'Цифровой учёт и отчётность в реальном времени. Модернизация складских мощностей.', vol: '1 694 827 кг' },
  { yr: '2023', name: 'Новый масштаб', desc: 'Закрепление в качестве системного поставщика для агрохолдингов и переработчиков.', vol: '2 732 786 кг' },
  { yr: '2024', name: 'Федеральный скачок', desc: 'Масштабное расширение клиентской базы. Вход в топ-50 агрохолдингов России.', vol: '5 783 600 кг' },
  { yr: '2025', name: 'Сегодня', desc: 'Развитие импорта из СНГ. Активный поиск инвесторов. Строительство фирменного бренда.', vol: '6 011 826 кг' },
]

const certs = [
  { icon: '📋', name: 'Свидетельство о регистрации юридического лица', desc: 'Документ подтверждает государственную регистрацию ООО «Агрофорвард» и право на ведение коммерческой деятельности на территории РФ.', tag: 'ОГРН' },
  { icon: '🏛️', name: 'Свидетельство о постановке на налоговый учёт', desc: 'ИНН/КПП компании. Подтверждает постановку на учёт в налоговом органе.', tag: 'ИНН / КПП' },
  { icon: '🇪🇺', name: 'Декларация соответствия ТР ТС', desc: 'Подтверждение соответствия продукции техническим регламентам Таможенного союза.', tag: 'ТР ТС 034/2013' },
  { icon: '🐾', name: 'Ветеринарные сертификаты', desc: 'Вся продукция проходит ветеринарный контроль. Электронные ВСД в системе «Меркурий».', tag: 'Меркурий · ФГИС' },
  { icon: '🏆', name: 'Сертификаты ISO (в процессе получения)', desc: 'ISO 9001 и ISO 22000. Подготовка к сертификации в рамках стратегии 2026–2027.', tag: 'В процессе' },
]

const regions = [
  { flag: '📍', name: 'Московская область', desc: 'Ключевой регион. Крупнейшие мясоперерабатывающие предприятия.', status: 'active', statusLabel: 'Активно' },
  { flag: '📍', name: 'Липецкая область', desc: 'Агропромышленный кластер ЦФО. Работа с производственными предприятиями.', status: 'active', statusLabel: 'Активно' },
  { flag: '📍', name: 'Воронежская область', desc: 'Центрально-Чернозёмный регион. Партнёрства с региональными агрохолдингами.', status: 'active', statusLabel: 'Активно' },
  { flag: '📍', name: 'Тульская область', desc: 'Развитое животноводство. Поставки для мясоперерабатывающих предприятий.', status: 'active', statusLabel: 'Активно' },
  { flag: '🗺️', name: 'Поволжский ФО', desc: 'Активно развивающееся направление. Выстраивание устойчивых каналов поставок.', status: 'dev', statusLabel: 'Развитие' },
  { flag: '🧭', name: 'Северо-Западный ФО', desc: 'Планируемый выход к 2027 году. Формирование партнёрств с петербургскими переработчиками.', status: 'plan', statusLabel: '2027' },
  { flag: '☀️', name: 'Юг России', desc: 'Перспективный регион с развитым животноводством. Выход 2027–2028.', status: 'plan', statusLabel: '2027–28' },
  { flag: '🌐', name: 'СНГ (импорт)', desc: 'Казахстан, Беларусь. Партнёрства для сглаживания ценовых колебаний.', status: 'dev', statusLabel: 'Развитие' },
]
</script>

<template>
  <div class="page-wrap">
  <div class="page-hero">
    <div class="breadcrumb">Главная › <span>О компании</span></div>
    <p class="section-label">О компании</p>
    <h1 class="section-title" style="font-size:clamp(2rem,5vw,3.5rem)">Агрофорвард</h1>
    <p class="section-sub">Федеральный поставщик мясосырья с 2017 года. Надёжность, качество, партнёрство.</p>
  </div>

  <div class="sec sec-dark">
    <div class="container">
      <div class="sub-tabs">
        <button v-for="t in tabs" :key="t.id" class="sub-tab" :class="{ active: activeTab === t.id }" @click="setTab(t.id)">{{ t.label }}</button>
      </div>

      <!-- ИСТОРИЯ -->
      <div v-if="activeTab === 'history'">
        <p class="section-label reveal">С 2017 по сегодня</p>
        <h2 class="section-title reveal rd1">История компании</h2>
        <div class="section-divider reveal rd2"></div>
        <p class="section-sub reveal rd2">Рынок мясосырья в России с 2010 года находился в фазе структурного роста. На этом фоне была создана компания как специализированный игрок.</p>
        <div class="timeline">
          <div v-for="(item, i) in timeline" :key="i" class="tl-row reveal" :class="{ 'rd1': i % 2 === 1 }">
            <div class="tl-body" :class="{ 'text-right': i % 2 === 0 }">
              <div class="tl-yr">{{ item.yr }}</div>
              <div class="tl-name">{{ item.name }}</div>
              <div class="tl-desc">{{ item.desc }}</div>
              <div v-if="item.vol" class="tl-vol">{{ item.vol }}</div>
            </div>
            <div class="tl-dot"></div>
            <div style="flex:1"></div>
          </div>
        </div>
      </div>

      <!-- МИССИЯ И ЦЕННОСТИ -->
      <div v-if="activeTab === 'mission'">
        <p class="section-label reveal">Смысл и принципы</p>
        <h2 class="section-title reveal rd1">Миссия и ценности</h2>
        <div class="section-divider reveal rd2"></div>
        <div class="mission-quote reveal rd2">
          <p class="quote-text">"Обеспечивать предприятия мясоперерабатывающей отрасли качественным сырьём, создавая долгосрочные партнёрские отношения, основанные на надёжности, прозрачности и профессионализме."</p>
          <p class="quote-author">— Миссия компании</p>
        </div>
        <h3 class="section-title reveal" style="font-size:1.6rem;margin-bottom:2rem">Видение будущего</h3>
        <div class="cards-3 reveal rd1">
          <div class="card"><div class="card-icon">🌍</div><div class="card-title">Стратегический рост</div><div class="card-text">Наращивание объёмов через работу с агрохолдингами и выход в новые регионы.</div><div class="card-bar"></div></div>
          <div class="card"><div class="card-icon">🔗</div><div class="card-title">Международное направление</div><div class="card-text">Развитие импортных каналов из СНГ для сглаживания ценовых колебаний.</div><div class="card-bar"></div></div>
          <div class="card"><div class="card-icon">💻</div><div class="card-title">Цифровизация</div><div class="card-text">ERP-система, автоматизация документооборота, онлайн-кабинеты для партнёров.</div><div class="card-bar"></div></div>
        </div>
        <h3 class="section-title reveal rd2" style="font-size:1.6rem;margin-top:3.5rem;margin-bottom:2rem">Корпоративные ценности</h3>
        <div class="cards-3 reveal rd2">
          <div class="card"><div class="card-icon">🤝</div><div class="card-title">Надёжность</div><div class="card-text">Выполняем обязательства в срок. Гарантируем стабильность поставок.</div><div class="card-bar"></div></div>
          <div class="card"><div class="card-icon">✅</div><div class="card-title">Качество</div><div class="card-text">Строгий отбор поставщиков. Многоуровневый контроль продукции.</div><div class="card-bar"></div></div>
          <div class="card"><div class="card-icon">🌱</div><div class="card-title">Партнёрство</div><div class="card-text">Долгосрочные отношения важнее разовых сделок.</div><div class="card-bar"></div></div>
          <div class="card"><div class="card-icon">🎯</div><div class="card-title">Профессионализм</div><div class="card-text">Команда экспертов с многолетним опытом.</div><div class="card-bar"></div></div>
          <div class="card"><div class="card-icon">📊</div><div class="card-title">Прозрачность</div><div class="card-text">Честная коммуникация. Полная документальная поддержка.</div><div class="card-bar"></div></div>
          <div class="card"><div class="card-icon">🚀</div><div class="card-title">Развитие</div><div class="card-text">Инвестиции в технологии и инфраструктуру.</div><div class="card-bar"></div></div>
        </div>
      </div>

      <!-- КОМАНДА -->
      <div v-if="activeTab === 'team'">
        <p class="section-label reveal">Люди</p>
        <h2 class="section-title reveal rd1">Команда управления</h2>
        <div class="section-divider reveal rd2"></div>
        <p class="section-sub reveal rd2" style="margin-bottom:2rem"><em style="color:var(--cream-d);font-style:italic">Успех — результат работы команды профессионалов.</em></p>
        <div class="team-grid reveal rd2">
          <div class="team-card">
            <div class="team-photo">👨‍💼</div>
            <div class="team-body"><div class="team-name">Генеральный директор</div><div class="team-role">Основатель и генеральный директор</div><div class="team-bio">Более 15 лет в мясной промышленности. Под его руководством компания выросла с нуля до федерального оператора с объёмом 6+ млн кг в год.</div></div>
          </div>
          <div class="team-card">
            <div class="team-photo">👨‍💼</div>
            <div class="team-body"><div class="team-name">Коммерческий директор</div><div class="team-role">Коммерческий директор</div><div class="team-bio">Эксперт в B2B-продажах агропромышленного сектора. Выстраивает долгосрочные партнёрства с агрохолдингами и мясокомбинатами.</div></div>
          </div>
          <div class="team-card">
            <div class="team-photo">👨‍💼</div>
            <div class="team-body"><div class="team-name">Директор по логистике</div><div class="team-role">Директор по логистике</div><div class="team-bio">Строит и управляет цепочками поставок, обеспечивает соблюдение температурного режима и сроков.</div></div>
          </div>
        </div>
      </div>

      <!-- ЛИЦЕНЗИИ -->
      <div v-if="activeTab === 'certs'">
        <p class="section-label reveal">Документы</p>
        <h2 class="section-title reveal rd1">Лицензии и сертификаты</h2>
        <div class="section-divider reveal rd2"></div>
        <p class="section-sub reveal rd2" style="margin-bottom:2.5rem">Все процессы сертифицированы, продукция соответствует государственным стандартам.</p>
        <div style="display:flex;flex-direction:column;gap:1.2rem" class="reveal rd2">
          <div v-for="c in certs" :key="c.name" class="cert-card">
            <div class="cert-icon">{{ c.icon }}</div>
            <div class="cert-body">
              <div class="cert-name">{{ c.name }}</div>
              <div class="cert-desc">{{ c.desc }}</div>
              <span class="cert-tag">{{ c.tag }}</span>
              <div v-if="c.tag !== 'В процессе'"><div class="cert-dl">⬇ Скачать копию (PDF)</div></div>
            </div>
          </div>
        </div>
      </div>

      <!-- ГЕОГРАФИЯ -->
      <div v-if="activeTab === 'geo'">
        <p class="section-label reveal">Присутствие</p>
        <h2 class="section-title reveal rd1">География работы</h2>
        <div class="section-divider reveal rd2"></div>
        <p class="section-sub reveal rd2" style="margin-bottom:.5rem">Основной рынок — Центральный и Центрально-Чернозёмный ФО.</p>
        <div class="kpi-row reveal rd2" style="margin-bottom:2.5rem">
          <div class="kpi"><div class="kpi-val">4<em>+</em></div><div class="kpi-lbl">Субъекта ЦФО</div></div>
          <div class="kpi"><div class="kpi-val">1<em>+</em></div><div class="kpi-lbl">Федеральных округа</div></div>
          <div class="kpi"><div class="kpi-val">2027</div><div class="kpi-lbl">Выход в СЗФО</div></div>
          <div class="kpi"><div class="kpi-val">СНГ</div><div class="kpi-lbl">Импортное направление</div></div>
        </div>
        <div class="region-grid reveal rd3">
          <div v-for="r in regions" :key="r.name" class="region-card">
            <div class="region-flag">{{ r.flag }}</div>
            <div class="region-name">{{ r.name }}</div>
            <div class="region-desc">{{ r.desc }}</div>
            <span class="region-status" :class="'status-' + r.status">{{ r.statusLabel }}</span>
          </div>
        </div>
        <div class="logistics-block reveal rd3">
          <h3 style="font-family:var(--font-display);color:var(--white);margin-bottom:1.2rem">Логистическая инфраструктура</h3>
          <div class="cards-3">
            <div style="text-align:center;padding:1rem"><div style="font-size:2rem;margin-bottom:.5rem">🛰️</div><div style="font-size:.85rem;color:var(--cream-d);font-weight:700;margin-bottom:.3rem">GPS-мониторинг</div><div style="font-size:.78rem;color:var(--muted)">Отслеживание каждой поставки</div></div>
            <div style="text-align:center;padding:1rem"><div style="font-size:2rem;margin-bottom:.5rem">❄️</div><div style="font-size:.85rem;color:var(--cream-d);font-weight:700;margin-bottom:.3rem">Температурная цепь</div><div style="font-size:.78rem;color:var(--muted)">Склады временного хранения</div></div>
            <div style="text-align:center;padding:1rem"><div style="font-size:2rem;margin-bottom:.5rem">🚛</div><div style="font-size:.85rem;color:var(--cream-d);font-weight:700;margin-bottom:.3rem">Партнёрские перевозчики</div><div style="font-size:.78rem;color:var(--muted)">Проверенные логистические компании</div></div>
          </div>
        </div>
      </div>

      <!-- ПАРТНЁРЫ -->
      <div v-if="activeTab === 'partners'">
        <p class="section-label reveal">Клиенты</p>
        <h2 class="section-title reveal rd1">Наши партнёры</h2>
        <div class="section-divider reveal rd2"></div>
        <p class="section-sub reveal rd2" style="margin-bottom:2.5rem">За 8+ лет работы Агрофорвард стал надёжным партнёром для десятков крупных предприятий.</p>
        <div class="partners-types reveal rd2">
          <div class="ptype">
            <div class="ptype-icon">🏭</div>
            <div class="ptype-name">Агрохолдинги полного цикла</div>
            <ul class="ptype-list"><li>Крупные интегрированные структуры</li><li>Поставки для внутренних мощностей</li><li>Индивидуальные условия</li></ul>
            <div class="contract-badge">12–36 мес. контракты</div>
          </div>
          <div class="ptype">
            <div class="ptype-icon">🥩</div>
            <div class="ptype-name">Мясоперерабатывающие комбинаты</div>
            <ul class="ptype-list"><li>Производители колбасных изделий</li><li>Производители полуфабрикатов</li><li>Производители консервов</li></ul>
            <div class="contract-badge">Основной сегмент</div>
          </div>
          <div class="ptype">
            <div class="ptype-icon">🍽️</div>
            <div class="ptype-name">Производственные предприятия</div>
            <ul class="ptype-list"><li>Фабрики-кухни и общественное питание</li><li>Розничные сети с производством</li><li>HoReCa-сегмент</li></ul>
            <div class="contract-badge">Развивающийся сегмент</div>
          </div>
        </div>
        <div class="kpi-row reveal rd3" style="margin-top:3rem">
          <div class="kpi"><div class="kpi-val">50<em>+</em></div><div class="kpi-lbl">Активных клиентов</div></div>
          <div class="kpi"><div class="kpi-val">36<em> мес</em></div><div class="kpi-lbl">Макс. длина контракта</div></div>
          <div class="kpi"><div class="kpi-val">↓</div><div class="kpi-lbl">Низкий отток клиентов</div></div>
        </div>
      </div>

    </div>
  </div>
  </div>
</template>

<style scoped>
/* Timeline */
.timeline { position: relative; max-width: 880px; margin: 3rem auto 0; }
.timeline::before {
  content: '';
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  width: 2px;
  height: 100%;
  background: linear-gradient(to bottom, var(--terra), rgba(213,97,84,.1));
}
.tl-row { display: flex; align-items: flex-start; gap: 2.5rem; margin-bottom: 3.5rem; }
.tl-row:nth-child(even) { flex-direction: row-reverse; }
.tl-body { flex: 1; }
.text-right { text-align: right; }
.tl-row:nth-child(even) .tl-body { text-align: left; }
.tl-yr { font-family: var(--font-display); font-size: 3.2rem; font-weight: 900; color: rgba(213,97,84,.12); line-height: 1; }
.tl-name { font-size: .85rem; font-weight: 700; color: var(--terra); text-transform: uppercase; letter-spacing: .07em; margin: .3rem 0; }
.tl-desc { font-size: .875rem; line-height: 1.7; color: var(--muted); }
.tl-vol { font-family: var(--font-display); font-size: 1.3rem; font-weight: 700; color: var(--white); margin-top: .5rem; }
.tl-dot {
  width: 14px;
  height: 14px;
  border-radius: 50%;
  background: var(--terra);
  flex-shrink: 0;
  margin-top: .7rem;
  box-shadow: 0 0 0 4px rgba(213,97,84,.2), 0 0 0 8px rgba(213,97,84,.06);
}

.mission-quote {
  background: rgba(213,97,84,.07);
  border: 1px solid rgba(213,97,84,.2);
  border-radius: 4px;
  padding: 2.5rem;
  margin-bottom: 3rem;
}
.quote-text {
  font-family: var(--font-display);
  font-size: 1.2rem;
  line-height: 1.8;
  color: var(--cream);
  font-style: italic;
}
.quote-author {
  font-size: .78rem;
  letter-spacing: .15em;
  text-transform: uppercase;
  color: var(--terra);
  margin-top: 1.2rem;
  font-weight: 700;
}

.logistics-block {
  margin-top: 2.5rem;
  background: rgba(255,255,255,.03);
  border: 1px solid var(--border);
  border-radius: 4px;
  padding: 2rem;
}

@media (max-width: 768px) {
  .timeline::before { left: 20px; }
  .tl-row, .tl-row:nth-child(even) { flex-direction: row; }
  .text-right { text-align: left; }
}
</style>
