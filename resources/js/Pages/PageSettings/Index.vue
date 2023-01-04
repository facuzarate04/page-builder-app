<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { ChevronDownIcon, ComputerDesktopIcon, LinkIcon, GlobeAltIcon } from '@heroicons/vue/24/solid'
import { Link } from '@inertiajs/inertia-vue3'
import BlockModel from '@/Models/Block.js'
import { onMounted } from '@vue/runtime-core';
import BlockEmptyState from '@/Components/PageSettings/BlockEmptyState.vue';
import Draggable from 'vuedraggable'

const props = defineProps({
    blocks: {
        type: Array,
        required: true,
    },
});

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Page</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-2">
                <div v-for="block in blocks.data" :key="block.id">
                    <!-- Header -->
                    <div v-if="BlockModel.isHeaderBlock(block.type)" class="bg-white p-10 shadow-sm rounded-md flex items-center justify-between">
                        <span class="font-semibold">Header</span>
                        <Link :href="route('dashboard')">
                            <ChevronDownIcon class="h-6 w-6"/>
                        </Link>
                    </div>
                    <!-- Links -->
                    <div v-if="BlockModel.isLinkBlock(block.type)" class="bg-white p-10 shadow-sm rounded-md flex items-center justify-between">
                        <span class="font-semibold">Links</span>
                        <Link :href="route('dashboard')">
                            <ChevronDownIcon class="h-6 w-6"/>
                        </Link>
                    </div>
                    <!-- Socials -->
                    <div v-if="BlockModel.isSocialBlock(block.type)" class="bg-white p-10 shadow-sm rounded-md flex items-center justify-between">
                        <span class="font-semibold">Socials</span>
                        <Link :href="route('dashboard')">
                            <ChevronDownIcon class="h-6 w-6"/>
                        </Link>
                    </div>
                </div>
                <BlockEmptyState v-if="!BlockModel.hasHeaderBlock(blocks.data)" 
                    :blockName="'Header Block'"
                    :createUrl="route('dashboard')">
                    <template #icon>
                        <ComputerDesktopIcon class="h-6 w-6 mx-auto" aria-hidden="true" />
                    </template>
                </BlockEmptyState>
                <BlockEmptyState v-if="!BlockModel.hasSocialBlock(blocks.data)" 
                    :blockName="'Socials Block'"
                    :createUrl="route('dashboard')">
                    <template #icon>
                        <GlobeAltIcon class="h-6 w-6 mx-auto" aria-hidden="true" />
                    </template>
                </BlockEmptyState>
                <BlockEmptyState v-if="!BlockModel.hasLinkBlock(blocks.data)" 
                    :blockName="'Links Block'"
                    :createUrl="route('dashboard')">
                    <template #icon>
                        <LinkIcon class="h-6 w-6 mx-auto" aria-hidden="true" />
                    </template>
                </BlockEmptyState>
            </div>
        </div>
    </AuthenticatedLayout>
</template>