<template>
    <button type="button" class="button loginButton" @click="goToLogin">
        Log In 
    </button>
    <button type="button" class="button signupButton" @click="goToSignup">
        Sign Up
    </button>
</template>

<script>
export default {
    computed: {
        isLoggedIn() {
            return store.isLoggedIn;
        },
    },
    methods: {
        goToLogin() {
            this.$router.push('/login');
        },
        goToSignup() {
            this.$router.push('/signup');
        }
    }
}
</script>

<style scoped>
.button {
    border-radius: 8px;
    font-size: 30px;
    width: 44vw;
    height: 10vh;
    font-weight: bold;
    text-align: center;
    margin-bottom: 8px;
    transition: background-color 0.5s, color 0.5s; /* Add transition for smooth hover effect */
}

.loginButton {
    background-color: var(--vt-c-black-contrast);
    color: var(--vt-c-black);
}

.signupButton {
    background-color: rgba(157, 178, 191, 0.514);
    color: var(--vt-c-black-contrast);
}

/* Add hover effect */
.button:hover {
    cursor: pointer; /* Change cursor to pointer on hover */
}

.loginButton:hover {
    background-color: rgba(221, 230, 237, 0.813);
    color:     rgba(39, 55, 77, 0.886);
}

.signupButton:hover {
    background-color: rgba(157, 178, 191, 0.306);
    color: rgba(221, 230, 237, 0.765);
}

@media (max-width: 1024px) {
    .button {
        width: 80vw;
    }
}

@media (max-width: 768px){
    .button {
        width: 80vw;
    }
}
</style>
