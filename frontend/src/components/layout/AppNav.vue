<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'
import { useRouter } from 'vue-router'
import AppLogo from '@/components/AppLogo.vue'

const router = useRouter()
const isScrolled = ref(false)
const mobileOpen = ref(false)

function onScroll() { isScrolled.value = window.scrollY > 60 }

function toggleMobile() {
  mobileOpen.value = !mobileOpen.value
  document.body.style.overflow = mobileOpen.value ? 'hidden' : ''
}
function closeMobile() {
  mobileOpen.value = false
  document.body.style.overflow = ''
}

function go(path: string) {
  router.push(path)
  closeMobile()
}

onMounted(() => window.addEventListener('scroll', onScroll, { passive: true }))
onUnmounted(() => window.removeEventListener('scroll', onScroll))

const aboutLinks = [
  { label: 'История компании', hash: 'history' },
  { label: 'Миссия и ценности', hash: 'mission' },
  { label: 'Команда управления', hash: 'team' },
  { label: 'Лицензии и сертификаты', hash: 'certs' },
  { label: 'География работы', hash: 'geo' },
  { label: 'Наши партнёры', hash: 'partners' },
]
const investorLinks = [
  { label: 'Почему мы', hash: 'why' },
  { label: 'Финансовые показатели', hash: 'fin' },
  { label: 'Отчётность', hash: 'report' },
  { label: 'Корпоративное управление', hash: 'gov' },
  { label: 'Стратегия развития', hash: 'strategy' },
  { label: 'Календарь инвестора', hash: 'cal' },
  { label: 'Контакты для инвесторов', hash: 'inv-contacts' },
]
const contactLinks = [
  { label: 'Контактная информация', hash: 'info' },
  { label: 'Реквизиты', hash: 'req' },
  { label: 'Форма обратной связи', hash: 'form' },
  { label: 'Карта проезда', hash: 'map' },
]
</script>

<template>
  <nav class="nav" :class="{ scrolled: isScrolled }">
    <div class="nav-logo" @click="go('/')">
      <AppLogo :size="40" />
      <div class="nav-logo-text">
        <strong>Агрофорвард</strong>
        <span>Мясное сырьё</span>
      </div>
    </div>

    <ul class="nav-main">
      <li class="nav-item">
        <a @click.prevent="go('/')">Главная</a>
      </li>
      <li class="nav-item has-dropdown">
        <button>О компании <span class="nav-arrow">▾</span></button>
        <div class="nav-dropdown">
          <div class="nav-dropdown-inner">
            <a v-for="l in aboutLinks" :key="l.hash" @click.prevent="go('/about?tab=' + l.hash)">{{ l.label }}</a>
          </div>
        </div>
      </li>
      <li class="nav-item has-dropdown">
        <button>Инвесторам <span class="nav-arrow">▾</span></button>
        <div class="nav-dropdown">
          <div class="nav-dropdown-inner">
            <a v-for="l in investorLinks" :key="l.hash" @click.prevent="go('/investors?tab=' + l.hash)">{{ l.label }}</a>
          </div>
        </div>
      </li>
      <li class="nav-item has-dropdown">
        <button>Контакты <span class="nav-arrow">▾</span></button>
        <div class="nav-dropdown">
          <div class="nav-dropdown-inner">
            <a v-for="l in contactLinks" :key="l.hash" @click.prevent="go('/contacts?tab=' + l.hash)">{{ l.label }}</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-cta" @click.prevent="go('/contacts')">Связаться</a>
      </li>
    </ul>

    <div class="burger" :class="{ open: mobileOpen }" @click="toggleMobile">
      <span></span><span></span><span></span>
    </div>
  </nav>

  <!-- Mobile menu -->
  <div class="mobile-menu" :class="{ open: mobileOpen }">
    <div class="mob-section">
      <div class="mob-section-title">Главная</div>
      <a @click.prevent="go('/')">Главная страница</a>
    </div>
    <div class="mob-section">
      <div class="mob-section-title">О компании</div>
      <a v-for="l in aboutLinks" :key="l.hash" @click.prevent="go('/about?tab=' + l.hash)">{{ l.label }}</a>
    </div>
    <div class="mob-section">
      <div class="mob-section-title">Инвесторам</div>
      <a v-for="l in investorLinks" :key="l.hash" @click.prevent="go('/investors?tab=' + l.hash)">{{ l.label }}</a>
    </div>
    <div class="mob-section">
      <div class="mob-section-title">Контакты</div>
      <a v-for="l in contactLinks" :key="l.hash" @click.prevent="go('/contacts?tab=' + l.hash)">{{ l.label }}</a>
    </div>
  </div>
</template>

