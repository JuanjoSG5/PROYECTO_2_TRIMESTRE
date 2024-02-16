<template>
  <label class="label">{{ label }}
      <!-- Select dropdown -->
      <select 
          v-if="type === 'select'" 
          class="input" 
          :value="value" 
          @change="$emit('input', $event.target.value)"
      >
          <!-- Dynamically generate options -->
          <option 
              class="input"
              v-for="option in options" 
              :value="option.value">
              {{ option.label }}
          </option>
      </select>
      <!-- Textarea input -->
      <textarea 
          v-else-if="type === 'textarea'" 
          class="input" 
          :value="getValue()"
          :placeholder="placeholder"
          @input="$emit('input', $event.target.value)">
      </textarea>
      <!-- Default input -->
      <input 
          v-else 
          class="input"
          :type="type" 
          :placeholder="placeholder"
      />
      
      <div v-if="errorMessage" class="error-message">{{ errorMessage }}</div>
  </label>
</template>

<script>
export default {
  props: {
      
      label: {
          type: String,
          required: true
      },
      // Type of input field: 'text' by default
      type: {
          type: String,
          default: 'text'
      },
      // Value of the input field
      value: {
          type: [String, Number],
          default: ''
      },
      placeholder: {
          type: String,
          default: ''
      },
      // Options for select input field
      options: {
          type: Array,  
          default: () => []  
      },
      
      errorMessage: {
          type: String,
          default: ''
      },
      
      formSent: {
          type: Boolean,
          default: false
      }
  },
  methods: {
      // Get value of the input field, reset if form is submitted
      getValue() {
          return this.formSent ? '' : this.value;
      }
  }
}
</script>

<style scoped>

.label {
    font-size: 1.5rem;
  font-weight: bold;
  margin-bottom:4vh;
  width: 40vw;
}



.input {
  width: 100%;
  height: 7vh;
  font-size: 1rem;
  padding: 10px;
  margin: 10px 0;
  border: 2px solid var(--vt-c-black-contrast);
  box-sizing: border-box;
  border-radius: 4px;
}
.input:focus,
.input:focus-visible {
  outline: 2px inset var(--vt-c-black-mute);
}

.error-message {
  color: var(--vt-c-red);
  font-size: 12px;
  margin-top: 5px;
}

@media (max-width: 1024px) {
  .label{
    display: block;
  }
  .input {
    height: 10vw;
    width: 70vw;
  }
}

@media (max-width: 1024px) {
  .label {
    margin-top: 16px;
      width: 50vw;
  }
}


</style>
