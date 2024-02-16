<template>
    <CustomForm :formData="formData" :validationRules="validationRules" @field-error="handleFieldError">
        <legend class="form-title"> Log In</legend>
        <p class="signup-suggestion">Don’t have an count yet 
            <router-link class="route" to="/register">Sign Up</router-link>
        </p>
        <CustomInput 
            label="Name" 
            v-model="formData.name" 
            placeholder="Name"
            :errorMessage="errorMessage.name" 
            @input="handleInputChange('name', $event.target.value)"
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
// Import necessary components and methods
import CustomInput from '../shared/helpers/GenericInput.vue';
import CustomForm from '../shared/helpers/GenericForm.vue';
import { validatePassword, validateUsername } from '../shared/helpers/InputValidation.js';

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
            },
            errorMessage: {
                name: '',
                password: '',
            },
            validationRules: {
                name: {
                    label: 'name',
                    validator: (value) => validateUsername(value),
                    errorMessage: '' // Initialize error message in validation rules
                },
                password: {
                    label: 'password',
                    validator: (value) => validatePassword(value),
                    errorMessage: '' // Initialize error message in validation rules
                },
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
        text-decoration: none;
        font-weight: bold;
        border-radius: .5rem;
        transition: background-color 0.8s, color 0.8s;
        &:hover{
            background-color: var(--vt-c-black-mute);
            color: var(--vt-c-black);
        }
    }
</style>
