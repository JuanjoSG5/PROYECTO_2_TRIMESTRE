<template lang="">
    <Teleport to="#modal">
        <section v-if="showSearchModal" class="modal-bg">
            <section class="modal" ref="modal">
                <CustomInput
                    label="Search"
                    v-model="search"
                    placeholder="Search for your events"
                    @input="handleSearchInput()"
                />
                <hr>
                <section class="results">
                    <section v-for="event in events" :key="event.id">
                        <p>{{ event.name }} - <span :class="getPriorityClass(event.priority)">{{ capitalize(event.priority) }}</span></p>
                    </section>
                </section>
            </section>
        </section>
    </Teleport>
</template>
<script>
import CustomInput from '@/components/shared/helpers/GenericInput.vue';
import { onClickOutside } from '@vueuse/core';

export default {
    data(){
        return {
            modal: null,
            search: ''
        }
    },
    components: {
        CustomInput
    },
    props: {
        events:{
            type: Array,
            required: true
        },
        showSearchModal: {
            type: Boolean,
            required: true
        }
    },
    methods: {
        handleSearchInput(){
            console.log('searching for', this.search);
        },
        capitalize(priority) {
            return priority.charAt(0).toUpperCase() + priority.slice(1);
        },
        getPriorityClass(priority) {
            const lowerPriority = priority.toLowerCase();
            switch (lowerPriority) {
                case 'high':
                    return 'high-priority';
                case 'medium':
                    return 'medium-priority';
                case 'low':
                    return 'low-priority';
                default:
                    return ''; 
            }
        }
    },
    mounted() {
        onClickOutside(this.$refs.modal, () => (this.$emit('close')));
    }
}
</script>
<style scoped>
    .modal-bg{
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 2;
    }
    .modal{
        position: relative;
        background-color: var(--vt-c-black-contrast);
        width: 50vw;
        border-radius: 1rem;
        box-shadow: 0px 10px 5px 2 px rgba(0, 0, 0, 0.1);
    }

    .results{
        color: var(--vt-c-black);
    }
    .high-priority {
    color: #800020; 
    font-weight: bold;
}
.medium-priority {
    font-weight: bold;
    color: navy;
}

.low-priority {
    color: var(--vt-c-black-soft);
    font-weight: bold;
}
</style>