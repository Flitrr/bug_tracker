<template>
    <Head title="Column"/>
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Column
            </h2>
        </template>
        <div class="h-96">
            <div class="w-6/12 mx-auto flex flex-col gap-1">
                <PrimaryButton @click="$inertia.get(`/boards/${$page.props.column.board_id}`)" class="block">Back to Board</PrimaryButton>
                <h2 class="text-center">{{$page.props.column.name}}</h2>
<!--                other content here -->
                <div class="flex items-center justify-around">
                    <EditButton :href="`/columns/${$page.props.column.id}/edit`" class="block">Edit</EditButton>
                    <DeleteButton @click="() => $inertia.delete(`/columns/${$page.props.column.id}`)" class="block">Delete</DeleteButton>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated';
import {Head} from "@inertiajs/inertia-vue3";
import EditButton from "@/Components/EditButton";
import DeleteButton from "@/Components/DeleteButton";
import PrimaryButton from "@/Components/PrimaryButton";
function destroy(id) {

}
</script>

<style scoped>

</style>
