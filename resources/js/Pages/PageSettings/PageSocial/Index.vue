<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ChevronUpIcon, PencilSquareIcon, CheckIcon, PlusIcon } from '@heroicons/vue/24/solid'
import { Head, useForm, Link } from '@inertiajs/inertia-vue3';
import { Switch } from '@headlessui/vue'
import { ref } from '@vue/reactivity';

const props = defineProps({
    pageSocial: {
        type: Object,
        required: true,
    },
    platforms: {
        type: Array,
        required: true,
    },
});

const updateForm = useForm({
    page_social_id: props.pageSocial.id,
    platforms: props.platforms,
    username: null,
    __method: 'PUT'
});

function updateSocialLinks() {
    updateForm.put(route('dashboard.page.social.links.upsert', { pageSocial: props.pageSocial.id }), {
        preserveScroll: true,
        onSuccess: () => {
            updateForm.reset();
        }
    });
}

</script>

<template>
    <Head title="Socials | My Page" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Page</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-2">
                <div class="bg-white p-10 shadow-sm rounded-md space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold">Socials Block</span>
                        <Link :href="route('dashboard.page.index')">
                            <ChevronUpIcon class="h-6 w-6"/>
                        </Link>
                    </div>
                    <div class="max-w-xl mx-auto">
                        <div v-for="platform in platforms" :key="platform.id" class="relative mt-1 rounded-md shadow-sm">
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-gray-500 sm:text-sm">
                                    {{ platform.url }}/
                                </span>
                                <input v-model="platform.username" type="text" name="username" id="username" class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"  />
                            </div>
                        </div>
                        <div class="flex justify-end pt-2">
                            <button @click="updateSocialLinks()" type="button" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>