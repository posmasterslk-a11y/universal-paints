<template>
  <div class="policy-page pt-32 pb-20">
    <div class="container mx-auto px-4 max-w-4xl">
      <div class="mb-10 text-center">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Privacy Policy</h1>
        <p class="text-gray-500">Last updated: August 2026</p>
      </div>

      <div class="prose prose-lg max-w-none text-gray-700">
        <p>At Universal Paints (Pvt) Ltd, we take your privacy seriously. This Privacy Policy outlines how we collect, use, and protect your personal information when you visit our website and use our services.</p>

        <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">1. Information We Collect</h2>
        <p>We collect information you provide directly to us when you fill out contact forms, request quotes, or create an account. This may include your name, email address, phone number, and delivery address.</p>
        <p>We also automatically collect certain technical information when you visit our site, such as your IP address, browser type, and pages visited, through the use of cookies.</p>

        <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">2. How We Use Your Information</h2>
        <p>We use the information we collect to:</p>
        <ul class="list-disc pl-6 mb-6">
          <li>Process and fulfill your orders and requests for quotes.</li>
          <li>Communicate with you regarding your orders or inquiries.</li>
          <li>Send you marketing communications (if you have opted in).</li>
          <li>Improve our website, products, and services.</li>
          <li>Protect against fraudulent transactions.</li>
        </ul>

        <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">3. Sharing of Information</h2>
        <p>We do not sell, rent, or trade your personal information to third parties. We may share your information with trusted service providers who assist us in operating our website, conducting our business, or serving our users (e.g., delivery partners and payment processors), so long as those parties agree to keep this information confidential.</p>

        <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">4. Data Security</h2>
        <p>We implement a variety of security measures to maintain the safety of your personal information. All sensitive information supplied is transmitted via Secure Socket Layer (SSL) technology and encrypted into our payment gateway providers' databases only to be accessible by those authorized with special access rights to such systems.</p>

        <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">5. Your Rights</h2>
        <p>You have the right to request access to the personal information we hold about you, to request corrections to any inaccuracies, or to request the deletion of your data. To exercise these rights, please contact us.</p>

        <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">6. Contact Us</h2>
        <p>If you have any questions about this Privacy Policy, please contact us at:</p>
        <p class="font-semibold mt-2">Universal Paints (Pvt) Ltd</p>
        <p>Email: privacy@universalpaints.lk</p>
        <p>Phone: +94 11 234 5678</p>
      </div>
    </div>
  </div>
</template>

<script setup>
useHead({
  title: 'Privacy Policy - Universal Paints'
})
</script>

<style scoped>
.policy-page {
  background-color: #f9fafb;
  min-height: calc(100vh - 300px);
}
.prose p {
  margin-bottom: 1.25em;
  line-height: 1.7;
}
.prose h2 {
  color: #111827;
  border-bottom: 1px solid #e5e7eb;
  padding-bottom: 0.5rem;
}
</style>
