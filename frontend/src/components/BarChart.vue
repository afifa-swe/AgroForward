<script setup lang="ts">
import { ref, onMounted } from 'vue'

const volumes = [
  { yr: '2018', v: 438804 },
  { yr: '2019', v: 1108428 },
  { yr: '2020', v: 1498665 },
  { yr: '2021', v: 1497672 },
  { yr: '2022', v: 1694827 },
  { yr: '2023', v: 2732786 },
  { yr: '2024', v: 5783600 },
  { yr: '2025', v: 6011826 },
]

const maxV = 6011826
const animated = ref(false)

function fmtVal(v: number): string {
  if (v >= 1000000) return (v / 1000000).toFixed(2) + 'M'
  return Math.round(v / 1000) + 'k'
}

function pct(v: number): string {
  return ((v / maxV) * 100) + '%'
}

onMounted(() => {
  setTimeout(() => { animated.value = true }, 150)
})
</script>

<template>
  <div class="chart-wrap">
    <div class="chart-title">📦 Объём поставок по годам (кг)</div>
    <div class="bar-chart">
      <div v-for="d in volumes" :key="d.yr" class="bar-col">
        <div class="bar-fill" :style="{ height: animated ? pct(d.v) : '4px' }">
          <span class="bar-fill-val">{{ fmtVal(d.v) }}</span>
        </div>
        <div class="bar-lbl">{{ d.yr }}</div>
      </div>
    </div>
  </div>
</template>
