<template>
    <Head title="Bug"/>
    <Authenticated>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                View Bug
            </h2>
        </template>
        <div class="h-96 flex items-stretch justify-center">
            <h3 class="text-center">{{$page.props.bug.name}}</h3>
            <p>{{$page.props.bug.description}}</p>
            <div class="flex items-center justify-around">
                <EditButton class="block" :href="`/bugs/${$page.props.bug.id}/edit`">Edit</EditButton>
                <DeleteButton class="block" @click="() => $inertia.delete(`/bugs/${$page.props.bug.id}`)">Delete</DeleteButton>
            </div>
        </div>
    </Authenticated>
</template>

<script setup>
import {Head} from "@inertiajs/inertia-vue3";
import Authenticated from "@/Layouts/Authenticated";
import EditButton from "@/Components/EditButton";
import DeleteButton from "@/Components/DeleteButton";
</script>

<style scoped>

</style>
