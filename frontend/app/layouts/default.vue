<template>
  <div class="layout-wrapper">
    <AppHeader />
    <main class="main-content">
      <slot />
    </main>
    <AppFooter />
    <MobileBottomNav />
  </div>
</template>

<script setup>
</script>

<style scoped>
.layout-wrapper {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}
.main-content {
  flex: 1;
}

@media (max-width: 768px) {
  .layout-wrapper {
    /* Add padding at the bottom equal to the bottom nav's height so content doesn't hide behind it */
    padding-bottom: 60px;
  }
}
</style>
