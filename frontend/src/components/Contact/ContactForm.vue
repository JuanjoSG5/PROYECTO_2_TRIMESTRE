<template>
    <form class="form-control" @submit="submitForm">
        <legend>This is the contact Form</legend>
        <CustomInput label="Inquiry Type" type="select" v-model="selectedInquiry" :options="possibleInquiries" />
        <CustomInput label="Description of the inquiry" type="textarea" v-model="userText" placeholder="Write here what you want to communicate to us" />
        <SubmitButton  />
    </form>
</template>
  
<script>
import CustomInput from '../shared/helpers/GenericInput.vue';
import SubmitButton from '../shared/helpers/SubmitButton.vue';

export default {
    components: {
        CustomInput,
        SubmitButton
    },
    data() {
        return {
            selectedInquiry: '', 
            userText: '',
            possibleInquiries: [    
                { label: 'General', value: 'General Inquiry' },
                { label: 'Bug', value: 'Application malfuction' },
                { label: 'Assistance', value: 'assistance' },
                { label: 'Other', value: 'Other Inquiry'}
            ]
        };
    },
    methods: {
        submitForm() {
            console.log('Form submitted');
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
