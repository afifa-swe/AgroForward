import { ref, onMounted, onUnmounted } from 'vue'

export function useNav() {
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

  onMounted(() => window.addEventListener('scroll', onScroll, { passive: true }))
  onUnmounted(() => window.removeEventListener('scroll', onScroll))

  return { isScrolled, mobileOpen, toggleMobile, closeMobile }
}
