<script setup lang="ts">
import { useReveal } from '@/composables/useReveal'
import { useCounter } from '@/composables/useCounter'
import { useRouter } from 'vue-router'
import { onMounted } from 'vue'
import BarChart from '@/components/BarChart.vue'

useReveal()
const router = useRouter()
function go(path: string) { router.push(path) }

const c1 = useCounter(20766608)
const c2 = useCounter(50)
const c3 = useCounter(8)
const c4 = useCounter(20)

function fmtNum(n: number, s: string): string {
  if (s.includes('кг') && n >= 1000000) return (n / 1000000).toFixed(2) + ' млн' + s
  if (n >= 1000) return Math.round(n / 1000) + 'к' + s
  return n + s
}

onMounted(() => {
  c1.start(); c2.start(); c3.start(); c4.start()
})
</script>

<template>
  <div class="page-wrap">
  <!-- HERO -->
  <div class="hero">
    <div class="hero-orb"></div>
    <div class="hero-orb"></div>
    <p class="hero-eyebrow section-label">Федеральный поставщик мясосырья · с 2017 года</p>
    <h1 class="hero-title">Надёжные поставки<br><em>мясного сырья</em><br>для вашего бизнеса</h1>
    <p class="hero-sub">Агрофорвард — системный партнёр агрохолдингов и мясоперерабатывающих предприятий по всей России. Стабильность, документальная прозрачность, ритмичность.</p>
    <div class="hero-btns">
      <button class="btn-p" @click="go('/contacts')">Стать партнёром</button>
      <button class="btn-o" @click="go('/about?tab=history')">Узнать больше</button>
    </div>
    <div class="hero-stats">
      <div class="hstat"><div class="hstat-num">{{ fmtNum(c1.current.value, ' кг') }}</div><div class="hstat-lbl">Поставлено с 2018 г.</div></div>
      <div class="hstat"><div class="hstat-num">{{ c2.current.value }}+</div><div class="hstat-lbl">Активных клиентов</div></div>
      <div class="hstat"><div class="hstat-num">{{ c3.current.value }} лет</div><div class="hstat-lbl">На рынке</div></div>
      <div class="hstat"><div class="hstat-num">{{ c4.current.value }} млн т</div><div class="hstat-lbl">Кг суммарно</div></div>
    </div>
    <div class="scroll-hint">
      <span>Прокрутить</span>
      <div class="scroll-arrow"></div>
    </div>
  </div>

  <!-- О КОМПАНИИ КРАТКО -->
  <div class="sec sec-alt">
    <div class="container">
      <div class="about-brief">
        <div>
          <p class="section-label reveal">О компании</p>
          <h2 class="section-title reveal rd1">Специализированный оператор рынка мясосырья</h2>
          <div class="section-divider reveal rd2"></div>
          <p class="section-sub reveal rd2">Основаны в 2017 году. За 8 лет выросли от регионального поставщика до федерального оператора. Суммарный объём поставок превысил <strong class="accent">20 766 608 кг</strong>.</p>
          <p class="section-sub reveal rd3" style="margin-top:.8rem">Работаем с агрохолдингами, мясокомбинатами и производственными предприятиями по всей России — от Центрального ФО до Поволжья.</p>
          <div style="margin-top:1.8rem" class="reveal rd4">
            <button class="btn-p btn-sm" @click="go('/about?tab=history')">История компании</button>
          </div>
        </div>
        <div class="reveal rd2">
          <div class="mini-grid">
            <div class="card"><div class="card-icon">🏭</div><div class="card-title">50+</div><div class="card-text">Корпоративных клиентов</div><div class="card-bar"></div></div>
            <div class="card"><div class="card-icon">🚛</div><div class="card-title">GPS</div><div class="card-text">Мониторинг каждой поставки</div><div class="card-bar"></div></div>
            <div class="card"><div class="card-icon">📋</div><div class="card-title">100%</div><div class="card-text">Документальное сопровождение</div><div class="card-bar"></div></div>
            <div class="card"><div class="card-icon">❄️</div><div class="card-title">Холод</div><div class="card-text">Температурная цепь соблюдена</div><div class="card-bar"></div></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ДИНАМИКА ПОСТАВОК -->
  <div class="sec sec-dark">
    <div class="container">
      <p class="section-label reveal">Динамика роста</p>
      <h2 class="section-title reveal rd1">Объёмы поставок 2018–2025</h2>
      <div class="section-divider reveal rd2"></div>
      <div class="reveal rd2">
        <BarChart />
      </div>
    </div>
  </div>

  <!-- ЦЕННОСТИ -->
  <div class="sec sec-green">
    <div class="container">
      <p class="section-label reveal">Наши ценности</p>
      <h2 class="section-title reveal rd1">Принципы, на которых строится партнёрство</h2>
      <div class="cards-3 reveal rd2" style="margin-top:2.5rem">
        <div class="card"><div class="card-icon">🤝</div><div class="card-title">Надёжность</div><div class="card-text">Выполняем обязательства в срок. Гарантируем стабильность поставок.</div><div class="card-bar"></div></div>
        <div class="card"><div class="card-icon">✅</div><div class="card-title">Качество</div><div class="card-text">Строгий отбор поставщиков, многоуровневый контроль продукции.</div><div class="card-bar"></div></div>
        <div class="card"><div class="card-icon">📊</div><div class="card-title">Прозрачность</div><div class="card-text">Полная документальная поддержка, честная коммуникация.</div><div class="card-bar"></div></div>
      </div>
      <div style="text-align:center;margin-top:2.5rem" class="reveal rd3">
        <button class="btn-o" @click="go('/about?tab=mission')">Все ценности компании</button>
      </div>
    </div>
  </div>

  <!-- ИНВЕСТОРАМ ТИЗЕР -->
  <div class="sec sec-dark2">
    <div class="container">
      <div class="investor-teaser">
        <div>
          <p class="section-label reveal">Инвесторам</p>
          <h2 class="section-title reveal rd1">Инвестиции в стабильный растущий рынок</h2>
          <div class="section-divider reveal rd2"></div>
          <p class="section-sub reveal rd2">Рынок мясного сырья в России растёт на 3–5% ежегодно. Агрофорвард — прибыльный бизнес с прозрачной структурой и амбициозными планами расширения.</p>
          <div style="margin-top:2rem;display:flex;gap:1rem;flex-wrap:wrap" class="reveal rd3">
            <button class="btn-p" @click="go('/investors?tab=why')">Инвестиционные возможности</button>
            <button class="btn-o btn-sm" @click="go('/investors?tab=fin')">Финансовые показатели</button>
          </div>
        </div>
        <div class="reveal rd2">
          <div class="kpi-row" style="flex-direction:column">
            <div class="kpi"><div class="kpi-val">3–5<em>%</em></div><div class="kpi-lbl">Рост рынка ежегодно</div><div class="kpi-trend">↗ Устойчивая динамика</div></div>
            <div class="kpi"><div class="kpi-val">20–25<em>%</em></div><div class="kpi-lbl">Целевой рост выручки</div><div class="kpi-trend">↗ 2026–2030 стратегия</div></div>
            <div class="kpi"><div class="kpi-val">3<em>×</em></div><div class="kpi-lbl">Потенциал роста за 5 лет</div><div class="kpi-trend">↗ При выходе в новые регионы</div></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- CTA -->
  <div class="sec sec-alt" style="text-align:center">
    <div class="container">
      <p class="section-label reveal" style="display:block;text-align:center">Готовы работать вместе?</p>
      <h2 class="section-title reveal rd1" style="text-align:center">Станьте нашим партнёром</h2>
      <p class="section-sub reveal rd2" style="margin:1rem auto 2.5rem;text-align:center">Свяжитесь с нами — обсудим ваши потребности и предложим оптимальные условия поставки.</p>
      <div class="reveal rd3"><button class="btn-p" @click="go('/contacts')">Написать нам</button></div>
    </div>
  </div>
  </div>
