<template>
    <Head title="Column"/>
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Column
            </h2>
        </template>
        <div class="h-96 flex items-stretch justify-center">
            <form class="w-6/12" @submit.prevent="form.put(`/columns/${column.id}`)">
                <div>
                    <Label for="name">Name:</Label>
                <Input id="name" name="name" v-model="form.name"/>
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

import Label from "@/Components/Label";
import Input from "@/Components/Input";
import {useForm} from "@inertiajs/inertia-vue3";
import PrimaryButton from "@/Components/PrimaryButton";
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated';
const props = defineProps(['column'])
const form = useForm({name: props.column.name});
</script>

<style scoped>

</style>
