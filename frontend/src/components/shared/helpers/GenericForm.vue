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
import { store } from '../../../store/UserStore.js'

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
        };
    },
    methods: {
        // Validate the entire form
        validateForm() {
            let correctForm = true;
            console.log('formData:', this.formData);
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
            console.log('rule:', rule);
            const value = this.formData[fieldName];
            if (!rule.validator(value)) {
                console.log('Invalid field:', fieldName);
                rule.errorMessage = `Please enter a valid ${rule.label}.`;

                return false;
            }
            return true;
        },
        async checkIfUserExists() {
            console.log('Checking if user exists');
            const currentData = await fetch('http://localhost:9000/api/v1/users')
                .then(response => response.json())
                .catch(error => {
                    console.error('Error fetching user data:', error);
                    return [];
                });

            console.log('currentData:', currentData);

            if (Array.isArray(currentData.data)) {
                const userExists = currentData.data.some(user => user.name === this.formData.name);
                if (userExists) {
                    return true;
                }
                return false;
            } else {
                console.error('Unexpected response format: currentData is not an array');
                return false;
            }
        },

        async createUser() {
            console.log(JSON.stringify(this.formData));

            const postRequest = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(this.formData)
            };
            console.log('Sending post request:', postRequest);
            await fetch('http://localhost:9000/api/v1/users', postRequest)
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
            this.logIn = true;
            this.formSent = true;
        },

        handleSubmit() {
            if (this.validateForm()) {
                console.log("form is valid");

                this.checkIfUserExists() === false ?
                    // TODO: Implement a log in function here and remove the following line
                    console.log('User does not exist')
                    : this.createUser();

            }else{
                for (const fieldName in this.formData) {
                    this.$emit('field-error', {
                        fieldName: fieldName,
                        errorMessage: this.validationRules[fieldName].errorMessage
                    });
                }

            }

        }
    }

};
</script>

<style scoped></style>
