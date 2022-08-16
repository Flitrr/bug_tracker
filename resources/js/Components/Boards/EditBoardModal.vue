<template>
    <Modal id="edit-board">
        <div class="h-full flex items-center">
            <form @submit.prevent="submit" class="mx-auto rounded-sm flex flex-col items-center gap-3">
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
import PrimaryButton from '@/Components/PrimaryButton'
import Modal from "@/Components/Modal";
import {useForm} from "@inertiajs/inertia-vue3";
import {defineProps} from "vue";
const props = defineProps(['board'])
const form = useForm({
    user: props.board.name,
})
async function submit() {
    try {
        await axios.put(`/boards/${props.board.id}`, {user: form.user});
    } catch (e) {
        console.error(e);
    }
}
</script>

<style scoped>

</style>
