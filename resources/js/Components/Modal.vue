<template>
    <div @open-modal="openModal" @click.self="closeModal" ref="modal" v-show="state.open"
         class="fixed z-10 left-0 top-0 w-full h-full overflow-auto bg-black bg-gray-900 bg-opacity-40">
        <div class="bg-gray-100 my-12 mx-auto p-10 border border-solid border-gray-600 w-9/12 relative rounded-sm">
            <span @click="closeModal" class="cursor-pointer absolute top-0 right-2 block text-gray-700 text-3xl font-bold">&times;</span>
            <slot></slot>
        </div>
    </div>
</template>

<script setup>
import {onMounted, reactive, ref, watchEffect} from "vue";

const state = reactive({open: false});
const modal = ref(null);

onMounted(() => {
    modal.value.addEventListener('close-modal', () => {
        closeModal();
    })
})

function openModal() {
    state.open = true;
}

function closeModal() {
    state.open = false;
}
</script>
