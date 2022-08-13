<template>
    <Modal>
        <div class="h-full">
            <form @submit.prevent="submit" class="mx-auto rounded-sm flex flex-col items-center gap-3">
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
import {reactive, ref} from "vue";
import {Inertia} from "@inertiajs/inertia";
const props = defineProps(['board']);
const form = useForm({
    name: null,
    board_id: props.board
})
function submit() {
    form.post(window.location.href + '/columns', {preserveState: false});
}
</script>

<style scoped>

</style>
