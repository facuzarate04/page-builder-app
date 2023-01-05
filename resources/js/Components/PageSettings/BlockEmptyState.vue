<template>
  <Link :href="createUrl" class="bg-white relative block rounded-lg border-2 border-dashed border-gray-400 p-10 text-center hover:border-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
    <slot name="icon"/>
    <span class="mt-2 block text-sm font-medium text-gray-900">Create a {{blockName}}</span>
  </Link>
</template>

<script setup>
  import { Link } from '@inertiajs/inertia-vue3';

  const props = defineProps({
    blockName: {
      type: String,
      required: true,
    },
    createUrl: {
      type: String,
      required: true,
    },

  });

</script>