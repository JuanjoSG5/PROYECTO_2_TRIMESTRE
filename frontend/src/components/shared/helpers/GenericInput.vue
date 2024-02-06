<template>
        <label class="label">{{ label }}
            <select 
                v-if="type === 'select'" 
                class="input" 
                :value="value" 
                @change="$emit('input', $event.target.value)"
            >

                <option 
                    class="input"
                    v-for="option in options" 
                    :value="option.value">
                    {{ option.label }}
                </option>
            </select>
            <textarea 
                v-else-if="type === 'textarea'" 
                class="text-area" 
                :value="value" 
                :placeholder="placeholder"
                @input="$emit('input', $event.target.value)">
            </textarea>
            <input 
                v-else 
                class="input"
                :type="type" 
                :value="value" 
                :placeholder="placeholder"
                @input="$emit('input', $event.target.value)" 
            />
        </label>
</template>

<script>
export default {
    props: {
        label: {
            type: String,
            required: true
        },
        type: {
            type: String,
            default: 'text'
        },
        value: {
            type: [String, Number],
            default: ''
        },
        placeholder: {
            type: String,
            default: ''
        },
        options: {
            type: Array,  
            default: () => []  
        }
    }
}
</script>

<style scoped>

.label {
    font-weight: bold;
    margin-bottom: 5px;
    width: 33vw;
}

.text-area{
    width: 95.8%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.text-area:focus,
.text-area:focus-visible {
    outline: 2px solid var(--vt-c-black-mute);
}

.input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.input:focus,
.input:focus-visible {
    outline: 2px inset var(--vt-c-black-mute);
}
</style>
