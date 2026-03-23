import { onMounted } from 'vue'

const HERO_SELECTORS = [
  { selector: '.hero-eyebrow', delay: 300 },
  { selector: '.hero-title',   delay: 500 },
  { selector: '.hero-sub',     delay: 700 },
  { selector: '.hero-btns',    delay: 900 },
  { selector: '.hero-stats',   delay: 1100 },
]

export function useHeroAnimation() {
  onMounted(() => {
    HERO_SELECTORS.forEach(({ selector, delay }) => {
      const el = document.querySelector(selector)
      if (!el) return
      setTimeout(() => el.classList.add('animated'), delay)
    })
  })
}
