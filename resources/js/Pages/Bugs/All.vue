<template>
    <Head title="Bugs"/>
    <Authenticated>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Bugs
            </h2>
        </template>
        <div class="h-48 flex items-center justify-center">
            <PrimaryButton
                @click="$page.props.column_id ? $inertia.get(route('columns.bugs.create', $page.props.column_id)) : $inertia.get(route('bugs.create'))"
                class="block">Create Bug
            </PrimaryButton>
        </div>
        <div class="w-10/12 mx-auto h-96 overflow-y-scroll">
            <List :bugs="$page.props.bugs"/>
        </div>
    </Authenticated>
</template>

<script setup>

import Authenticated from "@/Layouts/Authenticated";
import {Head, Link, usePage} from "@inertiajs/inertia-vue3";
import EditButton from "@/Components/EditButton";
import DeleteButton from "@/Components/DeleteButton";
import PrimaryButton from "@/Components/PrimaryButton";
import List from "@/Components/Bugs/List";

const page = usePage();

console.log(page.props.value)
</script>

<style scoped>

</style>
