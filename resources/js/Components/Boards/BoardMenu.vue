<template>
    <div >
        <ul class="px-12 mt-12">
            <li v-for="(board, index) in boards" :key="index" class="flex mt-8 justify-between items-baseline pb-8 border-b">
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

</style>
