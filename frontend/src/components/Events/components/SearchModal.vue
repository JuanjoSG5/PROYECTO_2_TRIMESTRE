<template lang="">
    <Teleport to="#modal">
        <section v-if="showSearchModal" class="modal-bg">
            <section class="modal" ref="modal">
                <section class="modal-searchbar">
                    <Icon height="2rem"class="search-icon" icon="ph:magnifying-glass-bold" />
                    
                    <CustomInput
                        class="search-input"
                        v-model="search"
                        aria-label="search"
                        placeholder="Search for your events"
                        @input="handleSearchInput"
                    />
                </section>
                <hr>
                <section class="results">
                    <section v-for="event in filteringEvents" :key="event.id">
                        <p class="event">
                            <span class="event-name-time">{{ event.name }} -
                                <span 
                                    :class="getPriorityClass(event.priority)"
                                >
                                {{ capitalize(event.priority) }}
                                </span>
                            </span>  
                            <span class="time">{{ event.end_date == '01/01/1970 01:00' ? '' :  event.end_date}}</span>
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
            filteringEvents: [],
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
        handleSearchInput(event){
            // This function is supposed to filter the events based on the search input names 
            // and display the results in the modal
            const value = event.target.value;
            this.search = value;
            this.filteringEvents = this.localEvents.filter(event => {
                return event.name.toLowerCase().includes(this.search.toLowerCase());
            });
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
        this.filteringEvents = this.localEvents;
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

    .modal-searchbar{
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        height: 4rem;
        
    }
    .search-icon{
        color: var(--vt-c-black);
        padding: 0.5rem;
    }
    .search-input{
        padding-top:2rem;
    }
    .results{
        font-size: 1rem;
        margin: 0;
        margin-top: 1.3rem;
        margin-bottom: 1.3rem;
        width: 100%;
        min-height: 20vh;
        max-height: 50vh;
        resize: none;
        overflow: auto;
        color: var(--vt-c-black);
    }
  
    .event {
        display: flex;
        justify-content: space-between;
        margin: 0;
        padding:.5rem;
        transition: 1s;
    }

    .event-name-time {
        padding-left:2rem;
    }

    .time{
        padding-right: 2rem;
        justify-self: flex-end;
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
