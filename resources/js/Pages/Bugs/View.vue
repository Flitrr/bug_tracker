<template>
    <Head title="Bug"/>
    <Authenticated>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                View Bug
            </h2>
        </template>
        <div v-if="$page.props.canGoBack">
            <a href="#" @click="back">Go Back</a>
        </div>
        <div class="h-96 flex items-stretch justify-center">
            <h3 class="text-center">{{$page.props.bug.name}}</h3>
            <p>{{$page.props.bug.description}}</p>
            <div class="flex items-center justify-around">
                <EditButton class="block" :href="`/bugs/${$page.props.bug.id}/edit`">Edit</EditButton>
                <DeleteButton class="block" @click="() => $inertia.delete(`/bugs/${$page.props.bug.id}`)">Delete</DeleteButton>
            </div>
        </div>
            <h3 class="text-3xl">Comments:</h3>
        <div class="w-6/12 mx-auto bg-white rounded-sm text-gray-900">
            <ul v-if="$page.props.bug.comments">
                <li class="list-none mt-4 text-lg" v-for="comment in $page.props.bug.comments">
                    <p>{{comment.body}}</p>
                </li>
                <form @submit.prevent="() => form.post(`/bugs/${$page.props.bug.id}/comments`, {preserveState: false})" class="flex">
                <PrimaryButton >Add Comment</PrimaryButton>
                    <Input class="w-full inline-block" v-model.lazy.trim="form.body" />
                </form>
            </ul>
        </div>
    </Authenticated>
</template>

<script setup>
import {Head, useForm} from "@inertiajs/inertia-vue3";
import Authenticated from "@/Layouts/Authenticated";
import EditButton from "@/Components/EditButton";
import DeleteButton from "@/Components/DeleteButton";
import PrimaryButton from "@/Components/PrimaryButton";
import Input from "@/Components/Input";
function back() {
    window.history.back();
}
const form = useForm({body:null})
</script>

<style scoped>

</style>
