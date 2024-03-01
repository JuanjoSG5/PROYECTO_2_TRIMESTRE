<template>
  <section class="contact-page">
    <ContactForm />
    <img class="contact-image" src="https://dummyimage.com/715x752/000/fff" alt="">
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
      padding: 4rem 3rem ;
      box-sizing: border-box;
    }
    .contact-image{
      height: 70vh;
      width: auto;
      opacity: 1;
      transition: opacity 0.3s ease-in-out;
      border-radius: 12px;
    }
    @media (max-width: 1024px) {
      
      .contact-page {
            display: block;
        }
        .contact-image {
            display: none;
            transform: scale(0.8); /* Scale down gradually before hiding */
        }
    }

    @media (max-width: 768px) {
      
      .contact-page {
            display: block;
        } 
        
        .contact-page {
            padding: 2rem 2rem;
        }
    }



</style>