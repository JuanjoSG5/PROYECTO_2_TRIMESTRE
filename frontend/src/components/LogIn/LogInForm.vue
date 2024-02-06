<template>
    <CustomForm :validationRules="validationRules" @submit="handleSubmit">
        <CustomInput 
            label="Username" 
            v-model="formData.username" 
            placeholder="Username"
            :errorMessage="getErrorMessage('username')" 
            @input="handleInputChange('username', $event.target.value)"
        />
        <CustomInput 
            label="Password" 
            type="password" 
            v-model="formData.password"
            :errorMessage="getErrorMessage('password')" 
            @input="handleInputChange('password', $event.target.value)" 
        />
        <CustomInput 
            label="Email" 
            type="email" 
            v-model="formData.email" 
            placeholder="example@gmail.com"
            :errorMessage="getErrorMessage('email')" 
            @input="handleInputChange('email', $event.target.value)" 
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
    props: {
        validateForm: {
        type: Function,
        required: true
        }
    },
    data() {
        return {
            formData: {
                username: '',
                password: '',
                email: ''
            },
            validationRules: {
                username: {
                    label: 'Username',
                    validator: validateUsername
                },
                password: {
                    label: 'Password',
                    validator: validatePassword
                },
                email: {
                    label: 'Email',
                    validator: validateEmail
                }
            }
        };
    },
    methods: {
        
        handleInputChange(fieldName, value) {
            this.formData[fieldName] = value;
            this.validationRules[fieldName].errorMessage = '';
        },
        getErrorMessage(fieldName) {
            return this.validationRules[fieldName].errorMessage;
        },
        handleSubmit() {
            console.log("test");
            if (this.validateForm()) {
                console.log("test11111");
                this.$emit('formValidated', this.formData);
            }

        }
    }
};
</script>
  
<style scoped></style>
  