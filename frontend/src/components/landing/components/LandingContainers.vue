<template lang="">
    <section class="containers">
        <section class="top-container">
            <section class="top-container-content">
                <h2 class="top-header">Optimize your time management </h2>
                <p class="top-description">
                    Simplify your day and sync your events with the apps you use most—all from one place.
                    Discover how TimeSync can enhance your productivity and make your workflow more efficient.
                </p>
            </section>
            <section class="top-container-image">
                <img class="top-image" src="https://dummyimage.com/361x284/000000/fff" alt="landing-image">   
            </section>
        </section>

        <section class="bottom-container">
            <section class="bottom-container-image">
                <img class="bottom-image" src="https://dummyimage.com/361x284/000000/fff" alt="landing-image">   
            </section>
            <section class="bottom-container-content">
                <h2 class="bottom-header">Customize your events on the go!</h2>
                <p class="bottom-description">
                    Customize your working style with TimeSync. 
                    TimeSync offers you the flexibility to manage your events the way you prefer.
                </p>
            </section>
            
        </section>
    </section>
</template>
<script>
export default {
    
}
</script>
<style scoped>

.containers{
    display: flex;
    flex-direction: column; 
    justify-content: center;
    align-items: center;
}
    .top-container{
        display:grid;
        grid-template-columns: 1fr 1fr;
        margin: 2rem;
        width: 80vw;
        height: 50vh;
        background-color: var(--vt-c-black-soft);
        border-radius: 1.3vw;
        justify-items: end;
        align-items: center;
    }

    .top-container-content{
        padding: 24px;
        
    }
    .top-header{
        font-size: 2.2vw;
        margin-top: 1vh;
        margin-bottom: 1vh;
        margin-left: 2vw;
        font-weight: bolder;
    }
    .top-description{
        font-size: 1.6vw;
        margin-left: 2vw;
    }
    .top-container-image{
        background-color: var(--vt-c-black-mute);
        border-radius:  11vw 1.3vw 1.3vw 11vw ;
        width: 100%;
        height: 100%;
    }

    .top-image {
        border-radius: 12px;
        position: relative;
        top: 10.2%;
        left: 25%;
        height: 40vh;
    }

    .bottom-container{
        display:grid;
        grid-template-columns: 1fr 1fr;
        
        margin: 2rem;
        width: 80vw;
        height: 50vh;
        background-color: var(--vt-c-black-mute);
        border-radius: 24px;
        justify-items: end;
        align-items: center;
    }

    .bottom-container-content{
        padding: 24px;
        
    }
    .bottom-header{
        font-size: 2vw;
        margin-top: 1vh;
        margin-bottom: 1vh;
        
        margin-left: 2vw;
        font-weight: bold;
        color: var(--vt-c-black);
    }
    .bottom-description{
        font-size: 1.5vw;
        margin-left: 2vw;
        color: var(--vt-c-black);
    }
    .bottom-container-image{
        background-color: var(--vt-c-black-soft);
        border-radius: 1.3vw 11vw 11vw 1.3vw ;
        width: 100%;
        height: 100%;
    }

    .bottom-image {
        border-radius: 12px;
        position: relative;
        height: 40vh;
        top: 10.2%;
        left: 10%;
    }
    @media (max-width: 1440px) {
        .top-container, .bottom-container {
            margin: 10px;
            width: 95vw;
        }
    }
    @media (max-width: 1024px) {
        .top-container {
            grid-template-columns: 1fr;
            border-radius: 0rem 5rem 5rem  0rem;
            margin-left:0;
            margin-bottom: 5rem;
            justify-content: right;
            height: auto;
            position: relative;
            left: -10rem;
        }

        .top-container-image {
            position: absolute;
            top: 100%;
            right: -20vw;
            width: 85vw;
            margin-top: 3rem;
            display: block;

            & .top-image {
                height: auto;
                top: 6.25%;
                left: 10%;
            }
        }

        .top-container-content{
           position: relative;
           width: 80vw;
            height: 40vh;
        }

        .top-image, .bottom-image {
            height: 35vh;
            margin: 0 auto;
        }

        .top-header, .bottom-header {
            font-size: 4vw;
        }

        .top-description, .bottom-description {
            font-size: 3vw;
        }

        .bottom-container{
            grid-template-columns: 1fr;
            border-radius: 5rem 0rem 0rem  5rem;
            margin-left:0;
            margin-bottom: 5rem;
            width: 105vw;
            justify-content: right;
            height: auto;
            position: relative;
            top:21rem;
            right: -10rem;
        }
        .bottom-container-content{
            position: relative;
            height: 40vh;
            width: 50vw;
            right: 20rem;

            & .bottom-header {
                font-size: 3.5vw;
            }
            & .bottom-description {
                font-size: 2.5vw;
            }
        }
        .bottom-container-image{
            position: absolute;
            top: 100%;
            right: 50%;
            width:80vw;
            margin-top: 3rem;
           
            display: block;

            & .bottom-image {
                height: auto;
                top: 6.25%;
                left: 40.5%;
            }
        }
    }

    /* For mobile phones */
    @media (max-width: 480px) {
        .top-container, .bottom-container {
            margin: 10px;
            width: 90vw;
        }

        .top-header, .bottom-header {
            font-size: 5vw;
        }

        .top-description, .bottom-description {
            font-size: 4vw;
        }
    }

</style>