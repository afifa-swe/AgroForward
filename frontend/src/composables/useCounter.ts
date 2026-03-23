import { ref } from 'vue'

export function useCounter(target: number, duration = 1800) {
  const current = ref(0)

  function start() {
    const startTime = performance.now()
    function step(now: number) {
      const progress = Math.min((now - startTime) / duration, 1)
      const eased = 1 - Math.pow(1 - progress, 3)
      current.value = Math.round(eased * target)
      if (progress < 1) requestAnimationFrame(step)
    }
    requestAnimationFrame(step)
  }

  return { current, start }
}
