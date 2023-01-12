<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ChevronUpIcon, Bars4Icon, TrashIcon } from '@heroicons/vue/24/solid'
import { Head, useForm, Link } from '@inertiajs/inertia-vue3';
import { Switch } from '@headlessui/vue'
import { ref } from '@vue/reactivity';
import Draggable from 'vuedraggable'
import { Inertia } from '@inertiajs/inertia';

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
    form.post(route('dashboard.page.link.items.store', props.pageLink.id), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        }}
)};

const orderForm = useForm({
    links: props.links,
    __method: 'PUT',
});

function order() {
    props.links.forEach((link, index) => {
        link.order = index + 1;
    });
    
    orderForm.put(route('dashboard.page.link.items.order', {pageLink: props.pageLink.id}), {
        preserveScroll: true,
        onSuccess: () => {
            orderForm.reset();
        },
    });
}

function destroy(element) {
    Inertia.delete(route('dashboard.page.link.items.destroy', 
            {pageLink: props.pageLink.id, pageLinkItem: element.id}
        ), 
        {
            preserveScroll: true,
            onSuccess: () => {
                Inertia.reload({ only: ['links'] });
            },
        }
    );
}

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
                        <Link :href="route('dashboard.page.index')">
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
                        <Draggable
                            :list="links"
                            item-key="id"
                            class="list-group"
                            ghost-class="ghost"
                            @change="order"
                            @start="dragging = true"
                            @end="dragging = false"
                        >
                            <template #item="{ element }">
                                <div class="list-group-item">
                                    <div class="mt-1 rounded-xl inline-flex shadow-sm bg-indigo-600 p-2 text-white w-full"
                                    >
                                        <Bars4Icon class="h-6 w-6 cursor-pointer"/>
                                        <span class="mx-auto">{{element.title}}</span>
                                        <TrashIcon @click="destroy(element)" class="h-6 w-6 cursor-pointer"/>
                                    </div>
                                </div>
                            </template>
                        </Draggable>
                        
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>