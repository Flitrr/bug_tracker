<template>
    <Modal id="create-board">
        <div class="h-full flex items-center">
            <form @submit.prevent="form.post('/boards')" class="mx-auto rounded-sm flex flex-col items-center gap-3">
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
import Modal from "@/Components/Modal";
import {useForm} from "@inertiajs/inertia-vue3";
import PrimaryButton from "@/Components/PrimaryButton";
const form = useForm({
    name: null,
})
</script>

<style scoped>

</style>
