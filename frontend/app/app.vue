<template>
  <div>
    <NuxtLoadingIndicator color="#E3000F" :height="4" />
    <NuxtLayout>
      <NuxtPage />
    </NuxtLayout>
    <ScrollToTop />
    <QuotePopup />
    <CartDrawer />
  </div>
</template>
