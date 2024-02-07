<template>
    <form class="form-control">
        <slot :validateForm="validateForm" :handleSubmit="handleSubmit"></slot>
        <SubmitButton @click="handleSubmit" />
        
    </form>
    <h3 v-if="formSent">The inquiry has been submitted</h3>
</template>
  
<script>
import SubmitButton from './SubmitButton.vue';
import {store} from '../../../context/UserContext.js'

export default {
    components: {
        SubmitButton
    },
    computed: {
        logIn() {
            return store.isLoggedIn = true;
        },
    },
    props: {
        validationRules: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            formData: {},
            formSent: false,
        };
    },
    methods: {
    validateForm() {
        let correctForm = true;
        for (const fieldName in this.validationRules) {
            if (!this.validateField(fieldName)) {
                correctForm = false;
            }
        }
        console.log('Form validation result:', correctForm); // Log form validation result
        return correctForm;
    },
    validateField(fieldName) {
        const rule = this.validationRules[fieldName];
        if (!rule.validator(this.formData[fieldName])) {
            rule.errorMessage = `Please enter a valid ${rule.label}.`;
            console.log(`Validation failed for ${fieldName}: ${rule.errorMessage}`); // Log validation failure
            return false;
        }
        console.log(`Validation passed for ${fieldName}`); // Log validation success
        return true;
    },
    handleSubmit() {
        console.log('Submit button clicked'); // Check if handleSubmit is being triggered
        if (this.validateForm()) {
            this.logIn();
            this.formSent = true;
            console.log('Form submitted successfully'); // Check if form submission is successful
        }
        else {
            console.log('Form validation failed'); // Check if form validation fails
        }
    }
}

};
</script>
  
<style scoped>
.form-control {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
</style>
  