<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import ButtonContainer from "@/Components/Dashboard/ButtonContainer";
import CreateBoardModal from "@/Components/Boards/CreateBoardModal";

</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <CreateBoardModal />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <ButtonContainer />
    </BreezeAuthenticatedLayout>
</template>
