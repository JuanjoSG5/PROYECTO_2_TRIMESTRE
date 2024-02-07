<template>
    <CustomForm :validationRules="validationRules" >
        <CustomInput 
            label="Username" 
            v-model="formData.username" 
            placeholder="Username"
            :errorMessage="errorMessage.username" 
            @input="handleInputChange('username', $event.target.value)"
        />
        <CustomInput 
            label="Password" 
            type="password" 
            v-model="formData.password"
            :errorMessage="errorMessage.password" 
            @input="handleInputChange('password', $event.target.value)" 
        />
        <CustomInput 
            label="Email" 
            type="email" 
            v-model="formData.email" 
            placeholder="example@gmail.com"
            :errorMessage="errorMessage.email" 
            @input="handleInputChange('email', $event.target.value)" 
        />
        
        
    </CustomForm>
</template>

<script>
// Import necessary components and methods
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
                username: '',
                password: '',
                email: ''
            },
            errorMessage: {
                username: '',
                password: '',
                email: ''
            },
            validationRules: {
                username: {
                    label: 'Username',
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
    this.formData[fieldName] = value; // Assign value to the corresponding field in formData
    this.errorMessage[fieldName] = ''; // Clear error message for the specific field
},

        getErrorMessage(fieldName) {
            return this.validationRules[fieldName].errorMessage;
        }
    }
};
</script>
  
<style scoped></style>
  