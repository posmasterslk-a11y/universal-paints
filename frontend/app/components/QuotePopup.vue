<template>
  <div v-if="isOpen" class="quote-popup-overlay" @click.self="closePopup">
    <div class="quote-popup-content">
      <div class="popup-header">
        <h2>Get a Free Quote</h2>
        <button class="close-btn" @click="closePopup">&times;</button>
      </div>
      
      <div v-if="isSuccess" class="success-message">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
        <p>Thank you! Your quote request has been submitted successfully. We will get back to you shortly.</p>
        <button class="btn btn-red mt-4" @click="closePopup">Close</button>
      </div>
      
      <form v-else @submit.prevent="submitForm" class="quote-form">
        <div class="form-group">
          <label>Full Name</label>
          <input type="text" v-model="form.name" required placeholder="Enter your name" />
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Email Address</label>
            <input type="email" v-model="form.email" required placeholder="Enter your email" />
          </div>
          <div class="form-group">
            <label>Phone Number</label>
            <input type="tel" v-model="form.phone" required placeholder="Enter your phone number" />
          </div>
        </div>
        <div class="form-group">
          <label>Project Type</label>
          <select v-model="form.project_type" required>
            <option value="" disabled>Select Project Type</option>
            <option value="Residential">Residential</option>
            <option value="Commercial">Commercial</option>
            <option value="Industrial">Industrial</option>
            <option value="Other">Other</option>
          </select>
        </div>
        <div class="form-group">
          <label>Message / Requirements</label>
          <textarea v-model="form.message" rows="3" placeholder="Tell us about your project requirements..."></textarea>
        </div>
        <button type="submit" class="btn btn-red w-100" :disabled="isSubmitting">
          {{ isSubmitting ? 'Submitting...' : 'Submit Request' }}
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const isOpen = useState('quotePopup', () => false)

const form = ref({
  name: '',
  email: '',
  phone: '',
  project_type: '',
  message: ''
})

const isSubmitting = ref(false)
const isSuccess = ref(false)

const closePopup = () => {
  isOpen.value = false
  // Reset form after a short delay
  setTimeout(() => {
    isSuccess.value = false
    form.value = {
      name: '',
      email: '',
      phone: '',
      project_type: '',
      message: ''
    }
  }, 300)
}

const submitForm = async () => {
  isSubmitting.value = true
  
  // Simulate API call for now (can be replaced with actual backend endpoint later)
  setTimeout(() => {
    isSubmitting.value = false
    isSuccess.value = true
  }, 1000)
}
</script>

<style scoped>
.quote-popup-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(15, 23, 42, 0.7);
  backdrop-filter: blur(4px);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 10000;
}
.quote-popup-content {
  background: #ffffff;
  width: 100%;
  max-width: 600px;
  border-radius: 16px;
  padding: 30px;
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  animation: slideUp 0.3s ease-out forwards;
}
@keyframes slideUp {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}
.popup-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}
.popup-header h2 {
  font-size: 24px;
  font-weight: 800;
  color: #0F172A;
  margin: 0;
}
.close-btn {
  background: #F1F5F9;
  border: none;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  font-size: 20px;
  color: #475569;
  cursor: pointer;
  display: flex;
  justify-content: center;
  align-items: center;
  transition: all 0.2s;
}
.close-btn:hover {
  background: #E2E8F0;
  color: #E3000F;
}
.quote-form {
  display: flex;
  flex-direction: column;
  gap: 15px;
}
.form-row {
  display: flex;
  gap: 15px;
}
.form-row .form-group {
  flex: 1;
}
.form-group {
  display: flex;
  flex-direction: column;
  gap: 6px;
}
.form-group label {
  font-size: 13px;
  font-weight: 600;
  color: #334155;
}
.form-group input,
.form-group select,
.form-group textarea {
  padding: 10px 14px;
  border: 1px solid #CBD5E1;
  border-radius: 8px;
  font-size: 14px;
  color: #0F172A;
  outline: none;
  transition: border-color 0.2s;
}
.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
  border-color: #E3000F;
  box-shadow: 0 0 0 3px rgba(227, 0, 15, 0.1);
}
.btn-red {
  background: #E3000F;
  color: white;
  padding: 12px 24px;
  border: none;
  border-radius: 30px;
  font-size: 15px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s;
  margin-top: 5px;
}
.btn-red:hover:not(:disabled) {
  background: #C8000D;
}
.btn-red:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}
.w-100 {
  width: 100%;
}
.success-message {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  padding: 40px 20px;
}
.success-message svg {
  width: 80px;
  height: 80px;
  color: #10B981;
  margin-bottom: 20px;
}
.success-message p {
  font-size: 18px;
  color: #475569;
  line-height: 1.6;
}

@media (max-width: 640px) {
  .quote-popup-content {
    padding: 24px;
    margin: 16px;
    max-height: 90vh;
    overflow-y: auto;
  }
  .form-row {
    flex-direction: column;
  }
  .popup-header h2 {
    font-size: 24px;
  }
}
</style>
