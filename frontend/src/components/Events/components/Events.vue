<template>
    <section v-if="!isEditMode" class="event-content">
        <section>
            <h1 class="event-title">{{ currentEvent.name }}</h1>
            <p class="event-description">{{ currentEvent.description }}</p>
            <div class="event-time-edit" v-if="Object.keys(currentEvent).length > 0">
                <p class="event-time">Time:
                    <span class="actual-time"> {{ getFormattedTime(currentEvent.start_date) }}</span>
                </p>
                <label class="select-label">
                    <select 
                        class="priority-select"
                        :class="priorityClass(currentEvent.priority)"
                        :value="currentEvent.priority"
                        disabled
                    >
                        <option> {{ currentEvent.priority }}</option>
                     
                    </select>
                </label>
                <button class="edit-button" @click="$emit('edit')" v-if="!isEditMode">
                    <Icon icon="material-symbols:edit" />
                </button>
            </div>
            
        </section>
    </section>
    <section class="event-content" v-else>
        <input class="event-title event-title-local" v-model="editedEvent.name">
        <textarea class=" event-description event-description-local" v-model="editedEvent.description"></textarea>
        <div class="event-time-edit event-time-edit-local">
            <input class="event-time event-time-local" type="datetime" v-model="editedEvent.start_date">
            <label class="select-label">
                <select 
                    class="priority-select"
                    v-model="editedEvent.priority"
                    :class="priorityClass(editedEvent.priority)"
                >
                    <option
                        v-for="priority in priorities"
                        :value="priority.value"
                        :key="priority.value"
                        :class="priorityClass(priority.label)"
                    >
                        {{ priority.label }}
                    </option>
                </select>
            </label>
            <button class="edit-button" @click="saveChanges">Save</button>
        </div>
    </section>
</template>

<script>

import { Icon } from '@iconify/vue';
import { getTime } from '../helpers/Time';
import { useAuthStore } from '../../../store/UserStore';
export default {
    components: { Icon },
    data(){
        return {
            authStore : useAuthStore(),
            priorities: [
                {label: 'High', value: 'High'},
                {label: 'Medium', value: 'Medium'},
                {label: 'Low', value: 'Low'}
            ]
        }
    },
    props: {
        currentEvent: {
            type: Object,
        },
        editedEvent: {
            type: Object,
            required: true
        },
        isEditMode: {
            type: Boolean,
            required: true
        },
    },
    emits: [
        'put',
        'edit'
    ],

    methods: {
        getFormattedTime(time) {
            return getTime(time);
        },
        async saveChanges() {
            const postRequest = {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${this.authStore.store.token}`
                },
                body: JSON.stringify(this.editedEvent)
            };
            await fetch(`${import.meta.env.VITE_DATABASE_URL}/events/${this.currentEvent.id}`, postRequest)
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
            this.$emit('put'); // Emit the "put" event using "$emit"
        },
        priorityClass(label) {
            switch(label) {
                case 'High' || 'high': return 'high-priority';
                case 'Medium' || 'medium': return 'medium-priority';
                case 'Low' || 'low': return 'low-priority';
                default: return '';
            }
        },
    }
}
</script>
<style scoped>
.event-content {
    display: flex;
    flex-direction: column;
    position: relative;
    height: 90%;
    padding-left: 3rem;

    & .event-title {
       padding-left: 5rem;
        font-size: 3rem;
        margin-top:5rem;
        margin-bottom: 4rem;
    }

    & .event-description {
        font-size: 2rem;
        margin: 0;
        margin-top: 1.3rem;
        margin-bottom: 1.3rem;
        width: 80%;
        min-height: 20vh;
        max-height: 50vh;
        resize: none;
        overflow: auto;
    }

    & .event-time-edit {
        position: relative;
    }

    & .event-time {
        display: inline-block;
        font-size: 2rem;
        margin: 0;

        & .actual-time {
            font-weight: 500;
            color: var(--vt-c-black-mute);

           
        }
    }
    & .select-label{
        padding:0rem 3rem;
        font-size: 2rem;
        
        & .priority-select {
            font-size: 2rem;
            background-color: var(--vt-c-black-contrast);
            color: var(--vt-c-black);
            text-align: center;
            border: none;
            border-radius: 1rem;
            
            & .priority-option{
                border: 2px solid var(--vt-c-black-contrast);
                background-color: var(--vt-c-black-contrast);
                text-align: center;
                &:hover{
                    background-color: var(--vt-c-black-contrast)
                }
            }

            
        }
    }

    & .edit-button {
        position: absolute;
        top: .5rem;
        right: 2rem;
        /* Adjust this value as needed */
        color: var(--vt-c-black-contrast);
        background-color: var(--vt-c-black);
        border: none;
        font-size: 2.5rem;
        height: 5vh;
        width: 5vw;

    }

    & .event-title-local {
        border: none;
        border-radius: 0.5rem;
        padding: 0;
        margin-top: 6rem;
        color: var(--vt-c-black-contrast);
        background-color: var(--vt-c-black-soft);
        box-shadow: 4px 4px 8px rgba(82, 109, 130, 0.4);

        &:hover {
            outline: 2px solid var(--vt-c-black-contrast);
        }

        &:focus {
            outline: 2px solid
                /* Your desired outline color */
            ;
        }
    }

    & .event-description-local {
        margin-top: 2rem;
        padding: 0;
        border: none;
        border-radius: .5rem;
        background-color: var(--vt-c-black-soft);
        color: var(--vt-c-black-contrast);
        box-shadow: 4px 4px 8px rgba(82, 109, 130, 0.4);
        width: 80%;

        &:hover {
            outline: 2px solid var(--vt-c-black-contrast);
        }

        &:focus {
            outline: 2px solid
                /* Your desired outline color */
            ;
        }
    }

    & .event-time-edit-local {


        & .event-time-local {
            margin-top: 2rem;
            padding: 0;
            border: none;
            border-radius: .5rem;
            background-color: var(--vt-c-black-soft);
            color: var(--vt-c-black-contrast);
            text-align: center;
            box-shadow: 4px 4px 8px rgba(82, 109, 130, 0.4);
            width: 33%;

            &:hover {
                outline: 2px solid var(--vt-c-black-contrast);
            }

            &:focus {
                outline: 2px solid
                    /* Your desired outline color */
                ;
            }
        }

        & .edit-button {
            padding: 0;
            margin-right: 3rem;
        }
    }

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

@media (max-width: 1440px) {
    .event-content {
        padding: 0;
        width: 100%;

        & .event-title{
            padding: 0;
            width: 80%;
        }
    }
}

@media (max-width: 1024px) {
    .event-content {
        padding: 0;
        width: 65vw;

        & .event-title{
            padding: 0;
        width: 80%;
        }
    }
}

@media (max-width: 768px) {
    .event-content {
        padding: 0;
        width: 100%;

        & .event-title{
            padding: 0;
            width: 80%;
        }
    }
}



</style>