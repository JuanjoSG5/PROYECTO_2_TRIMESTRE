<template>
    <form class="form-control" @submit.prevent="handleSubmit">
        <!-- Slot for custom form content -->
        <slot :validateForm="validateForm" :handleSubmit="handleSubmit"></slot>
        <!-- SubmitButton component triggers handleSubmit method -->
        <SubmitButton @click.prevent="handleSubmit" />
    </form>
    <!-- Display message if form is successfully submitted -->
    <h3 v-if="formSent">The inquiry has been submitted</h3>
</template>
  
<script>
import SubmitButton from './SubmitButton.vue';
import { store } from '../../../context/UserContext.js'

export default {
    components: {
        SubmitButton
    },
    computed: {
        // Computed property to check login status
        logIn: {
            get() {
                return store.isLoggedIn;
            },
            set(value) {
                store.isLoggedIn = value;
            }
        },
    },
    props: {
        // Validation rules object required for form validation
        validationRules: {
            type: Object,
            required: true
        },
        formData: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            formSent: false,
        };
    },
    methods: {
        // Validate the entire form
        validateForm() {
            let correctForm = true;
            for (const fieldName in this.formData) {
                if (!this.validateField(fieldName)) {
                    correctForm = false;
                }
            }
            return correctForm;
        },
        // Validate a single form field
        validateField(fieldName) {
            const rule = this.validationRules[fieldName];
            const value = this.formData[fieldName];
            if (!rule.validator(value)) {
                rule.errorMessage = `Please enter a valid ${rule.label}.`;
                return false;
            }
            return true;
        },
        handleSubmit() {
            if (this.validateForm()) {
                this.logIn = true; 
                this.formSent = true;
                if (this.checkIfUserExists() === false) {
                    console.log("The user doesn't exist. Procced to Sign Up");
                    this.signUpUser();
                }


                

            } 
            console.log('Form is not valid');
        },
        async checkIfUserExists() {
            const currentData = await fetch('http://localhost:9000/api/v1/users')
                .then(response => response.json())
            const userExists = currentData.some(user => user.name === this.formData.username);
            if (userExists) {
                this.errorMessage.username = 'Username already exists';
                return true;
            }
            return false;
        },
        signUpUser() {
            const postRequest = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(this.formData)
            };
            fetch('http://localhost:9000/api/v1/users', postRequest)
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }
    }

};
</script>
  
<style scoped></style>
