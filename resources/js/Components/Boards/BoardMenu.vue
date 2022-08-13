<template>
    <div class='outter-div flex items-center'>
        <ul class="w-full">
            <li v-for="(board, index) in boards" :key="index" class="flex justify-around ">
                <Link :href="`/boards/${board.id}`">{{board.name}}</Link>
                <div class="flex justify-around items-center w-6/12">
                    <EditButton :href="`/boards/${board.id}/edit`">Edit</EditButton>
                    <DeleteButton @click="() => destroy(board.id)">Delete</DeleteButton>
                </div>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import EditButton from "@/Components/EditButton";
import DeleteButton from "@/Components/DeleteButton";
import {Inertia} from "@inertiajs/inertia";
defineProps(['boards'])
function destroy(id) {
    Inertia.delete(`/boards/${id}`)
}
</script>

<style scoped>
.outter-div {
    min-height: 75vh;
}
</style>
