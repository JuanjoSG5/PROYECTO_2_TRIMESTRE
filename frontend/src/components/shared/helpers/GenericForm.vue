<template>
    <form class="form-control" @submit.prevent="handleSubmit">
        <!-- Slot for custom form content -->
        <slot :validateForm="validateForm" :handleSubmit="handleSubmit"></slot>
        <!-- SubmitButton component triggers handleSubmit method -->
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
            console.log('Checking if user exists', this.formData.email);
            const postRequest = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({"email": this.formData.email})
            };
            console.log(JSON.stringify(this.formData.email));
            const currentData = await fetch('http://localhost:9000/api/checkUserExists',postRequest)
                .then(response => response.json())
                .catch(error => {
                    console.error('Error fetching user data:', error);
                    return [];
                });

            console.log('currentData:', currentData, currentData.exists);

            return currentData.exists
        },

        handleSubmit() {
            if (this.validateForm()) {
                console.log("form is valid");

                this.checkIfUserExists().then(userExists => {
                    if (!userExists) {
                        // FIXME: There seems to be bug here where sometimes the it calls the login function when it should call the register
                        
                        this.authStore.register(this.formData,this.formSent);
                        this.$router.push('/home')
                        this.formSent = true;
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
