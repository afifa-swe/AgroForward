<script setup lang="ts">
import { RouterView } from 'vue-router'
import AppNav from '@/components/layout/AppNav.vue'
import AppFooter from '@/components/layout/AppFooter.vue'
import { reinitReveals } from '@/composables/useReveal'

function onAfterEnter() {
  requestAnimationFrame(() => reinitReveals())
}
</script>

<template>
  <AppNav />

  <RouterView v-slot="{ Component, route }">
    <Transition
      :name="(route.meta.transition as string) || 'page'"
      mode="out-in"
      @after-enter="onAfterEnter"
    >
      <component :is="Component" :key="route.path" />
    </Transition>
  </RouterView>

  <AppFooter />
</template>
