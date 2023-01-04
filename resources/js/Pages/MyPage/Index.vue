<script setup>
    import PageLayout from '@/Layouts/PageLayout.vue';
    import { Head } from '@inertiajs/inertia-vue3';

    const props = defineProps({
        owner: {
            type: Object,
            required: true,
        },
    });

</script>

<template>
    <Head title="Dashboard" />

    <PageLayout :owner="owner">
        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <div class="p-6 text-gray-900">Algo</div>
                </div>
            </div>
        </div>
    </PageLayout>
</template>