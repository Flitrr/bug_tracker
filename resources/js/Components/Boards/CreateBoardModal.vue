<template>
    <Modal @close-modal="closeModal" :open="modalStore.createBoardModal">
        <div class="h-full flex items-center">
            <form @submit.prevent="() => form.post('/boards')" class="mx-auto rounded-sm flex flex-col items-center gap-3">
                <div>
                    <label for="user" class="block font-bold text-xl">Title: </label>
                    <input id="user" v-model="form.user" type="text" class="rounded-sm" />
                </div>
                <PrimaryButton>Create</PrimaryButton>
            </form>
        </div>
    </Modal>
</template>

<script setup>
import Modal from "@/Components/Modal";
import {useForm} from "@inertiajs/inertia-vue3";
import PrimaryButton from "@/Components/PrimaryButton";
import {useModalStore} from "@/Stores/modalStore";
const modalStore = useModalStore();
const form = useForm({
    user: null,
})
function closeModal() {
    modalStore.createBoardModal = !modalStore.createBoardModal;
}
</script>

<style scoped>

</style>
