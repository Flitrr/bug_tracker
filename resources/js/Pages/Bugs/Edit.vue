<template>
    <Head title="Bug"/>
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Bug
            </h2>
        </template>
        <div class="h-96 flex items-stretch justify-center">
            <form class="w-6/12" @submit.prevent="form.put(`/bugs/${bug.id}`)">
                <div>
                    <Label for="name">Name:</Label>
                    <Input id="name" name="name" v-model="form.name"/>
                </div>
                <div>
                    <Label for="description">Description: </Label>
                    <Input id="description" name="description" v-model="form.description" />
                </div>
                <!--                other content here -->
                <div class="flex items-center justify-around">
                    <PrimaryButton type="submit">Submit</PrimaryButton>
                </div>
            </form>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import {Head, useForm} from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated';
import Label from "@/Components/Label";
import Input from "@/Components/Input";
import PrimaryButton from '@/Components/PrimaryButton';
const props = defineProps(['bug']);
const form = useForm({name: props.bug.name, description: props.bug.description, user_id: props.bug.user_id})
</script>

<style scoped>

</style>
