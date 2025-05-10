<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({
    user: Object
});
</script>

<template>
    <Head title="User Details" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">User Details</h2>
                <Link :href="route('users.index')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Users
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">User Information</h3>
                                <div class="mt-4 space-y-2">
                                    <div>
                                        <span class="text-gray-500">First Name:</span>
                                        <span class="ml-2 text-gray-900">{{ user.first_name }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Last Name:</span>
                                        <span class="ml-2 text-gray-900">{{ user.last_name }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Email:</span>
                                        <span class="ml-2 text-gray-900">{{ user.email }}</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Address Information</h3>
                                <div class="mt-4 space-y-2">
                                    <div>
                                        <span class="text-gray-500">Country:</span>
                                        <span class="ml-2 text-gray-900">{{ user.address.country }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">City:</span>
                                        <span class="ml-2 text-gray-900">{{ user.address.city }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Post Code:</span>
                                        <span class="ml-2 text-gray-900">{{ user.address.post_code }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Street:</span>
                                        <span class="ml-2 text-gray-900">{{ user.address.street }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex space-x-4">
                            <Link :href="route('users.edit', user.id)" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Edit User
                            </Link>
                            <Link :href="route('users.destroy', user.id)" method="delete" as="button" type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this user?')">
                                Delete User
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>