<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { ChevronDownIcon, ComputerDesktopIcon, LinkIcon, GlobeAltIcon, ArrowTopRightOnSquareIcon, Bars4Icon } from '@heroicons/vue/24/solid'
import { Link } from '@inertiajs/inertia-vue3'
import BlockModel from '@/Models/Block.js'
import BlockEmptyState from '@/Components/PageSettings/BlockEmptyState.vue';
import Draggable from 'vuedraggable'
import { onMounted } from '@vue/runtime-core';

const props = defineProps({
    blocks: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    blocks: props.blocks.data,
    __method: 'PUT',
});

function order() {
    props.blocks.data.forEach((block, index) => {
        block.order = index + 1;
    });
    
    form.put(route('dashboard.page.order'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
    });
}

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Page</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-2">
                <Draggable
                    :list="blocks.data"
                    item-key="id"
                    class="list-group"
                    ghost-class="ghost"
                    @change="order"
                    @start="dragging = true"
                    @end="dragging = false"
                >
                    <template #item="{ element }">
                        <div class="list-group-item">
                            <div v-if="BlockModel.isHeaderBlock(element.type)" class="bg-white p-10 shadow-sm rounded-md flex items-center justify-between mt-2">
                                <Bars4Icon class="h-6 w-6 cursor-pointer"/>
                                <span class="font-semibold">Header</span>
                                <Link :href="route('dashboard.page.header.index')">
                                    <ChevronDownIcon class="h-6 w-6"/>
                                </Link>
                            </div>
                            <!-- Links -->
                            <div v-if="BlockModel.isLinkBlock(element.type)" class="bg-white p-10 shadow-sm rounded-md flex items-center justify-between mt-2">
                                <Bars4Icon class="h-6 w-6 cursor-pointer"/>
                                <span class="font-semibold">Links</span>
                                <Link :href="route('dashboard.page.link.index')">
                                    <ChevronDownIcon class="h-6 w-6"/>
                                </Link>
                            </div>
                            <!-- Socials -->
                            <div v-if="BlockModel.isSocialBlock(element.type)" class="bg-white p-10 shadow-sm rounded-md flex items-center justify-between mt-2">
                                <Bars4Icon class="h-6 w-6 cursor-pointer"/>
                                <span class="font-semibold">Socials</span>
                                <Link :href="route('dashboard.page.social.index')">
                                    <ChevronDownIcon class="h-6 w-6"/>
                                </Link>
                            </div>
                        </div>
                    </template>
                </Draggable>
                
                <BlockEmptyState v-if="!BlockModel.hasHeaderBlock(blocks.data)" 
                    :blockName="'Header Block'"
                    :createUrl="route('dashboard.page.header.index')">
                    <template #icon>
                        <ComputerDesktopIcon class="h-6 w-6 mx-auto" aria-hidden="true" />
                    </template>
                </BlockEmptyState>
                <BlockEmptyState v-if="!BlockModel.hasSocialBlock(blocks.data)" 
                    :blockName="'Socials Block'"
                    :createUrl="route('dashboard.page.social.update')">
                    <template #icon>
                        <GlobeAltIcon class="h-6 w-6 mx-auto" aria-hidden="true" />
                    </template>
                </BlockEmptyState>
                <BlockEmptyState v-if="!BlockModel.hasLinkBlock(blocks.data)" 
                    :blockName="'Links Block'"
                    :createUrl="route('dashboard.page.link.index')">
                    <template #icon>
                        <LinkIcon class="h-6 w-6 mx-auto" aria-hidden="true" />
                    </template>
                </BlockEmptyState>
                
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10">
                <div class="w-full">
                    <Link :href="route('landing.index', {username: $page.props.auth.user.username})" class="flex items-center justify-center space-x-2">
                        <span class="font-semibold">View my page</span>
                        <ArrowTopRightOnSquareIcon class="h-6 w-6"/>
                    </Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>