<template>    
    <div class="fixed top-4 right-4 z-50">
        <ToastListItem 
            v-for="(item, index) in toast.items"
            :key="item.key"
            :message="item.message"
            :type="item.type"
            @remove="remove(index)"
        />
    </div>
</template>

<script setup>
import ToastListItem from '@/Components/ToastListItem.vue';
import { Inertia } from '@inertiajs/inertia';
import { usePage } from '@inertiajs/inertia-vue3';
import { ref } from '@vue/reactivity';
import toast from '@/Composables/toast.js';
import { onUnmounted } from '@vue/runtime-core';

const page = usePage();

let removeFinishEventListener = Inertia.on('finish', () => {
    if(page.props.value.success || page.props.value.error)
    {
        toast.add({
            message: page.props.value.success ?? page.props.value.error,
            type: page.props.value.success ? 'success' : 'error',
        })
    }
});

onUnmounted(() => {
    removeFinishEventListener();
});

function remove(index) {
    toast.remove(index, 1);
}

</script>