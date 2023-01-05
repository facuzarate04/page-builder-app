<script setup>
    import PageLayout from '@/Layouts/PageLayout.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import BlockModel from '@/Models/Block.js'

    const props = defineProps({
        owner: {
            type: Object,
            required: true,
        },
        blocks: {
            type: Array,
            required: true,
        },
    });

</script>

<template>
    <Head :title="`${owner.name} | Page`" />

    <PageLayout :owner="owner">
        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <div class="p-6 text-gray-900 space-y-4">
                        <div v-for="block in blocks.data" :key="block.id">
                            <!-- Header Block TODO: Move to specific component -->
                            <div v-if="BlockModel.isHeaderBlock(block.type)" class="mx-auto">
                                <h1 class="text-3xl font-bold">{{ block.blockable.title }}</h1>
                                <p class="">{{ block.blockable.subtitle }}</p>
                            </div>
                            <!-- Socials Block TODO: Move to specific component -->
                            <div v-if="BlockModel.isSocialBlock(block.type)" class="mx-auto flex items-center justify-center space-x-2">
                                <a v-for="socialLink in block.blockable?.socialLinks" :key="socialLink.id"
                                    :href="`${socialLink.platform?.url}/${socialLink.username}`"
                                    class="cursor-pointer"
                                >
                                    <img :src="socialLink.platform.icon" alt="Platform icon" class="w-6 h-6">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </PageLayout>
</template>