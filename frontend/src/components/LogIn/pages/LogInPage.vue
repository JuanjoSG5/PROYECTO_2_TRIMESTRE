<template>
    <section class="login-page">
        <LoginForm />
        <img  src="https://dummyimage.com/715x752/000/fff" alt="login-image" class="login-image" />
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
    .login-page{
        display:grid;
        grid-template-columns: 1fr 1fr;
        align-items: center;
        justify-items: center;
        grid-template-columns: 1fr 1fr;
        padding: 2rem 3rem 4rem 5rem;

    }

    .login-image {
        height: 70vh;
        width: auto;
        opacity: 1;
        transition: opacity 0.3s ease-in-out;
    }

    @media (max-width: 1024px) {
        .login-image {
            opacity: 0;
        }
    }

</style>
