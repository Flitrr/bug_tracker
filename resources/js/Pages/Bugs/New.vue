<template>
    <Head title="New Bug" />
    <Authenticated>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Bugs
            </h2>
        </template>
        <div class="w-9/12 mx-auto">
            <form @submit.prevent="form.post('/bugs')">
                <div>
                    <Label for="name">Name: </Label>
                    <Input id="name" v-model="form.name"/>
                </div>
                <div>
                    <Label for="description">Description: </Label>
                    <Input id="description" v-model="form.description" type="text" />
                </div>
                <PrimaryButton type="submit">Create</PrimaryButton>
            </form>
        </div>
    </Authenticated>
</template>

<script setup>
import {Head, useForm} from "@inertiajs/inertia-vue3";
import Authenticated from "@/Layouts/Authenticated";
import Label from "@/Components/Label";
import Input from "@/Components/Input";
import {usePage} from "@inertiajs/inertia-vue3";
import PrimaryButton from "@/Components/PrimaryButton";
const form = useForm({name: null, description: null, user_id: usePage().props.value.auth.user.id});
</script>

<style scoped>

</style>
