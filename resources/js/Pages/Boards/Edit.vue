<template>
    <Head title="Edit Board" />
    <Authenticated>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Board
            </h2>
        </template>
        <form action="#" method="post" @submit.prevent="() => form.put(`/boards/${board.id}`)" class="mx-auto w-96">
            <div>
                <Label for="name">Name</Label>
                <Input id="name" class="w-full" name="name" v-model="form.name" />
            </div>
            <div>
                <PrimaryButton type="submit" class="mx-auto mt-4 block">Submit</PrimaryButton>
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

const props = defineProps(['board']);

const form = useForm({name: props.board.name});
</script>

<style scoped>

</style>
