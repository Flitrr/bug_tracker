<template>
    <ul v-if="bugs.length > 0" class="list-none">
        <li v-for="(bug, index) in bugs" class="flex">
            <Link v-if="!$page.props.column_id" :href="`/bugs/${bug.id}`">{{calculated[index]}}</Link>
            <a v-else @click="() => back(bug.id)">{{calculated[index]}}</a>
            <div class="w-48 ml-auto flex items-center justify-around">
                <EditButton :href="`/bugs/${bug.id}/edit`" class="block">Edit</EditButton>
                <DeleteButton @click="() => $inertia.delete(`/bugs/${bug.id}`)" class="block">Delete</DeleteButton>
            </div>
        </li>
    </ul>
</template>

<script setup>
import EditButton from '@/Components/EditButton';
import DeleteButton from '@/Components/DeleteButton';
import {computed} from "vue";
import {Link, usePage} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps(['bugs']);
const calculated = computed(() => {
    return props.bugs.map(bug => bug.name);
})
function back(id) {
    Inertia.post(`/columns/${usePage().props.value.column_id}/bugs/${id}`)
}
</script>

<style scoped>

</style>
