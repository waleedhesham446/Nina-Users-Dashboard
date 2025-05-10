<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    user: Object
});

const form = useForm({
    first_name: props.user.first_name,
    last_name: props.user.last_name,
    email: props.user.email,
    address: {
        country: props.user.address?.country ?? '',
        city: props.user.address?.city ?? '',
        post_code: props.user.address?.post_code ?? '',
        street: props.user.address?.street ?? ''
    }
});

const submit = () => {
    form.patch(route('users.update', props.user.id));
};
</script>

<template>
    <Head title="Edit User" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit User</h2>
                <Link :href="route('users.index')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Users
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">User Information</h3>

                                    <div class="mb-4">
                                        <InputLabel for="first_name" value="First Name" />
                                        <TextInput
                                            id="first_name"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.first_name"
                                            required
                                            autofocus
                                        />
                                        <InputError class="mt-2" :message="form.errors.first_name" />
                                    </div>

                                    <div class="mb-4">
                                        <InputLabel for="last_name" value="Last Name" />
                                        <TextInput
                                            id="last_name"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.last_name"
                                            required
                                        />
                                        <InputError class="mt-2" :message="form.errors.last_name" />
                                    </div>

                                    <div class="mb-4">
                                        <InputLabel for="email" value="Email" />
                                        <TextInput
                                            id="email"
                                            type="email"
                                            class="mt-1 block w-full"
                                            v-model="form.email"
                                            required
                                        />
                                        <InputError class="mt-2" :message="form.errors.email" />
                                    </div>
                                </div>

                                <div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Address Information</h3>

                                    <div class="mb-4">
                                        <InputLabel for="country" value="Country" />
                                        <TextInput
                                            id="country"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.address.country"
                                            required
                                        />
                                        <InputError class="mt-2" :message="form.errors['address.country']" />
                                    </div>

                                    <div class="mb-4">
                                        <InputLabel for="city" value="City" />
                                        <TextInput
                                            id="city"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.address.city"
                                            required
                                        />
                                        <InputError class="mt-2" :message="form.errors['address.city']" />
                                    </div>

                                    <div class="mb-4">
                                        <InputLabel for="post_code" value="Post Code" />
                                        <TextInput
                                            id="post_code"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.address.post_code"
                                            required
                                        />
                                        <InputError class="mt-2" :message="form.errors['address.post_code']" />
                                    </div>

                                    <div class="mb-4">
                                        <InputLabel for="street" value="Street" />
                                        <TextInput
                                            id="street"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.address.street"
                                            required
                                        />
                                        <InputError class="mt-2" :message="form.errors['address.street']" />
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6">
                                <PrimaryButton type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Update User
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
