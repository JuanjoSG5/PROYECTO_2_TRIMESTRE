<template>
    <aside :class="{ 'lateral-menu': true, 'retracted': isMenuRetracted }">
        <section id="modal"></section>
        <h2 class="menu-title" @click="toggleMenu">
            Events of username
            <Icon class="menu-arrow" icon="solar:double-alt-arrow-right-line-duotone" />
            <span>
                <Icon :class="[isMenuRetracted ? 'hidden-menu-arrow' : 'hidden-arrow']"
                    icon="solar:double-alt-arrow-right-line-duotone" />
            </span>
        </h2>
        <button class="search-button">
            <p 
                class="search-button-text"
                
                @click="showSearchModal = true"
            >
                <Icon class="search-icon" icon="ph:magnifying-glass-bold" />
                Search for your events
            </p>
            <SearchModal 
                v-if="showSearchModal" 
                :events="events"
                :showSearchModal="showSearchModal"
                @close="showSearchModal = false"
            />
        </button>
        <button class="create-event-button" @click="createEvent">
            <p class="create-event-text">
                <Icon class="create-icon" icon="iconamoon:sign-plus-circle-bold" />
                Create a new event
            </p>
        </button>
        <section class="prioritary-events">
            <h2>
                <Icon class="down-arrow" icon="lets-icons:arrow-drop-down-big" /> High priority
            </h2>
            <ul class="prioritary-list">
                <li 
                    v-for="event in highPriorityEvents" 
                    :key="event.id" 
                    class="event" 
                    @click="$emit('event', event)">
                    {{ event.name }} - <span class="high-priority">{{ capitalize(event.priority) }}</span>
                </li>

            </ul>
        </section>
        <section class="events">
            <h2>
                <Icon class="down-arrow" icon="lets-icons:arrow-drop-down-big" /> Events
            </h2>
            <ul  class="events-list">
                <li 
                    v-for="event in events" 
                    :key="event.id" 
                    class="event"
                    @click="$emit('event', event)"
                >
                    {{ event.name }} - <span :class="getPriorityClass(event.priority)">{{ capitalize(event.priority) }}</span>
                </li>
            </ul>
        </section>
        <section class="user-display" @click="navigateToUser">
            <Icon class="user-icon" icon="solar:user-line-duotone" />
            <h2 class="username">Profile</h2>
        </section>
    </aside>
    
</template>
  
<script>
import { Icon } from '@iconify/vue';
import {getTime} from '../helpers/Time.js'
import { useAuthStore } from '../../../store/UserStore';
import SearchModal from '../components/SearchModal.vue';


