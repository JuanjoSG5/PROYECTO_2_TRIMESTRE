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
        console.log("Validating the entire form...");
        let correctForm = true;
        for (const fieldName in this.formData) {
            if (!this.validateField(fieldName)) {
                correctForm = false;
            }
        }
        console.log("Form validation result:", correctForm);
        return correctForm;
    },
    // Validate a single form field
    validateField(fieldName) {
        console.log("Validating field:", fieldName);
        const rule = this.validationRules[fieldName];
        const value = this.formData[fieldName];
        console.log("Value of", fieldName, ":", value);
        if (!rule.validator(value)) {
            rule.errorMessage = `Please enter a valid ${rule.label}.`;
            console.log("Validation failed for field:", fieldName);
            console.log("Error message:", rule.errorMessage);
            return false;
        }
        console.log("Validation passed for field:", fieldName);
        return true;
    },
    handleSubmit() {
        console.log("Handling form submission...");
        console.log('Form validation result:', this.validateForm());
        if (this.validateForm()) {
            console.log("Form is valid. Logging in...");
            this.logIn = true; // Calling the setter to update the login status
            this.formSent = true;
        } else {
            console.log("Form submission halted due to validation errors.");
        }
    }


    }

};
</script>
  
<style scoped></style>
