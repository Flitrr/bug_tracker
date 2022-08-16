<template>
    <Head title="Board"/>
    <NewColumnModal @refreshed="refresh" :board="boardStore.board.id" id="column-modal"/>
    <AddBugModal @refreshed="refresh" v-if="state.column_data" :column="state.column_data"/>
    <EditBugOnBoard @refreshed="refresh" @close-modal="resetState" v-if="state.selected_column" :bug="state.selected_bug" :column="state.selected_column"/>
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Board
            </h2>
        </template>
        <div>
            <div>
                <h2 class="text-center">{{ boardStore.board.name }}</h2>
            </div>
            <div class="min-h-96 flex overflow-x-auto">
                <div class="flex-shrink-0 self-stretch w-4/12 relative" v-for="column in boardStore.board.columns" :key="column.id">
                    <h2 class="text-xl flex flex-col text-center font-bold mb-2">{{ column.name }}<Gear :href="`/columns/${column.id}`" width="w-6" class="w-6 cursor-pointer block absolute -top-20 right-0"/></h2>
                    <div class="w-full flex-grow h-5/6 rounded-sm bg-white overflow-y-auto pr-2">
                        <ul v-if="column.bugs">
                            <li class="list-none flex justify-between my-8 items-center" v-for="bug in column.bugs" :key="bug.id">
                                <span @mousedown="() => preloadContent(bug, column)" @mouseup="openEditBugModal" class="text-blue-500 font-bold text-xl block cursor-pointer">{{bug.name}}</span><div><span @click="() => $inertia.get(`/bugs/${bug.id}/edit`)" class="ml-12 text-lg text-green-300 font-bold cursor-pointer">Edit</span><span class="ml-12 text-red-600 text-lg font-bold cursor-pointer" @click="() => removeBug(column, bug)">Remove</span></div>
                            </li>
                        </ul>
                        <p v-else>No Bugs</p>
                    </div>
                    <PrimaryButton class="text-center mx-auto block" @click="() => openBugModal(column)">Add a bug</PrimaryButton>
                </div>
                <span @click="openColumnModal" class="my-auto cursor-pointer block">
                <span class="block text-6xl">+</span><span class="block text-4xl">Add Column</span>
                </span>
            </div>
            <div class="flex items-center justify-center gap-5">
                <EditButton :href="`/boards/${boardStore.board.id}/edit`" class="block">Edit</EditButton>
                <DeleteButton ref="deleteButton" @click="() => destroy(boardStore.board.id)" class="block">Delete</DeleteButton>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import {Head, Link, usePage} from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import EditButton from "@/Components/EditButton";
import DeleteButton from "@/Components/DeleteButton";
import {Inertia} from "@inertiajs/inertia";
import {
    computed,
    onBeforeUnmount,
    onBeforeMount,
    reactive,
    ref,
    watchEffect,
    onBeforeUpdate,
    onUpdated,
    onUnmounted, watch, nextTick
} from "vue";
import NewColumnModal from "@/Components/Boards/NewColumnModal";
import Gear from "@/Components/Icons/Gear";
import PrimaryButton from "@/Components/PrimaryButton";
import {useModalStore} from "@/Stores/modalStore";
import AddBugModal from "@/Components/Bugs/AddBugModal";
import {useBoardStore} from "@/Stores/boardStore";
import EditBugOnBoard from "@/Components/Boards/EditBugOnBoard";

const state = reactive({column_data: null, selected_bug:null, selected_column: null})

const deleteButton = ref(null);
const modalStore = useModalStore();
const boardStore = useBoardStore();
const page = usePage();

onBeforeMount(async () => {
    await boardStore.update(page.props.value.board.id);
})

onUnmounted( () => {
    boardStore.board.value = null;
})

function refresh() {
    Inertia.visit(`/boards/${page.props.value.board.id}`, {method: 'get', preserveScroll: true, preserveState: false});
}

function destroy(id) {
    Inertia.delete(`/boards/${id}`);
}

function openBugModal(column) {
    state.column_data = column;
    modalStore.showAddBugToColumn = !modalStore.showAddBugToColumn;
}

function openColumnModal() {
    modalStore.showNewColumnModalBoardsOne = !modalStore.showNewColumnModalBoardsOne;
}

const log = computed(() => console);

function openEditBugModal(bug, column) {

    modalStore.editBugOnBoard = !modalStore.editBugOnBoard;
}
async function resetState() {
    state.selected_bug = null;
    state.selected_column = null;
    state.column_data = null;
    await nextTick()
}
async function preloadContent(bug, column) {
    await resetState();
    state.selected_column = column;
    state.selected_bug = bug;
}
async function removeBug(column, bug) {
    try {
        await window.axios.delete(`/columns/${column.id}/bugs/${bug.id}`);
        refresh();
    } catch (e) {
        console.error(e);
    }
}
</script>

<style scoped>
.min-h-96 {
    min-height: 70vh;
}
</style>
