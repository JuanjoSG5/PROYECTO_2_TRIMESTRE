<template>
  <section class="contact-page">
    <ContactForm />
    <img src="https://dummyimage.com/715x752/000/fff" alt="">
  </section>
</template>

<script>
import ContactForm from '../ContactForm.vue';

export default {
  components: {
    ContactForm: ContactForm
  }
}
</script>

<style scoped>
    .contact-page{
      display: grid;
      align-items: center;
      justify-items: center;
      grid-template-columns: 1fr 1fr;
      padding: 2rem 3rem 4rem 5rem;

    }
</style>