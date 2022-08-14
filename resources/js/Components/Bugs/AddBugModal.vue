<template>
    <Modal @close-modal="closeModal" :open="modalStore.showAddBugToColumn">
        <div class="h-full flex items-center">
            <form @submit.prevent="() => form.post(`/columns/${props.column.id}/bugs`, {preserveState: true})" class="mx-auto rounded-sm flex flex-col items-center gap-3">
                <div>
                    <label for="user" class="block font-bold text-xl">Title: </label>
                    <input id="user" v-model="form.user" type="text" class="rounded-sm" />
                    <Label for="body" class="block font-bold text-xl">Description: </Label>
                    <Input id="body" name="body" v-model="form.body" class="rounded-sm"/>
                </div>
                <PrimaryButton @click="closeModal">Add Bug</PrimaryButton>
            </form>
        </div>
    </Modal>
</template>

<script setup>
import PrimaryButton from '@/Components/PrimaryButton'
import Modal from "@/Components/Modal";
import {useForm} from "@inertiajs/inertia-vue3";
import {useApiStore} from "@/Stores/apiStore";
import Label from "@/Components/Label";
import Input from "@/Components/Input";
import {useModalStore} from "@/Stores/modalStore";
const modalStore = useModalStore();
const user = useApiStore();
const form = useForm({user: user.id, column_id: props.column, body: null});
const props = defineProps(['column']);
function closeModal() {
    modalStore.showAddBugToColumn = ! modalStore.showAddBugToColumn;
}
</script>

<style scoped>

</style>
