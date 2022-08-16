<template>
    <Modal @close-modal="closeModal" :open="modalStore.editBugOnBoard">
        <div class="h-full">
            <form v-if="state.board ?? boardStore.board" @submit.prevent="submit" class="mx-auto rounded-sm flex flex-col items-center gap-3">
                <select v-model="form.column">
                    <option v-for="possibleColumns in state.board?.columns ?? boardStore.board.columns" :value="possibleColumns.id" :key="possibleColumns.id">{{possibleColumns.name}}</option>
                </select>
                <PrimaryButton>Submit</PrimaryButton>
            </form>
        </div>
    </Modal>
</template>

<script setup>
import Modal from "@/Components/Modal";
import {useForm, usePage} from "@inertiajs/inertia-vue3";
import PrimaryButton from "@/Components/PrimaryButton";
import {computed, nextTick, onBeforeMount, onMounted, onUpdated, reactive, ref} from "vue";
import {Inertia} from "@inertiajs/inertia";
import {useModalStore} from "@/Stores/modalStore";
import {useBoardStore} from "@/Stores/boardStore";
const modalStore = useModalStore();
const boardStore = useBoardStore();
const props = defineProps(['bug', 'column', 'board']);
const emit = defineEmits(['refreshed', 'close-modal']);
const page = usePage();
const state = reactive({board: props.board, column: props.bug?.columns?.map(col => col.id)?.filter(id => props.board?.columns?.map(col => col.id)?.includes(id))[0]})
const form = useForm({
    column: state.column ?? props.column?.id,
})

onUpdated(() => {
    console.log(state.column);
})
async function submit() {
    if (state.column === form.column) {
        // handle the column is the same as before
        return;
    }
    try {
        if (state.column ?? props.column?.id) {
            await window.axios.delete(`/columns/${state.column ?? props.column?.id}/bugs/${props.bug?.id}`)
        }
        await window.axios.post(`/columns/${form.column}/bugs/${props.bug?.id}`);
    closeModal();
        emit('refreshed');
    } catch (e) {
        console.error(e);
    }
}
function closeModal() {
    modalStore.editBugOnBoard = ! modalStore.editBugOnBoard;
    emit('close-modal');
}
</script>

<style scoped>

</style>
