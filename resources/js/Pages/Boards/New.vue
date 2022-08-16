<template>
    <Head title="New Board" />
    <Authenticated>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                New Board
            </h2>
        </template>
        <form @submit.prevent="() => form.post(route('boards.store'))" class="mx-auto w-96">
            <div>
                <Label for="user">Name</Label>
                <Input id="user" class="w-full" name="title" v-model="form.user" />
            </div>
            <div>
                <PrimaryButton class="mx-auto mt-4 block">Submit</PrimaryButton>
            </div>
        </form>
    </Authenticated>
</template>

<script setup>
import {Head, useForm} from "@inertiajs/inertia-vue3";
import Authenticated from "@/Layouts/Authenticated";
import Label from '@/Components/Label';
import Input from "@/Components/Input";
import PrimaryButton from "@/Components/PrimaryButton";

const form = useForm({user: null})
</script>

<style scoped>

</style>
