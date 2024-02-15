<template lang="">
    <section class="main-content">
        <aside class="lateral-menu">
            <h2 class="menu-title">Events of username <Icon class="menu-arrow" icon="solar:double-alt-arrow-right-line-duotone" /></h2>
            <button class="search-button">
                <p class="search-button-text"> 
                    <Icon class="search-icon" icon="ph:magnifying-glass-bold" /> 
                    Search for your events
                </p>
            </button>
            <button class="create-event-button">
                <p class="create-event-text"> 
                    <Icon class="create-icon"  icon="iconamoon:sign-plus-circle-bold" /> 
                    Create a new event
                </p>
            </button>
            <section class="prioritary-events">
                <h2><Icon class="down-arrow" icon="lets-icons:arrow-drop-down-big" /> Prioritary</h2>
                <ul class="prioritary-list">
                    <li class="prioritary-event">Example event</li>
                </ul>
            </section>
        </aside>
        <section class="main-content">

        </section>
    </section>
</template>
<script>
import { Icon } from '@iconify/vue';
export default {
    components: {
        Icon
    }
}
</script>
<style scoped >
.main-content {
    display:grid;
    grid-template-columns: 1fr 3fr;
    align-items: center;
    justify-items: center;
    & .lateral-menu {
        display:flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: var(--vt-c-black-contrast);
        color: var(--vt-c-black);
        width: 100%;
        & .menu-title {
            font-size: 1.6rem;
            margin: 1rem 0;
        }

        & .menu-arrow {
            display: inline-block;
            font-size: 2rem;
            transform: rotate(180deg);
            vertical-align: middle;
        }

        & .search-button{
            border: none;
            background-color: var(--vt-c-black-contrast);
            transition: background-color 0.8s, color 0.8s; 
            width: 100%;

            & .search-button-text{
                font-size: 1.2rem;
                padding: 0.3rem;
                border-radius: 5px;
                margin-top: 1rem;

                & .search-icon{
                    display: inline-block;
                    font-size: 1.5rem;
                    vertical-align: middle;
                    
                }

            }
            & .search-button-input{
                padding: 0.3rem;
                font-size: 1.2rem;
                border-radius: 5px;
                border: none;
                margin-top: 1rem;
            }

        }

        & .search-button:hover{
            background-color: rgba(39, 55, 77, 0.886);
            color: rgba(221, 230, 237, 0.813);
            cursor: pointer;
        }

        & .create-event-button{
            border: none;
            background-color: var(--vt-c-black-contrast);
            transition: background-color 0.8s, color 0.8s; 
            width: 100%;

            & .create-event-text{
                font-size: 1.2rem;
                padding: 0.3rem;
                border-radius: 5px;
                margin-top: 1rem;

                & .create-icon{
                    display: inline-block;
                    font-size: 1.5rem;
                    vertical-align: middle;
                }

            }
        }
        & .create-event-button:hover{
            background-color: rgba(39, 55, 77, 0.886);
            color: rgba(221, 230, 237, 0.813);
            cursor: pointer;
        }
        & .prioritary-events{
            width: 100%;
            &:hover .prioritary-list{
                opacity: 1;
                max-height: 20vh;
            }

            & h2 {
                font-size: 1.6rem;
                padding-left: 1rem;
                vertical-align: middle;

                &:hover .down-arrow {
                    transform: rotate(360deg); /* Adjust the degree as needed */
                }
            }
            & .prioritary-list{
                opacity: 0;
                max-height: 0;
                overflow: hidden;
                width: 100%;
                padding: 0;
                margin: 0;
                box-sizing: border-box;
                list-style: none;
                transition: all 1s ease; 
                & .prioritary-event{
                    font-size: 1.2rem;
                    padding: 1rem 1rem 1rem 2rem;
                    width: 100%;
                    background-color: var(--vt-c-black-contrast);
                    transition: background-color 0.8s, color 0.8s; 
                    box-sizing: border-box;
                }
                & .prioritary-event:hover{
                    background-color: rgba(39, 55, 77, 0.886);
                    color: rgba(221, 230, 237, 0.813);
                    cursor: pointer;
                }
            }
        }
    }
}

/** I want to make the down arrow rotate the  */
.down-arrow{
    display: inline-block;
    vertical-align: middle;
    transform: rotate(270deg);
    transition: transform 0.8s ease;
}


    
</style>