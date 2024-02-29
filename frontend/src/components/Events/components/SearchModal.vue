<template lang="">
    <Teleport to="#modal">
        <section v-if="showSearchModal" class="modal-bg">
            <section class="modal" ref="modal">
                <Icon class="search-icon" icon="ph:magnifying-glass-bold" />
                
                <CustomInput
                    label="Search"
                    v-model="search"
                    placeholder="Search for your events"
                    @input="handleSearchInput()"
                />
                <hr>
                <section class="results">
                    <section v-for="event in localEvents" :key="event.id">
                        <p>
                            {{ event.name }} - 
                            <span :class="getPriorityClass(event.priority)">{{ capitalize(event.priority) }}</span>
                            {{ event.end_date == '01/01/1970 01:00' ? '' :  event.end_date}}
                        </p>
                        
                    </section>
                </section>
            </section>
        </section>
    </Teleport>
</template>
<script>

import { Icon } from '@iconify/vue';
import CustomInput from '@/components/shared/helpers/GenericInput.vue';
import { onClickOutside } from '@vueuse/core';
import { getFormattedTime } from '../helpers/Time.js';
export default {
    data(){
        return {
            localEvents: [],
            modal: null,
            search: ''
        }
    },
    components: {
        CustomInput,Icon
    },
    emits: ['close'],
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
    watch: {
        events: {
            immediate: true,
            handler(newEvents) {
                this.localEvents = newEvents.map(event => {
                    return {
                        ...event,
                        start_date: getFormattedTime(event.start_date)
                    };
                });
            }
        }
    },
    mounted() {
        this.localEvents = this.events.map(event => {
            return {
                ...event,
                end_date: getFormattedTime(event.end_date)
            };
        });
        console.log(this.localEvents);
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