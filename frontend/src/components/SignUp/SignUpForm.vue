<template>
    <CustomForm :formData="formData" :validationRules="validationRules" @field-error="handleFieldError">
        <legend class="form-title">Sign Up</legend>
        <p class="signup-suggestion">Already have an account?
            <router-link class="route" to="/login">Log In</router-link>
        </p>
        <CustomInput 
            label="Name" 
            v-model="formData.name" 
            placeholder="Name"
            :errorMessage="errorMessage.name" 
            @input="handleInputChange('name', $event.target.value)"
        />
        <CustomInput 
            label="Email" 
            type="email" 
            v-model="formData.email" 
            placeholder="example@gmail.com"
            :errorMessage="errorMessage.email" 
            @input="handleInputChange('email', $event.target.value)" 
        />

        <CustomInput 
            label="Password" 
            type="password" 
            v-model="formData.password"
            :errorMessage="errorMessage.password" 
            @input="handleInputChange('password', $event.target.value)" 
        />
        
    </CustomForm>
</template>

<script>
import CustomInput from '../shared/helpers/GenericInput.vue';
import CustomForm from '../shared/helpers/GenericForm.vue';
import { validateEmail, validatePassword, validateUsername } from '../shared/helpers/InputValidation.js';

export default {
    components: {
        CustomInput,
        CustomForm
    },
    data() {
        return {
            
            formData: {
                name: '',
                password: '',
                email: ''
            },
            errorMessage: {
                name: '',
                password: '',
                email: ''
            },
            validationRules: {
                name: {
                    label: 'Name',
                    validator: (value) => validateUsername(value) 
                },
                password: {
                    label: 'Password',
                    validator: (value) => validatePassword(value)
                },
                email: {
                    label: 'Email',
                    validator: (value) => validateEmail(value) 
                }
            }
        };
    },
    methods: {
        handleInputChange(fieldName, value) {
            this.formData[fieldName] = value; 
            this.errorMessage[fieldName] = '';
        },
        handleFieldError({ fieldName, errorMessage }) {
            this.errorMessage[fieldName] = errorMessage;
        }
    }
};
</script>
  
<style scoped>
    
    .form-title{
        font-size: 3rem;
        font-weight: bold;
    }
    
    .signup-suggestion{
        font-size: 1.5rem;
    }
    .route{
        
        background-color: var(--vt-c-black);
        color: var(--vt-c-black-contrast);
        text-decoration: none;
        font-weight: bold;
        border-radius: .5rem;
        transition: background-color 0.8s, color 0.8s;
        &:hover{
            background-color: var(--vt-c-black-contrast);
            color: var(--vt-c-black);
        }
    }
</style>
  