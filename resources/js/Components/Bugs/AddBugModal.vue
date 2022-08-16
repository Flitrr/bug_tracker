<template>
    <Modal @close-modal="closeModal" :open="modalStore.showAddBugToColumn">
        <div class="h-full flex items-center">
            <form @submit.prevent="submit" class="mx-auto rounded-sm flex flex-col items-center gap-3">
                <div>
                    <label for="user" class="block font-bold text-xl">Title: </label>
                    <input id="user" v-model="form.user" type="text" class="rounded-sm" />
                    <Label for="body" class="block font-bold text-xl">Description: </Label>
                    <Input id="body" name="body" v-model="form.body" class="rounded-sm"/>
                </div>
                <PrimaryButton>Add Bug</PrimaryButton>
            </form>
        </div>
    </Modal>
</template>

<script setup>
import PrimaryButton from '@/Components/PrimaryButton'
import Modal from "@/Components/Modal";
import {useForm} from "@inertiajs/inertia-vue3";
import {usePage} from "@inertiajs/inertia-vue3";
import Label from "@/Components/Label";
import Input from "@/Components/Input";
import {useModalStore} from "@/Stores/modalStore";
const modalStore = useModalStore();
const page = usePage();
const props = defineProps(['column']);
const emit = defineEmits(['refreshed']);
const form = useForm({user: null, column_id: props.column.id, body: null});
function closeModal() {
    modalStore.showAddBugToColumn = ! modalStore.showAddBugToColumn;
}
async function submit() {
    closeModal()
    try {
        const response = await window.axios.post(`/columns/${form.column_id}/bugs`, {user: form.user, column_id: form.column_id, body: form.body})
        emit('refreshed');
    } catch (e) {
        console.error(e);
    }
}
</script>

<style scoped>

</style>
