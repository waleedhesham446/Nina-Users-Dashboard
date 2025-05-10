<template>
    <div v-if="links.length > 1" class="flex items-center justify-end space-x-2">
        <template v-for="(link, index) in links" :key="index">
            <!-- <component
                :is="link.url ? 'Link' : 'span'"
                :href="link.url"
                v-html="link.label"
                class="px-3 py-1 rounded text-sm"
                :class="[
                    link.active ? 'bg-blue-500 text-white' : 'text-gray-700 hover:underline',
                    !link.url && 'text-gray-400 cursor-not-allowed'
                ]"
            /> -->
            <Link
                v-if="link.url"
                :href="link.url"
                class="px-3 py-1 rounded text-sm"
                :class="link.active ? 'bg-blue-500 text-white' : 'text-gray-700 hover:underline'"
                v-html="link.label"
            />
            <span
                v-else
                class="px-3 py-1 rounded text-sm text-gray-400 cursor-not-allowed"
                v-html="link.label"
            />
        </template>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    links: Array
});
</script>
