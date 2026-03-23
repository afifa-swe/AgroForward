import { onMounted, onUnmounted } from 'vue'

export function useReveal(threshold = 0.1) {
  let observer: IntersectionObserver | null = null

  onMounted(() => {
    observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('v')
            observer?.unobserve(entry.target)
          }
        })
      },
      { threshold }
    )
    document.querySelectorAll('.reveal:not(.v)').forEach((el) => observer?.observe(el))
  })

  onUnmounted(() => observer?.disconnect())
}

export function reinitReveals() {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((e) => {
        if (e.isIntersecting) {
          e.target.classList.add('v')
          observer.unobserve(e.target)
        }
      })
    },
    { threshold: 0.1 }
  )
  document.querySelectorAll('.reveal:not(.v)').forEach((el) => observer.observe(el))
}
