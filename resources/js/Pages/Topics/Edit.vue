<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm , router} from '@inertiajs/vue3';

let props = defineProps({
    topic: {
        type: Object,
        required: true,
    },
    image:{
        type: String
    }
})

const form = useForm({
    image: null,
    name: props.topic.name,
})

function updateTopic() {
    // form.put("/topics/${topic.id}/store")
    router.post(`/topics/${props.topic.id}/update`, {
        _method: 'put',
        image: form.image,
        name: form.name,
    })
}
</script>

<template>
    <Head title="Edit Topic" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">Topic: {{ topic.name }}</h2>
        </template>

        <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg p-5">
                        <div class="flex lg:justify-start mb-5">
                            <Link href="/topics" class="py-2 px-6 bg-indigo-500 hover:bg-indigo-800 text-white rounded-lg">Back
                            </Link>
                        </div>
                        

                        <div class=" lg:w-7/12 mx-auto my-5 ">

                            <form class="" @submit.prevent="updateTopic()">
                                <div class="mb-5">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Topic
                                        Name</label>
                                    <input type="text" id="name" v-model="form.name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Chemistry 104" required>
                                </div>
                                <div class="mb-5">
                                    
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="user_avatar">Topic Image</label>
                                    <img :src="props.image" class="h-auto w-24 my-3" alt="">
                                    <input @input="form.image = $event.target.files[0]"
                                        class="block p-2.5 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        aria-describedby="user_avatar_help" id="user_avatar" type="file">
                                    <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help">A topic
                                        picture is useful </div>
                                </div>

                                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                    {{ form.progress.percentage }}%
                                </progress>
                                <button v-else type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
                            </form>
                    </div>


                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>
