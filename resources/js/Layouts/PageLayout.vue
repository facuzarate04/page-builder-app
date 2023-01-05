<script setup>
    const props = defineProps({
        owner: {
            type: Object,
            required: true,
        },
    });
</script>

<template>
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 bg-gray-100">
        <!-- Page Heading -->
            <header class="absolute top-0 w-full mx-auto">
                <!-- <div class="text-center py-10">
                    <h2 class="font-bold">{{ owner.name }}</h2>
                    <p class="">{{ owner }}</p>
                </div> -->
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
    </div>
</template>