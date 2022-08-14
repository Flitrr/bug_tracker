<template>
    <Modal id="edit-board">
        <div class="h-full flex items-center">
            <form @submit.prevent="() => form.post('/boards')" class="mx-auto rounded-sm flex flex-col items-center gap-3">
                <div>
                    <label for="name" class="block font-bold text-xl">Title: </label>
                    <input id="name" v-model="form.name" type="text" class="rounded-sm" />
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
    name: props.board.name,
})
</script>

<style scoped>

</style>
