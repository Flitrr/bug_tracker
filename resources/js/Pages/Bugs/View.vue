<template>
    <Head title="Bug"/>
    <Authenticated>
        <EditBugOnBoard @close-modal="resetState" v-if="state.board" :column="state.column" :board="state.board" @refreshed="refresh" :bug="$page.props.bug" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                View Bug
            </h2>
        </template>
        <div v-if="$page.props.canGoBack">
            <a href="#" @click="back">Go Back</a>
        </div>
        <div class="h-96 flex items-stretch justify-center">
            <h3 class="text-center">{{ $page.props.bug.name }}</h3>
            <p>{{ $page.props.bug.description }}</p>
            <div>
                <!--                <h4 class="text-center">Boards</h4>-->
                <!--                <ul v-if="boardStore.boards">-->
                <!--                    <li class="list-none" v-for="board in boardStore.boards">-->
                <!--                        <h5>{{ board.name }}</h5>-->
                <!--                            <form @submit.prevent="() => submit(board)">-->
                <!--                                <select v-model="columnForm.column">-->
                <!--                                    <option v-for="column in board.columns" :value="column.id" :key="column.id">{{ column.name }}</option>-->
                <!--                                </select>-->
                <!--                                <PrimaryButton>Submit</PrimaryButton>-->
                <!--                            </form>-->
                <!--                    </li>-->
                <!--                </ul>-->
            </div>
            <div class="flex items-center justify-around">
                <EditButton class="block" :href="`/bugs/${$page.props.bug.id}/edit`">Edit</EditButton>
                <DeleteButton class="block" @click="() => $inertia.delete(`/bugs/${$page.props.bug.id}`)">Delete
                </DeleteButton>
            </div>
        </div>
        <div class="mt-8">
            <h4 class="text-center">Boards</h4>
            <ul v-if="$page.props.boards.length > 0" class="w-9/12 mx-auto mt-8">
                <li @mousedown="() => mouseEnter(board)" @mouseup="() => openModal(board)" class="list-none cursor-pointer font-bold text-xl text-blue-600 mt-6 pt-6 border-t border-solid border-gray-600 last:border-b last:border-solid last:border-gray-600 last:pb-6"
                    v-for="(board, index) in $page.props.boards" :key="index">{{ board.name }} -- PRESENT: <span class="text-red-500 " :class="defaultColumn(board) ? 'text-green-500' : ''">{{ defaultColumn(board) ? 'true' : 'false' }}</span>
                </li>
            </ul>
        </div>
        <h3 class="text-3xl text-center">Comments:</h3>
        <div class="w-6/12 mx-auto bg-white rounded-sm text-gray-900">
            <ul v-if="$page.props.bug.comments">
                <li class="list-none mt-4 text-lg" v-for="comment in $page.props.bug.comments">
                    <p>{{ comment.body }}</p>
                </li>
                <form
                    @submit.prevent="() => commentForm.post(`/bugs/${$page.props.bug.id}/comments`, {preserveState: false})"
                    class="flex">
                    <PrimaryButton>Add Comment</PrimaryButton>
                    <Input class="w-full inline-block" v-model.lazy.trim="commentForm.body"/>
                </form>
            </ul>
        </div>
    </Authenticated>
</template>

<script setup>
import {Head, useForm, Link} from "@inertiajs/inertia-vue3";
import Authenticated from "@/Layouts/Authenticated";
import EditButton from "@/Components/EditButton";
import DeleteButton from "@/Components/DeleteButton";
import PrimaryButton from "@/Components/PrimaryButton";
import Input from "@/Components/Input";
import {usePage} from "@inertiajs/inertia-vue3";
import {computed, nextTick, onBeforeMount, onMounted, onUnmounted, reactive, watchEffect} from "vue";
import EditBugOnBoard from "@/Components/Boards/EditBugOnBoard";
import {Inertia} from "@inertiajs/inertia";
import {useModalStore} from "@/Stores/modalStore";

const modalStore = useModalStore();
const page = usePage();
const state = reactive({selection: null, board: null, column: null})
// watchEffect(() => {
//     const boards = [];
//     const bug = page.props.value.bug;
//     for (const column of bug.columns) {
//         if (!boards.includes(column.board)) {
//             boards.push(column.board);
//         }
//     }
//     state.boards = boards;
// })

const alreadyThere = computed((board) => {
    return onBoard(board);
})

function back() {
    window.history.back();
}

const commentForm = useForm({body: null})
const columnForm = useForm({column: page.props.value.bug.columns.map(col => col.id).includes()})

async function submit(board) {
    if (page.props.value.bug.columns.map(col => col.id).includes(columnForm.column)) {
        return;
    }
    const columns = board.columns;
    const columnInQuestion = columns.filter(col => col.bugs.map(bug => bug.id).includes(page.props.value.bug.id))[0];
    try {
        const response1 = await axios.post(`/columns/${columnForm.column}/bugs/${page.props.value.bug.id}`);
        const response2 = await axios.delete(`/columns/${columnInQuestion.id}/bugs/${page.props.value.bug.id}`);
    } catch (e) {
        console.error(e);
    }
}

function onBoard(boardId) {
    const columns = boardId?.columns;
    for (const column of columns) {
        const bugs = column?.bugs
        const identifiedBug = bugs?.filter(bug => bug?.id === page.props.value?.bug?.id);
        if (identifiedBug?.length > 0) {
            return true;
        }
    }
    return false;
}

async function refresh() {
    await resetState()
    Inertia.visit(`/bugs/${page.props.value.bug.id}`, {only: ['bug', 'boards'], preserveScroll: true, method: 'get'});
}

function openModal(board) {
    modalStore.editBugOnBoard = ! modalStore.editBugOnBoard;
}

async function resetState() {
    state.board = null;
    state.column = null
    await nextTick();
}
function mouseEnter(board) {
    state.board = board;
    state.column = defaultColumn(board);
}
function defaultColumn(board) {
    return board.columns?.filter(col => col.bugs.map(b => b.id).includes(page.props.value.bug.id))[0];
}
const computedColumn = (board) => {
    return board.columns?.filter(col => col.bugs.map(b => b.id).includes(page.props.value.bug.id))[0];
}
</script>

<style scoped>

</style>
