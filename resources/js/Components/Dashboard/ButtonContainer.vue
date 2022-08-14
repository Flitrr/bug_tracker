<template>
    <div v-if="props.boards" class="border-2 rounded-sm p-12 flex items-center justify-center">
        <PrimaryButton @click="openNewBoardModal">Create New Board</PrimaryButton>
    </div>
    <div v-else class="border-2 rounded-sm p-12 flex items-center justify-center mx-auto min-h-full my-auto">
        <PrimaryButton @click="openNewBoardModal">Create New Board</PrimaryButton>
    </div>
</template>

<script setup>
import PrimaryButton from "@/Components/PrimaryButton";
import {useModalStore} from "@/Stores/modalStore";
const props = defineProps(['boards']);
const modalStore = useModalStore();
function openNewBoardModal() {
    modalStore.createBoardModal = !modalStore.createBoardModal;
}
</script>

<style scoped>

</style>
