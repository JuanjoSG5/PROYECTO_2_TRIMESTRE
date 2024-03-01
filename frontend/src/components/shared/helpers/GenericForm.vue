<template>
    <form class="form-control" @submit.prevent="handleSubmit">
        <!-- Slot for custom form content -->
        <slot :validateForm="validateForm" :handleSubmit="handleSubmit"></slot>
        <!-- SubmitButton component triggers handleSubmit method -->
        <!-- FIXME: Change the responsive of the submit button-->
        <SubmitButton @submit="handleSubmit" />
    </form>
</template>

<script>
import SubmitButton from './SubmitButton.vue';
import { useAuthStore } from '../../../store/UserStore.js'

export default {
    components: {
        SubmitButton
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
            authStore: useAuthStore()
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
        async checkIfUserExists() {
            const postRequest = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({"email": this.formData.email})
            };
            const currentData = await fetch(`${import.meta.env.VITE_DATABASE_URL}checkUserExists`,postRequest)
                .then(response => response.json())
                .catch(error => {
                    console.error('Error fetching user data:', error);
                    return [];
                });

            return currentData.exists
        },

        async handleSubmit() {
            if (this.validateForm()) {
                console.log("form is valid");

                await this.checkIfUserExists().then(userExists => {
                    if (!userExists) {
                        this.authStore.register(this.formData) === false ?
                            this.validationRules[this.validationRules.length -1].errorMessage = "An error occurred during register process" 
                            : "";
                        
                    } else {
                        this.authStore.logIn(this.formData);
                        
                    }
                });
            } else {
                for (const fieldName in this.formData) {
                    this.$emit('field-error', {
                        fieldName: fieldName,
                        errorMessage: this.validationRules[fieldName].errorMessage
                    });
                }
            }
        }

    },
    computed:{
        logOut(){
            return this.authStore.logOut()
        }
    }
};
</script>

<style scoped></style>