</template>

<style scoped>
.hero {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding: 7rem 3rem 4rem;
  position: relative;
  overflow: hidden;
  background: linear-gradient(145deg, #0d1f18 0%, #032e21 55%, #041a10 100%);
}
.hero-title em { color: var(--terra); font-style: normal; }
.hero-sub {
  margin-top: 1.6rem;
  max-width: 520px;
  font-size: 1.05rem;
  line-height: 1.75;
  color: var(--cream-d);
  font-weight: 300;
}
.hero-btns { margin-top: 2.5rem; display: flex; gap: 1rem; flex-wrap: wrap; }
.hero-stats { margin-top: 4rem; display: flex; gap: 3rem; flex-wrap: wrap; }
.hstat { border-left: 2px solid var(--terra); padding-left: 1.1rem; }
.hstat-num { font-family: var(--font-display); font-size: 2rem; font-weight: 900; color: var(--white); line-height: 1; }
.hstat-lbl { font-size: .68rem; color: var(--muted); letter-spacing: .12em; text-transform: uppercase; margin-top: .3rem; }

.scroll-hint {
  position: absolute;
  bottom: 2.5rem;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: .5rem;
  opacity: .5;
  animation: bounce 2s ease-in-out infinite;
}
.scroll-hint span { font-size: .65rem; letter-spacing: .15em; text-transform: uppercase; color: var(--cream-d); }
.scroll-arrow {
  width: 24px;
  height: 24px;
  border-right: 2px solid var(--cream-d);
  border-bottom: 2px solid var(--cream-d);
  transform: rotate(45deg);
}

.accent { color: var(--terra); }

.about-brief {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 5rem;
  align-items: center;
}
.mini-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }

.investor-teaser {
  display: grid;
  grid-template-columns: 1.2fr 1fr;
  gap: 5rem;
  align-items: center;
}

@media (max-width: 768px) {
  .hero { padding: 6.5rem 1.5rem 3rem; }
  .hero-stats { gap: 1.8rem; }
  .hero-btns { flex-direction: column; }
  .about-brief { grid-template-columns: 1fr; gap: 2rem; }
  .investor-teaser { grid-template-columns: 1fr; gap: 2rem; }
}
</style>
