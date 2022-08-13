<template>
    <Head title="Boards" />
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Boards
            </h2>
        </template>
        <BoardMenu v-if="$page.props.boards.length > 0" :boards="$page.props.boards" />
        <div class="text-center h-20" v-else>
            <h2 class="my-auto">No boards, <Link :href="route('boards.create')" class="font-bold text-blue-500 underline hover:text-blue-300 active:text-blue-300">create</Link> one now</h2>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import {Head} from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BoardMenu from "@/Components/Boards/BoardMenu";
import {Link} from "@inertiajs/inertia-vue3";
</script>

<style scoped>

</style>
