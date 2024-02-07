<template>
    <form class="form-control" >
      <slot :validateForm="validateForm"></slot>
      <SubmitButton />
    </form>
  </template>
  
  <script>
  import SubmitButton from './SubmitButton.vue';
  
  export default {
    components: {
      SubmitButton
    },
    props: {
      validationRules: {
        type: Object,
        required: true
      }
    },
    data() {
      return {
        formData: {}
      };
    },
    methods: {
      getErrorMessage(fieldName) {
        return this.validationRules[fieldName].errorMessage;
      },
      validateForm() {
        let correctForm = true;
        for (const fieldName in this.validationRules) {
          if (!this.validateField(fieldName)) {
            correctForm = false;
          }
        }
        return correctForm;
      },
      validateField(fieldName) {
        const rule = this.validationRules[fieldName];
        if (!rule.validator(this.formData[fieldName])) {
          rule.errorMessage = `Please enter a valid ${rule.label}.`;
          return false;
        }
        return true;
      },
      handleSubmit() {
        if (this.validateForm()) {
          this.$emit('submit', this.formData);
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
  