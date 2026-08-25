<template>
  <footer class="footer">
    <div class="container footer-top">
      <div class="footer-brand">
        <!-- Assuming there's a white logo for dark background, otherwise using default -->
        <img src="/images/logo/logo-white.png" alt="Universal Paints" class="footer-logo" />
        <p>Universal Paints is a leading manufacturer and distributor of premium quality paints and coatings that bring color, protection and beauty to life.</p>
        <div class="social-icons">
          <a href="#" class="social-icon" aria-label="Facebook">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
          </a>
          <a href="#" class="social-icon" aria-label="Instagram">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
          </a>
          <a href="#" class="social-icon" aria-label="LinkedIn">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
          </a>
          <a href="#" class="social-icon" aria-label="YouTube">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon></svg>
          </a>
        </div>
      </div>
      <div class="footer-links">
        <div class="link-group">
          <h4>Quick Links</h4>
          <ul>
            <li><NuxtLink to="/">Home</NuxtLink></li>
            <li><NuxtLink to="/shop">Shop</NuxtLink></li>
            <li><NuxtLink to="/about">About Us</NuxtLink></li>
            <li><NuxtLink to="/blog">Blog</NuxtLink></li>
            <li><NuxtLink to="/contact">Contact Us</NuxtLink></li>
          </ul>
        </div>
        <div class="link-group">
          <h4>Our Products</h4>
          <ul>
            <li><NuxtLink to="/products/exterior">Exterior Paints</NuxtLink></li>
            <li><NuxtLink to="/products/interior">Interior Paints</NuxtLink></li>
            <li><NuxtLink to="/products/primers">Primers & Sealers</NuxtLink></li>
            <li><NuxtLink to="/products/industrial">Industrial Coatings</NuxtLink></li>
            <li><NuxtLink to="/products/floor">Floor Coatings</NuxtLink></li>
          </ul>
        </div>
        <div class="link-group">
          <h4>Resources</h4>
          <ul>
            <li><NuxtLink to="/resources/catalogue">Product Catalogue</NuxtLink></li>
            <li><NuxtLink to="/resources/data-sheets">Technical Data Sheets</NuxtLink></li>
            <li><NuxtLink to="/resources/safety-data">Material Safety Data</NuxtLink></li>
            <li><NuxtLink to="/resources/color-card">Colour Card</NuxtLink></li>
            <li><NuxtLink to="/support/faq">FAQs</NuxtLink></li>
          </ul>
        </div>
        <div class="link-group">
          <h4>Support</h4>
          <ul>
            <li><NuxtLink to="/support/faq">FAQs</NuxtLink></li>
            <li><NuxtLink to="/support/warranty">Warranty</NuxtLink></li>
            <li><NuxtLink to="/careers">Careers</NuxtLink></li>
            <li><NuxtLink to="/news">News & Updates</NuxtLink></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container bottom-content">
        <p>&copy; 2024 Universal Paints (Pvt) Ltd. All Rights Reserved.</p>
        <div class="bottom-links">
          <NuxtLink to="/privacy">Privacy Policy</NuxtLink>
          <span class="separator">|</span>
          <NuxtLink to="/terms">Terms & Conditions</NuxtLink>
          <span class="separator">|</span>
          <a href="https://www.facebook.com/profile.php?id=61590317867191" target="_blank" rel="noopener noreferrer" style="color: #F59E0B; font-weight: bold;">Dev By W E B R I X</a>
        </div>
      </div>
    </div>
  </footer>
</template>

<style scoped>
/* Footer Section */
.footer {
  position: relative;
  z-index: 10; /* Overlap the CTA section to create a perfect straight cut at the bottom of the image */
  background-color: #0A192F; /* Dark blue background from design */
  color: white;
  margin: 0;
  padding-top: 50px;
}
.footer-top {
  display: grid;
  grid-template-columns: 280px 1fr;
  gap: 60px;
  padding-bottom: 50px;
}
.footer-brand .footer-logo {
  height: 50px;
  margin-bottom: 20px;
}
.footer-brand p {
  color: #A0AEC0; /* Light gray text */
  font-size: 14px;
  margin-bottom: 20px;
  line-height: 1.6;
}
.social-icons {
  display: flex;
  gap: 12px;
}
.social-icon {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background-color: rgba(255, 255, 255, 0.1);
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
  transition: background-color 0.3s;
}
.social-icon:hover {
  background-color: var(--primary-red);
}
.footer-links {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
}
.link-group h4 {
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 20px;
  color: white;
}
.link-group ul {
  display: flex;
  flex-direction: column;
  gap: 12px;
  list-style: none;
  padding: 0;
  margin: 0;
}
.link-group a {
  color: #A0AEC0;
  font-size: 14px;
  text-decoration: none;
  transition: color 0.3s;
}
.link-group a:hover {
  color: white;
}

.footer-bottom {
  border-top: 1px solid rgba(255,255,255,0.1);
  padding: 20px 0;
  font-size: 14px;
  color: #A0AEC0;
}
.bottom-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.bottom-links a {
  color: #A0AEC0;
  text-decoration: none;
  transition: color 0.3s;
}
.bottom-links a:hover {
  color: white;
}
.separator {
  margin: 0 10px;
}

@media (max-width: 992px) {
  .footer-top {
    grid-template-columns: 1fr;
    gap: 40px;
  }
  .footer-links {
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
  }
}
@media (max-width: 576px) {
  .cta-buttons {
    flex-direction: column;
  }
  .footer-links {
    grid-template-columns: 1fr;
  }
  .bottom-content {
    flex-direction: column;
    gap: 10px;
    text-align: center;
  }
}
</style>
