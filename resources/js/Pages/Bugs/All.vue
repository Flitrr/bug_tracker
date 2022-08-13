<template>
    <Head title="Bugs" />
    <Authenticated>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Bugs
            </h2>
        </template>
        <div class="h-48 flex items-center justify-center">
            <PrimaryButton @click="$inertia.get(route('bugs.create'))" class="block">Create Bug</PrimaryButton>
        </div>
        <div class="w-10/12 mx-auto h-96 overflow-y-scroll">
            <ul v-if="$page.props.bugs.length > 0" class="list-none">
                <li v-for="bug in $page.props.bugs" class="flex">
                    <Link :href="`/bugs/${bug.id}`"><h3>{{bug.name}}</h3></Link>
                    <div class="w-48 ml-auto flex items-center justify-around">
                        <EditButton :href="`/bugs/${bug.id}/edit`" class="block">Edit</EditButton>
                        <DeleteButton @click="() => $inertia.delete(`/bugs/${$page.props.bug.id}`)" class="block">Delete</DeleteButton>
                    </div>
                </li>
            </ul>
        </div>
    </Authenticated>
</template>

<script setup>

import Authenticated from "@/Layouts/Authenticated";
import {Head, Link, usePage} from "@inertiajs/inertia-vue3";
import EditButton from "@/Components/EditButton";
import DeleteButton from "@/Components/DeleteButton";
import PrimaryButton from "@/Components/PrimaryButton";
const page = usePage();

console.log(page.props.value)
</script>

<style scoped>

</style>
