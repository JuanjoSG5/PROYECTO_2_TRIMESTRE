<template>
  <form class="form-control" @submit.prevent="submitForm">
      <legend class="form-title">This is the contact Form</legend>
      
      <!-- CustomInput component for selecting inquiry type -->
      <CustomInput 
          label="Inquiry Type" 
          type="select" 
          v-model="selectedInquiry"
          :options="possibleInquiries"
          :formSent="formSent" 
          :errorMessage="selectedInquiryErrorMessage"
          @input="clearSelectedInquiryErrorMessage"
      />

      <CustomInput 
          label="Subject of the inquiry" 
          type="textarea" 
          v-model="userText"
          placeholder="Write here what you want to communicate to us"
          :formSent="formSent"
          :errorMessage="userTextErrorMessage"
          @input="clearUserTextErrorMessage"
      />
      
      <!-- CustomInput component for describing the inquiry -->
      <CustomInput 
          label="Description of the inquiry" 
          type="textarea" 
          v-model="subject"
          placeholder="Write here what you want to communicate to us"
          :formSent="formSent"
          :errorMessage="subjectErrorMessage"
          @input="clearSubjectErrorMessage"
      />
      
      
      <SubmitButton @click="submitForm"/>
      
      <!-- Display message if form is successfully submitted -->
      <h3 v-if="formSent">The inquiry has been submitted</h3>
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
      // Data properties to store form state and input values
      return {
          formSent: false,
          subject: '',
          selectedInquiry: '',
          userText: '',
          possibleInquiries: [
              { label: 'General', value: 'General Inquiry' },
              { label: 'Bug', value: 'Application malfuction' },
              { label: 'Assistance', value: 'assistance' },
              { label: 'Other', value: 'Other Inquiry' }
          ],
          selectedInquiryErrorMessage: '',
          userTextErrorMessage: '',
          subjectErrorMessage: '',
      };
  },
  methods: {
      // Validate and submit the form
      submitForm() {
          this.selectedInquiryErrorMessage = '';
          this.userTextErrorMessage = '';

          // Validate selected inquiry
          if (this.selectedInquiry.trim() === '') {
              this.selectedInquiryErrorMessage = 'Please select an inquiry type';
          }
          // Validate user text description
          if (this.userText.trim() === '') {
              this.userTextErrorMessage = 'Please enter a valid description';
          }

          if(this.subject.trim() === ''){
              this.subjectErrorMessage = 'Please enter a valid subject';
          }

          // If no errors, mark form as submitted and reset after 3 seconds
          if (!this.selectedInquiryErrorMessage && !this.userTextErrorMessage) {
              this.formSent = true;
              setTimeout(() => {
                  this.formSent = false;
              }, 3000); 
          }
      },
      clearSelectedInquiryErrorMessage() {
          this.selectedInquiryErrorMessage = '';
      },
      clearUserTextErrorMessage() {
          this.userTextErrorMessage = '';
      },
      clearSubjectErrorMessage(){
          this.subjectErrorMessage = '';
      }
  }
};
</script>
  
<style scoped>
    .form-title{
        font-size: 2rem;
        margin-bottom: 1rem;
    }
</style>
