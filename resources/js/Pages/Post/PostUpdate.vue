<script setup>
import { Head, Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";
import InputLabel from "@/components/InputLabel.vue";
import TextInput from "@/components/TextInput.vue";
import InputError from "@/components/InputError.vue";
import PrimaryButton from "@/components/PrimaryButton.vue";

// Define props and destructure the post property directly
const { post } = defineProps({
    post: {
        type: Object,
        required: true,
    },
});

// Initialize the form using the destructured post property
const form = useForm({
    title: post.title,
    tag: post.tag,
    description: post.description,
    user_id: post.user_id,
});

const updatePost = () => {
    form.put(`/post/${post.id}`, {
        preserveScroll: true,
    });
};
</script>
<template>
    <Head title="Update Post" />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Update post
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                >
                    <section class="max-w-xl">
                        <header>
                            <h2
                                class="text-lg font-medium text-gray-900 dark:text-gray-100"
                            >
                                Update post
                            </h2>

                            <p
                                class="mt-1 text-sm text-gray-600 dark:text-gray-400"
                            >
                                Update your post
                            </p>
                        </header>
                        <form
                            @submit.prevent="updatePost"
                            class="mt-6 space-y-6"
                        >
                            <div>
                                <InputLabel for="title" value="Title" />

                                <TextInput
                                    id="title"
                                    v-model="form.title"
                                    type="text"
                                    class="mt-1 block w-full"
                                />

                                <InputError
                                    :message="form.errors.title"
                                    class="mt-2"
                                />
                            </div>
                            <div>
                                <InputLabel for="tag" value="Tag" />

                                <TextInput
                                    id="tag"
                                    v-model="form.tag"
                                    type="text"
                                    class="mt-1 block w-full"
                                />

                                <InputError
                                    :message="form.errors.tag"
                                    class="mt-2"
                                />
                            </div>
                            <div>
                                <InputLabel
                                    for="description"
                                    value="Description"
                                />

                                <textarea
                                    id="description"
                                    v-model="form.description"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    rows="5"
                                    placeholder="..."
                                >
                                </textarea>

                                <InputError
                                    :message="form.errors.description"
                                    class="mt-2"
                                />
                            </div>
                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing"
                                    >Update</PrimaryButton
                                >

                                <Transition
                                    enter-active-class="transition ease-in-out"
                                    enter-from-class="opacity-0"
                                    leave-active-class="transition ease-in-out"
                                    leave-to-class="opacity-0"
                                >
                                    <p
                                        v-if="form.recentlySuccessful"
                                        class="text-sm text-gray-600 dark:text-green-400"
                                    >
                                        Post updated!
                                    </p>
                                </Transition>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
