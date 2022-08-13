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
const props = defineProps(['boards']);
function openNewBoardModal() {
    const modal = document.getElementById('create-board');
    const event = new Event('open-modal');
    modal.dispatchEvent(event);
}
</script>

<style scoped>

</style>
