<template>
    <section class="login-page">
        <LoginForm/>
        <img src="https://dummyimage.com/715x752/000/fff" alt="login-image" class="login-image" />
    </section>
</template>

<script>
import LoginForm from '../LogInForm.vue';

export default {
    components: {
        LoginForm
    }
}
</script>

<style scoped>
    .login-page {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 1rem;
        align-items: center;
        justify-items: center;
        grid-template-columns: 1fr 1fr;
        padding: 4rem 4rem;
        transition: all 0.3s ease-in-out;
    }

    .login-image {
        height: 70vh;
        width: auto;
        opacity: 1;
        transform: scale(1);
        transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
    }

    @media (max-width: 1024px) {
        .login-image {
            opacity: 0;
            transform: scale(0.8); /* Scale down gradually before hiding */
        }
        .login-page {
            display: block;
        }
    }
    @media (max-width: 1012px) {
        /*No se me ocurre otra manera de hacer que la imagen no se muestre */
        .login-image{
            display: none;
        }
        
    }

    @media (max-width: 768px) {
        
        .login-page {
            padding: 2rem 2rem;
        }
    }
</style>
