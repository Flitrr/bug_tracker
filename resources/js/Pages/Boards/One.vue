<template>
    <Head title="Board"/>
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Board
            </h2>
        </template>
        <NewColumnModal :board="$page.props.board.id" id="column-modal"/>
        <div>
            <div>
                <h2 class="text-center">{{ $page.props.board.name }}</h2>
            </div>
            <div class="min-h-96 text-center flex overflow-x-auto">
                <div class="flex-shrink-0 w-4/12 self-stretch relative" v-for="column in $page.props.board.columns">
                    <h2 class="text-xl font-bold mb-2">{{ column.name }}<Gear :href="`/columns/${column.id}`" width="w-6" class="w-6 cursor-pointer block absolute -top-20 right-0"/></h2>
                    <div class="w-full h-full rounded-sm bg-white overflow-y-scroll">
                    </div>
                </div>
                <span @click="openModal" class="my-auto cursor-pointer">
                <span class="block text-6xl">+</span><span class="block text-4xl">Add Column</span>
                </span>
            </div>
            <div class="flex items-center justify-center gap-5">
                <EditButton :href="`/boards/${$page.props.board.id}/edit`" class="block">Edit</EditButton>
                <DeleteButton @click="() => destroy($page.props.board.id)" class="block">Delete</DeleteButton>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import {Head} from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import EditButton from "@/Components/EditButton";
import DeleteButton from "@/Components/DeleteButton";
import {Inertia} from "@inertiajs/inertia";
import {computed, ref} from "vue";
import NewColumnModal from "@/Components/Boards/NewColumnModal";
import Gear from "@/Components/Icons/Gear";

const modal = ref(null);

function destroy(id) {
    Inertia.delete(`/boards/${id}`);
}

function openModal() {
    document.getElementById('column-modal').dispatchEvent(new Event('open-modal'));
}

const log = computed(() => console);
</script>

<style scoped>
.min-h-96 {
    min-height: 60vh;
}
</style>
