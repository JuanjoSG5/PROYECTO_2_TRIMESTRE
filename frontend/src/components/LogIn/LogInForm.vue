<template>
    <form class="form-control" action="">
        <legend>This is the log in form</legend>
        <CustomInput label="Username" v-model="username" placeholder="Username" />
        <CustomInput label="Password" type="password" v-model="password"  />
        <CustomInput label="Email" type="email" v-model="email" placeholder="example@gmail.com" />
        <SubmitButton label="Submit" />
    </form>
</template>

<script>
import CustomInput from '../shared/helpers/GenericInput.vue';
import SubmitButton from '../shared/helpers/SubmitButton.vue';

export default {
    components: {
        CustomInput,
        SubmitButton
    },
    data() {
        return {
            username: '',
            password: '',
            email: ''
        };
    }
}
</script>

<style scoped>
.form-control {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center; 
}
</style>
