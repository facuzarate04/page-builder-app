<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ChevronUpIcon, PencilSquareIcon, CheckIcon } from '@heroicons/vue/24/solid'
import { Head, useForm, Link } from '@inertiajs/inertia-vue3';
import { Switch } from '@headlessui/vue'
import { ref } from '@vue/reactivity';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    header: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    id: props.header.id,
    title: props.header.title,
    subtitle: props.header.subtitle,
    avatar: props.header.avatar,
    avatar_is_active: props.header.avatar_is_active,
    banner: props.header.banner,
    banner_is_active: props.header.banner_is_active,
    __method: 'PUT'
});

const titleOnEdit = ref(false);
const subtitleOnEdit = ref(false);

function update() {
    form.put(route('dashboard.page.header.update', {pageHeader: form.id} ), {
        preserveScroll: true,
        onSuccess: () => {
            Inertia.reload({ only: ['header'] });
        },
    });
}

</script>

<template>
    <Head title="Header | My Page" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Page</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-2">
                <div class="bg-white p-10 shadow-sm rounded-md space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold">Header Block</span>
                        <Link :href="route('dashboard.page.index')">
                            <ChevronUpIcon class="h-6 w-6"/>
                        </Link>
                    </div>
                    <div class="">
                        <form>
                            <div class="sm:overflow-hidden">
                                <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                                    <div class="px-10 max-w-lg mx-auto space-y-2">
                                        <div class="mx-auto">
                                            <span v-if="form.title && !titleOnEdit" class="flex space-x-2 items-center justify-center">
                                                <h4 class="font-bold text-xl">{{ form.title }}</h4>
                                                <PencilSquareIcon @click="titleOnEdit = true" class="h-6 w-6 cursor-pointer"/>
                                            </span>
                                            <span v-else-if="!form.title || titleOnEdit" class="flex space-x-2 items-center justify-center">
                                                <input v-model="form.title" @change="titleOnEdit = true" type="text" name="title" id="title" class="block w-fit flex-1 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" :placeholder="header.page.owner.name" />
                                                <CheckIcon @click="titleOnEdit = false" class="h-6 w-6 cursor-pointer"/>
                                            </span>
                                        </div>
                                        <div class="mx-auto">
                                            <span v-if="form.subtitle && !subtitleOnEdit" class="flex space-x-2 items-center justify-center">
                                                <p class="" >{{ form.subtitle }}</p>
                                                <PencilSquareIcon @click="subtitleOnEdit = true" class="h-6 w-6 cursor-pointer"/>
                                            </span>
                                            <span v-else-if="!form.subtitle || subtitleOnEdit" class="flex space-x-2 items-center justify-center">
                                                <textarea v-model="form.subtitle" @change="subtitleOnEdit = true" id="subtitle" name="subtitle" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="software engineer and content creator" />
                                                <CheckIcon @click="subtitleOnEdit = false" class="h-6 w-6 cursor-pointer"/>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 py-3 text-right sm:px-6">
                                    <button @click="update()" type="button" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>