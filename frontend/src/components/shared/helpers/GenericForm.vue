<template>
    <form class="form-control">
        <!-- Slot for custom form content -->
        <slot :validateForm="validateForm" :handleSubmit="handleSubmit"></slot>
        <!-- SubmitButton component triggers handleSubmit method -->
        <SubmitButton @click="handleSubmit" />
    </form>
    <!-- Display message if form is successfully submitted -->
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
        // Computed property to check login status
        logIn() {
            return store.isLoggedIn = true;
        },
    },
    props: {
        // Validation rules object required for form validation
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
        // Validate the entire form
        validateForm() {
            let correctForm = true;
            for (const fieldName in this.validationRules) {
                if (!this.validateField(fieldName)) {
                    correctForm = false;
                }
            }
            return correctForm;
        },
        // Validate a single form field
        validateField(fieldName) {
            const rule = this.validationRules[fieldName];
            if (!rule.validator(this.formData[fieldName])) {
                rule.errorMessage = `Please enter a valid ${rule.label}.`;
                return false;
            }
            return true;
        },
        handleSubmit() {
            console.log('result' + this.validateForm());
            if (this.validateForm()) {
                this.logIn();
                this.formSent = true;
            }
        }
    }
};
</script>
  
<style scoped>

</style>
