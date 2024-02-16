<template>
    <aside :class="{ 'lateral-menu': true, 'retracted': isMenuRetracted }">
        <h2 class="menu-title" @click="toggleMenu">
            Events of username
            <Icon class="menu-arrow" icon="solar:double-alt-arrow-right-line-duotone" />
            <span>
                <Icon :class="[isMenuRetracted ? 'hidden-menu-arrow' : 'hidden-arrow']"
                    icon="solar:double-alt-arrow-right-line-duotone" />
            </span>
        </h2>
        <button class="search-button">
            <p class="search-button-text">
                <Icon class="search-icon" icon="ph:magnifying-glass-bold" />
                Search for your events
            </p>
        </button>
        <button class="create-event-button" @click="createEvent">
            <p class="create-event-text">
                <Icon class="create-icon" icon="iconamoon:sign-plus-circle-bold" />
                Create a new event
            </p>
        </button>
        <section class="prioritary-events">
            <h2>
                <Icon class="down-arrow" icon="lets-icons:arrow-drop-down-big" /> Prioritary
            </h2>
            <ul class="prioritary-list">
                <li class="prioritary-event">Example Prioritary event</li>
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
                >
                    {{ event.name }}
                </li>
            </ul>
        </section>
        <section class="user-display">
            <Icon class="user-icon" icon="solar:user-line-duotone" />
            <h2 class="username"> <router-link class="route" to="/user">Username</router-link></h2>
        </section>
    </aside>
</template>
  
<script>
import { Icon } from '@iconify/vue';

export default {
    components: { Icon },
    props: {
        isMenuRetracted: Boolean,
        events: {
            type:Object,
            required:true
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
        async createEvent() {
            console.log(JSON.stringify(this.editedEvent));
            const postRequest = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(this.editedEvent)
            };
            console.log('Sending post request:', postRequest);
            await fetch('http://localhost:9000/api/v1/events', postRequest)
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        },

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
    width: 100%;
    height: 100%;
    transition: transform 0.5s ease-in;

    &.retracted {
        width: 30%;
        height: 100%;
        transform: translateX(-100%);
    }

    & .menu-title {
        font-size: 1.6rem;
        margin: .5rem;
    }

    & .hidden-menu-arrow {
        position: absolute;
        color: white;
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
        transition: background-color 0.8s, color 0.8s;
        width: 100%;

        & .search-button-text {
            font-size: 1.2rem;
            padding: 0.3rem;
            border-radius: 5px;
            margin-top: 1rem;

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
        background-color: rgba(39, 55, 77, 0.886);
        color: rgba(221, 230, 237, 0.813);
        cursor: pointer;
    }

    & .create-event-button {
        border: none;
        background-color: var(--vt-c-black-contrast);
        transition: background-color 0.8s, color 0.8s;
        width: 100%;

        & .create-event-text {
            font-size: 1.2rem;
            padding: 0.3rem;
            border-radius: 5px;
            margin-top: 1rem;

            & .create-icon {
                display: inline-block;
                font-size: 1.5rem;
                vertical-align: middle;
            }

        }
    }

    & .create-event-button:hover {
        background-color: rgba(39, 55, 77, 0.886);
        color: rgba(221, 230, 237, 0.813);
        cursor: pointer;
    }

    & .prioritary-events,
    .events {
        width: 100%;

        &:hover .prioritary-list,
        &:hover .events-list {
            opacity: 1;
            max-height: 20vh;
        }

        & h2 {
            font-size: 1.6rem;
            padding-left: 1rem;
            vertical-align: middle;

            &:hover .down-arrow {
                transform: rotate(360deg);
                /* Adjust the degree as needed */
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
                background-color: rgba(39, 55, 77, 0.886);
                color: rgba(221, 230, 237, 0.813);
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
                color: var(--vt-c-black);
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




.down-arrow {
    display: inline-block;
    vertical-align: middle;
    transform: rotate(270deg);
    transition: transform 0.8s ease;
}</style>