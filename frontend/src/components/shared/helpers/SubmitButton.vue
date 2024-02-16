<template>
    <button type="submit" class="submit-button" @click.prevent="handleClick">
      Submit
    </button>
  </template>
  
  <script>
  export default {
    methods: {
      handleClick() {
        this.$emit('submit'); 
        console.log('Button clicked');
      }
    }
  };
  </script>
  
  <style scoped>
  .submit-button {
    display: block;
    width: 100%;
    border: 2px solid var(--vt-c-black);
    border-radius: 12px;
    margin-top: 2rem;
    padding: 16px 32px;
    font-size: 2rem;
    color: var(--vt-c-black);
    background-color: var(--vt-c-black-contrast);
    box-shadow: 4px 4px 8px rgba(82, 109, 130, 0.4);
    cursor: pointer;
  }
  
  .submit-button:hover {
    background-color: rgba(82, 109, 130, 0.4);
    color: var(--vt-c-black-contrast);
    transition: color 0.3s, background-color 0.3s;
    box-shadow: 4px 4px 8px rgba(221, 230, 237, 0.3);
  }
  
  .submit-button:focus {
    box-shadow: 4px 4px 8px rgba(221, 230, 237, 0.3);
    outline: 2px solid var(--vt-c-black-contrast);
  }

  @media (max-width: 1024px) {
    .submit-button {
      width: 78%;
      padding: 10px 20px;
      font-size: 1.5rem;
    }
  }
  </style>
  