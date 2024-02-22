<template>
    <section v-if="!isEditMode" class="event-content">
        <section>
            <h1 class="event-title">{{ currentEvent.name }}</h1>
            <p class="event-description">{{ currentEvent.description }}</p>
            <div class="event-time-edit" v-if="Object.keys(currentEvent).length > 0">
                <p class="event-time">Time:
                    <span class="actual-time"> {{ getFormattedTime(currentEvent.start_date) }}</span>
                </p>
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
            <button class="edit-button" @click="saveChanges">Save</button>
        </div>
    </section>
</template>

<script>
import { Icon } from '@iconify/vue';
import { getTime } from '../helpers/Time';

export default {
    components: { Icon },
    props: {
        currentEvent: {
            type: Object,
            required: true
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
                    'Accept': 'application/json'
                },
                body: JSON.stringify(this.editedEvent)
            };
            await fetch(`http://localhost:9000/api/v1/events/${this.currentEvent.id}`, postRequest)
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
            this.toggleEditMode();
            this.$emit('put'); // Emit the "put" event using "$emit"
        }
    },
    watch: {
        currentEvent(newVal, oldVal) {
            console.log('currentEvent updated:', newVal);
        }
    },
}
</script>
<style scoped>
.event-content {
    display: flex;
    flex-direction: column;
    position: relative;
    height: 90%;

    & .event-title {
        margin: auto;
        padding-top: 5rem;
        font-size: 3rem;
    }

    & .event-description {
        font-size: 2rem;
        padding-left: 7rem;
        margin-top: 1.3rem;
        margin-bottom: 1.3rem;
        min-height: 20vh;
        max-height: 50vh;
        resize: none;
        overflow: hidden;
    }

    & .event-time-edit {
        position: relative
    }

    & .event-time {
        display: inline-block;
        font-size: 2rem;
        margin-top: .5rem;
        padding-left: 7rem;

        & .actual-time {
            font-weight: 500;
            color: var(--vt-c-black-mute);
        }
    }

    & .edit-button {
        position: absolute;
        top: 2rem;
        right: 2rem;
        /* Adjust this value as needed */
        color: var(--vt-c-black-contrast);
        background-color: var(--vt-c-black);
        border: none;
        font-size: 2.5rem;
        width: 5vw;

    }

    & .event-title-local {
        border: none;
        border-radius: 0.5rem;
        padding: 0;
        margin-top: 6rem;
        text-align: center;
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
        margin: auto;
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
            margin-left: 4rem;
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
}</style>