<style scoped>
.nav {
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 500;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1.2rem 3rem;
  transition: background .4s, padding .4s, box-shadow .4s;
}
.nav.scrolled {
  background: rgba(3,46,33,.94);
  backdrop-filter: blur(14px);
  padding: .75rem 3rem;
  box-shadow: 0 2px 30px rgba(0,0,0,.4);
  border-bottom: 1px solid rgba(213,97,84,.15);
}
.nav-logo {
  display: flex;
  align-items: center;
  gap: .85rem;
  cursor: pointer;
}
.nav-logo-text strong {
  font-family: var(--font-display);
  font-size: 1.05rem;
  color: var(--cream);
  display: block;
  letter-spacing: .03em;
}
.nav-logo-text span {
  font-size: .6rem;
  color: var(--terra);
  letter-spacing: .18em;
  text-transform: uppercase;
}

.nav-main {
  display: flex;
  align-items: center;
  gap: .5rem;
  list-style: none;
}
.nav-item { position: relative; }
.nav-item > a,
.nav-item > button {
  background: none;
  border: none;
  cursor: pointer;
  color: var(--cream-d);
  font-family: var(--font-body);
  font-size: .8rem;
  font-weight: 600;
  letter-spacing: .08em;
  text-transform: uppercase;
  padding: .5rem .9rem;
  border-radius: 2px;
  display: flex;
  align-items: center;
  gap: .3rem;
  transition: color .25s, background .25s;
}
.nav-item > a:hover,
.nav-item > button:hover {
  color: var(--terra);
  background: rgba(213,97,84,.08);
}
.nav-arrow {
  font-size: .65rem;
  transition: transform .25s;
}
.nav-item:hover .nav-arrow { transform: rotate(180deg); }

/*
  Dropdown — невидимый мостик ::before закрывает зазор
  между кнопкой и дропдауном, чтобы hover не терялся
*/
.nav-dropdown {
  position: absolute;
  top: 100%;
  left: 50%;
  transform: translateX(-50%) translateY(0);
  padding-top: .5rem; /* визуальный отступ через padding, а не gap */
  opacity: 0;
  visibility: hidden;
  pointer-events: none;
  transition: opacity .25s, visibility .25s;
  z-index: 600;
}
.nav-dropdown::before {
  /* невидимый мостик — закрывает зону между кнопкой и меню */
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: .5rem;
}
.nav-dropdown-inner {
  background: var(--green-d);
  border: 1px solid rgba(213,97,84,.2);
  border-radius: 4px;
  min-width: 200px;
  padding: .5rem 0;
  box-shadow: 0 20px 50px rgba(0,0,0,.5);
}

.nav-item:hover > .nav-dropdown {
  opacity: 1;
  visibility: visible;
  pointer-events: all;
}

.nav-dropdown a {
  display: block;
  padding: .65rem 1.2rem;
  font-size: .82rem;
  color: var(--cream-d);
  font-weight: 400;
  transition: color .2s, background .2s;
  letter-spacing: .03em;
  cursor: pointer;
}
.nav-dropdown a:hover {
  color: var(--terra);
  background: rgba(213,97,84,.08);
}

.nav-cta {
  background: var(--terra) !important;
  color: var(--white) !important;
  padding: .55rem 1.4rem !important;
  border-radius: 2px !important;
  transition: background .25s, transform .2s !important;
}
.nav-cta:hover {
  background: var(--terra-d) !important;
  transform: translateY(-1px);
}

.burger {
  display: none;
  flex-direction: column;
  gap: 5px;
  cursor: pointer;
  z-index: 501;
}
.burger span {
  display: block;
  width: 24px;
  height: 2px;
  background: var(--cream);
  border-radius: 2px;
  transition: all .3s;
}
.burger.open span:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); }
.burger.open span:nth-child(2) { opacity: 0; }
.burger.open span:nth-child(3) { transform: rotate(-45deg) translate(5px, -5px); }

.mobile-menu {
  position: fixed;
  inset: 0;
  background: var(--green-d);
  z-index: 450;
  display: flex;
  flex-direction: column;
  padding: 5.5rem 2rem 2rem;
  overflow-y: auto;
  transform: translateX(100%);
  transition: transform .4s cubic-bezier(.4,0,.2,1);
}
.mobile-menu.open { transform: translateX(0); }
.mob-section { margin-bottom: 2rem; }
.mob-section-title {
  font-size: .65rem;
  letter-spacing: .2em;
  text-transform: uppercase;
  color: var(--muted);
  margin-bottom: .8rem;
  padding-bottom: .5rem;
  border-bottom: 1px solid var(--border);
}
.mob-section a {
  display: block;
  padding: .6rem 0;
  font-size: .95rem;
  color: var(--cream-d);
  font-weight: 400;
  border-bottom: 1px solid rgba(255,255,255,.04);
  transition: color .2s;
  cursor: pointer;
}
.mob-section a:hover { color: var(--terra); }

@media (max-width: 768px) {
  .nav { padding: 1rem 1.5rem; }
  .nav.scrolled { padding: .7rem 1.5rem; }
  .nav-main { display: none; }
  .burger { display: flex; }
}
</style>
