<template>
    <section :class="[isMenuRetracted ? 'main-event-content' : 'main-content']">
        <LateralMenu 
            :events="events.data" 
            :editedEvent="editedEvent" 
            :isMenuRetracted="isMenuRetracted" 
            @toggle-menu="toggleMenu" 
            @event="currentEvent = $event"
            @update="getEventFrontApi"
        />
        <section class="events">
            <EventHeader/>
            <section v-if="!isLoading" >
                <section v-if="!isEditMode" class="event-content">
                    <h1 class="event-title">{{ currentEvent.name }}</h1>
                    <p class="event-description">{{ currentEvent.description }}</p>
                    <div class="event-time-edit">
                        <p 
                            
                            class="event-time"
                        >Time: <span 
                            class="actual-time"
                        > {{ getFormattedTime(currentEvent.start_date) }}
                        </span></p>

                        <button class="edit-button" @click="toggleEditMode" v-if="!isEditMode"><Icon icon="material-symbols:edit" /></button>
                    </div>
                </section>
                <section class="event-content" v-else>
                    <input 
                            class="event-title event-title-local" 
                            v-model="editedEvent.name" 
                            
                        >
                    <textarea 
                        class=" event-description event-description-local" 
                        v-model="editedEvent.description" 
                    ></textarea>
                    <div class="event-time-edit event-time-edit-local">
                        <input class="event-time event-time-local" type="datetime" v-model="editedEvent.start_date" >
                        <button class="edit-button" @click="saveChanges" >Save</button>
                    </div>
                </section>
            </section>
            <Loader class="loader" v-else />
        </section>
    </section>
</template>

<script>
import { Icon } from '@iconify/vue'; 
import Loader from '../../shared/Loader.vue'; 
import LateralMenu from '../components/LateralMenu.vue';
import EventHeader from '../components/EventHeader.vue';
import {getTime} from '../helpers/Time'

export default {
    components: { LateralMenu, Icon, Loader,EventHeader },
    data() {
        return {
            isLoading: false,
            isMenuRetracted: false,
            isEditMode: false,
            currentEvent: {},
            events: [],
            editedEvent: {} 
        };
    },
    async mounted() {
        this.toggleLoading()
        await this.getEventFrontApi();
    },
    methods: {
        toggleLoading() {
            this.isLoading = !this.isLoading;
        },
        toggleMenu() {
            this.isMenuRetracted = !this.isMenuRetracted;
        },
        
        toggleEditMode() {
            // TODO: In future chnages make it able to actually change the priority and assign it to the current user
            this.isEditMode = !this.isEditMode;
            this.editedEvent.name = this.currentEvent.name
            this.editedEvent.description = this.currentEvent.description
            this.editedEvent.start_date = getTime()
            this.editedEvent.priority = 'medium'
            this.editedEvent.user_id = 1
        },
        async getEventFrontApi() {
            const eventsData = await fetch('http://localhost:9000/api/v1/events')
                .then(response => response.json());
                console.log("fecth Done");
            this.events = eventsData;
            this.currentEvent = this.events.data[0];
            this.toggleLoading();
        },
        getFormattedTime(dateTimeString) {
            const date = new Date(dateTimeString);
            const hours = date.getHours();
            const minutes = date.getMinutes();
            return `${hours}:${minutes < 10 ? '0' + minutes : minutes}`;
        },
        saveChanges() {
            // TODO: Save changes to the backend
            console.log('Changes saved:', this.editedEvent);
            this.currentEvent = { ...this.editedEvent };
            this.toggleEditMode(); 
        },
    },
};
</script>
<style scoped>
.main-content {
    display: grid;
    grid-template-columns: 1fr 3fr;
    align-items: center;
    justify-items: center;
    height: 100%;

}

.main-event-content {
    display: grid;
    grid-template-columns: 1fr;
    height: 100%;
}

.events {
    display: flex;
    flex-direction: column;
    position: relative;
    background-color: var(--vt-c-black);
    color: var(--vt-c-black-contrast);
    width: 100%;
    height: 100%;

    

    & .event-content{
        display: flex;
        flex-direction: column;
        position: relative;
        height: 90%;

        & .event-title{
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
        & .event-time-edit{
            position:relative
        }
        
        & .event-time{
            display: inline-block;
            font-size: 2rem;
            margin-top: .5rem;
            padding-left: 7rem;
            & .actual-time{
                font-weight: 500;
                color: var(--vt-c-black-mute);
            }
        }
        & .edit-button{
            position: absolute;
            top: 2rem; /* Adjust this value as needed */
            right: 2rem; /* Adjust this value as needed */
            color: var(--vt-c-black-contrast);
            background-color: var(--vt-c-black);
            border: none;
            font-size: 2.5rem;
            width: 5vw;
            
        }

        & .event-title-local{
            border: none;
            border-radius: 0.5rem;
            padding: 0;
            margin-top:6rem ;
            text-align: center;
            color: var(--vt-c-black-contrast);
            background-color: var(--vt-c-black-soft);
            box-shadow: 4px 4px 8px rgba(82, 109, 130, 0.4);
            &:hover {
                outline: 2px solid var(--vt-c-black-contrast);
            }
            &:focus {
                outline: 2px solid /* Your desired outline color */;
            }       
        }

        & .event-description-local{
            margin: auto;
            margin-top:2rem;
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
                outline: 2px solid /* Your desired outline color */;
            }       
        }
        & .event-time-edit-local{
            
            
            & .event-time-local{
                margin-top:2rem;
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
                    outline: 2px solid /* Your desired outline color */;
                }       
            }

            & .edit-button{
                padding:0;
                margin-right: 3rem;
            }
        }
    }
    & .loader{
        position: absolute;
        top: 40%;
        left: 40%;
        justify-content: center;
    }
}

</style>

  