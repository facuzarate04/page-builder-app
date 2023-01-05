<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ChevronUpIcon, PencilSquareIcon, CheckIcon, PlusIcon } from '@heroicons/vue/24/solid'
import { Head, useForm, Link } from '@inertiajs/inertia-vue3';
import { Switch } from '@headlessui/vue'
import { ref } from '@vue/reactivity';

const props = defineProps({
    pageLink: {
        type: Object,
        required: true,
    },
    links: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    title: '',
    url: '',
});

function saveLink() {
    form.post(route('page.link.items.store', props.pageLink.id), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        }}
)};

</script>

<template>
    <Head title="Links | My Page" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Page</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-2">
                <div class="bg-white p-10 shadow-sm rounded-md space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold">Links Block</span>
                        <Link :href="route('page.index')">
                            <ChevronUpIcon class="h-6 w-6"/>
                        </Link>
                    </div>
                    <div class="max-w-xl mx-auto p-10 shadow-md rounded-xl">
                        <h4 class="text-left">New Link</h4>
                        <form class="space-y-4 mt-4">
                            <div class="relative rounded-md border border-gray-300 px-3 py-2 shadow-sm focus-within:border-indigo-600 focus-within:ring-1 focus-within:ring-indigo-600">
                                <label for="title" class="absolute -top-2 left-2 -mt-px inline-block bg-white px-1 text-xs font-medium text-gray-900">
                                    Title
                                </label>
                                <input v-model="form.title" type="text" name="title" id="title" class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm" placeholder="My Portfolio" />
                            </div>
                            <div class="relative rounded-md border border-gray-300 px-3 py-2 shadow-sm focus-within:border-indigo-600 focus-within:ring-1 focus-within:ring-indigo-600">
                                <label for="url" class="absolute -top-2 left-2 -mt-px inline-block bg-white px-1 text-xs font-medium text-gray-900">
                                    Url
                                </label>
                                <input v-model="form.url" type="url" name="url" id="url" class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm" placeholder="https://example.com" />
                            </div>
                            <div class="flex justify-end">
                                <button @click="saveLink()" type="button" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                            </div>
                        </form>
                    </div>
                    <div class="max-w-xl mx-auto w-full">
                        <div v-for="link in links" 
                            :key="link.id" 
                            class="mt-1 rounded-xl inline-flex shadow-sm bg-indigo-600 p-2 text-white w-full"
                        >
                                <span class="mx-auto">{{link.title}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>