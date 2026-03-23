<script setup lang="ts">
import { useRouter } from 'vue-router'
import AppLogo from '@/components/AppLogo.vue'

const router = useRouter()
function go(path: string) { router.push(path) }
</script>

<template>
  <footer class="footer">
    <div class="footer-top">
      <div class="footer-brand">
        <div class="footer-logo" @click="go('/')">
          <AppLogo :size="36" />
          <div class="footer-logo-text">
            <strong>Агрофорвард</strong>
            <span>Мясное сырьё</span>
          </div>
        </div>
        <p>Федеральный поставщик мясосырья для агрохолдингов и мясоперерабатывающих предприятий. С 2017 года.</p>
      </div>
      <div class="footer-col">
        <h4>О компании</h4>
        <a @click="go('/about?tab=history')">История компании</a>
        <a @click="go('/about?tab=mission')">Миссия и ценности</a>
        <a @click="go('/about?tab=team')">Команда</a>
        <a @click="go('/about?tab=certs')">Лицензии</a>
        <a @click="go('/about?tab=geo')">География</a>
        <a @click="go('/about?tab=partners')">Партнёры</a>
      </div>
      <div class="footer-col">
        <h4>Инвесторам</h4>
        <a @click="go('/investors?tab=why')">Почему мы</a>
        <a @click="go('/investors?tab=fin')">Финансовые показатели</a>
        <a @click="go('/investors?tab=strategy')">Стратегия</a>
        <a @click="go('/investors?tab=gov')">Корп. управление</a>
        <a @click="go('/investors?tab=cal')">Календарь</a>
      </div>
      <div class="footer-col">
        <h4>Контакты</h4>
        <a @click="go('/contacts')">Контактная информация</a>
        <a @click="go('/contacts?tab=req')">Реквизиты</a>
        <a @click="go('/contacts?tab=form')">Форма обратной связи</a>
        <a @click="go('/contacts?tab=map')">Карта проезда</a>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="footer-copy">&copy; 2025 ООО «Агрофорвард». Все права защищены.</div>
      <div class="footer-copy">Поставщик мясосырья федерального уровня</div>
    </div>
  </footer>
</template>

<style scoped>
.footer {
  background: #060f0a;
  border-top: 1px solid var(--border);
  padding: 3rem 3rem 2rem;
}
.footer-top {
  display: grid;
  grid-template-columns: 1.5fr 1fr 1fr 1fr;
  gap: 3rem;
  margin-bottom: 2.5rem;
}
.footer-logo {
  display: flex;
  align-items: center;
  gap: .85rem;
  cursor: pointer;
  margin-bottom: 1rem;
}
.footer-logo-text strong {
  font-family: var(--font-display);
  font-size: 1.05rem;
  color: var(--cream);
  display: block;
}
.footer-logo-text span {
  font-size: .6rem;
  color: var(--terra);
  letter-spacing: .18em;
  text-transform: uppercase;
}
.footer-brand p {
  font-size: .83rem;
  color: var(--muted);
  line-height: 1.7;
  max-width: 280px;
  margin-top: .8rem;
}
.footer-col h4 {
  font-size: .7rem;
  letter-spacing: .18em;
  text-transform: uppercase;
  color: var(--terra);
  margin-bottom: 1rem;
  font-weight: 700;
}
.footer-col a {
  display: block;
  font-size: .83rem;
  color: var(--muted);
  margin-bottom: .5rem;
  transition: color .2s;
  cursor: pointer;
}
.footer-col a:hover { color: var(--cream-d); }
.footer-bottom {
  border-top: 1px solid var(--border);
  padding-top: 1.5rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 1rem;
}
.footer-copy { font-size: .75rem; color: var(--muted); }

@media (max-width: 1000px) {
  .footer-top { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 768px) {
  .footer { padding: 2rem 1.5rem 1.5rem; }
  .footer-top { grid-template-columns: 1fr; }
}
</style>
