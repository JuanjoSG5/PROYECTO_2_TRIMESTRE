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
                <button> It works</button>
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
        showSearchModal: {
            type: Boolean,
            required: true
        }
    },
    methods: {
        handleSearchInput(){
            console.log('searching for', this.search);
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
        border-radius: 1rem;
        box-shadow: 0px 10px 5px 2 px rgba(0, 0, 0, 0.1);
    }
</style>