export default {
    components: { Icon,SearchModal },
    emits: [
        'event',
         'update',
        'toggle-menu'
    ], 
    data(){
        return {
            authStore:useAuthStore()
        }
    },
    props: {
        isMenuRetracted: Boolean,
        showSearchModal: Boolean,
        events: {
            type:Object,
            required:true
        },
        highPriorityEvents: {
            type: Object,
            required: true
        },
        editedEvent: {
            type: Object,
            required: true
        }
    },
    methods: {
        toggleMenu() {
            this.$emit('toggle-menu');
        },
        capitalize(priority) {
            return priority.charAt(0).toUpperCase() + priority.slice(1);
        },
        navigateToUser() {
            this.$router.push('/user');
        },
        async createEvent() {
            const newEvent = {
                name: "Title",
                description: "Here goes your description",
                start_date: getTime(),
                end_date:null,
                priority: "high", 
                user_id: this.authStore.store.user.id
            };
            const postRequest = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${this.authStore.store.token}`
                
                },
                body: JSON.stringify(newEvent)
            };
            await fetch(`${import.meta.env.VITE_DATABASE_URL}/events`, postRequest)
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
            this.$emit('update', newEvent);
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
    }
};
</script>
  
<style scoped >
.lateral-menu {
    display: flex;
    position: relative;
    flex-direction: column;
    justify-content: start;
    align-items: center;
    background-color: var(--vt-c-black-contrast);
    color: var(--vt-c-black);
    width: 25%;
    height: 100vh;
    transition: transform 0.5s ease-in;

    &.retracted {
        width: 20%;
        height: 100%;
        transform: translateX(-100%);
    }

    & .menu-title {
        font-size: 1.6rem;
        margin: .5rem;
    }

    & .hidden-menu-arrow {
        position: absolute;
        color: var(--vt-c-black-contrast);
        vertical-align: middle;
        font-size: 2rem;
        top: 1rem;
        right: -2rem;
        transition: opacity 0.5s ease-in-out;
        opacity: 1;
    }

    & .hidden-arrow {
        transition: opacity 0.5s ease-in-out;
        opacity: 0;
    }


    & .menu-arrow {
        display: inline-block;
        font-size: 2rem;
        transform: rotate(180deg);
        vertical-align: middle;
        margin-left: auto;

    }

    & .search-button {
        border: none;
        background-color: var(--vt-c-black-contrast);
        color: yellow;
        transition: background-color 0.8s, color 0.8s;
        width: 100%;

        & .search-button-text {
            color: var(--vt-c-black);
            font-size: 1.2rem;
            padding: 0.3rem;
            border-radius: 5px;
            margin-top: 1rem;
            transition: color 0.8s;

            &:hover {
                color: var(--vt-c-black-contrast);
            }

            & .search-icon {
                display: inline-block;
                font-size: 1.5rem;
                vertical-align: middle;

            }

        }

        & .search-button-input {
            padding: 0.3rem;
            font-size: 1.2rem;
            border-radius: 5px;
            border: none;
            margin-top: 1rem;
        }

    }

    & .search-button:hover {
        background-color: var(--vt-c-black);
        color: var(--vt-c-black-contrast);
        cursor: pointer;
    }

    & .create-event-button {
        border: none;
        background-color: var(--vt-c-black-contrast);
        
        color: var(--vt-c-black);
        transition: background-color 0.8s, color 0.8s;
        width: 100%;

        & .create-event-text {
            color: var(--vt-c-black);
            font-size: 1.2rem;
            padding: 0.3rem;
            border-radius: 5px;
            margin-top: 1rem;

            &:hover {
                color: var(--vt-c-black-contrast);
            }


            & .create-icon {
                display: inline-block;
                font-size: 1.5rem;
                vertical-align: middle;
            }

        }
    }

    & .create-event-button:hover {
        background-color: var(--vt-c-black);
        color: var(--vt-c-black-contrast);
        cursor: pointer;
    }

    & .prioritary-events,
    .events {
        width: 100%;

        &:hover .prioritary-list,
        &:hover .events-list {
            opacity: 1;
            max-height: 30vh;
        }

        & h2 {
            font-size: 1.6rem;
            padding-left: 1rem;
            vertical-align: middle;

            &:hover .down-arrow {
                transform: rotate(360deg);
            }
        }

        & .prioritary-list,
        .events-list {
            opacity: 0;
            max-height: 0;
            overflow: hidden;
            width: 100%;
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            list-style: none;
            transition: all 1s ease;
            overflow-y: auto;

            & .prioritary-event,
            .event {
                font-size: 1.2rem;
                padding: 1rem 1rem 1rem 2rem;
                width: 100%;
                background-color: var(--vt-c-black-contrast);
                transition: background-color 0.8s, color 0.8s;
                box-sizing: border-box;
            }

            & .prioritary-event:hover,
            .event:hover {
                background-color: var(--vt-c-black);
                color: var(--vt-c-black-contrast);
                cursor: pointer;
            }
        }
    }

    & .user-display {
        align-items: center;
        text-align: justify;
        justify-self: flex-end;
        margin-top: auto;

        & .username {
            font-size: 1.6rem;
            display: inline-block;
            text-align: left;

            & .route {
                display: inline-block;
                color: var(--vt-c-black);
                vertical-align: middle;
            }

            & .route:hover {
                color: var(--vt-c-black-contrast);
            }

        }

        & .user-icon {
            display: inline-block;
            font-size: 2rem;
            vertical-align: middle;
            text-align: right;
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



.down-arrow {
    display: inline-block;
    vertical-align: middle;
    transform: rotate(270deg);
    transition: transform 0.8s ease;
}
.user-display{
    cursor: pointer;
    border-radius: 1rem;
    transition: background-color 0.6s, color 0.6s;
    &:hover{
        background-color: var(--vt-c-black-soft);
        color: var(--vt-c-black-contrast);
    }
}

@media (max-width: 1440px) {
    .lateral-menu {
        width: 30%;
        height: 100vh;
        top: 0;
        left: 0;
        transition: transform 0.5s ease-in;

        &.retracted {
            width: 20%;
            height: 100%;
            transform: translateX(-100%);
        }
    }
    
}

@media (max-width: 1024px) {
    .lateral-menu {
        width: 35%;
        height: auto;
        top: 0;
        left: 0;
        transition: transform 0.5s ease-in;

        &.retracted {
            width: 20%;
            height: 100%;
            transform: translateX(-100%);
        }
    }
    
}

@media (max-width: 768px) {
    .lateral-menu {
        width: 100vw;
        height: 100vh;
        top: 0;
        left: 0;
        transition: transform 0.5s ease-in;

        &.retracted {
            width: 10%;
            height: 100%;
            transform: translateX(-100%);
        }
    }
}
</style>