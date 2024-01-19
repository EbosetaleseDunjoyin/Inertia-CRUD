<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head , Link} from '@inertiajs/vue3';

defineProps({
    topics: {
        type: Object,
        required: true,
    }
})


</script>

<template>
    <Head title="Topics" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white">Topics</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class=" dark:bg-slate-900 bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                    <div class="flex lg:justify-end mb-5">
                        <Link href="/topics/create" class="py-2 px-6 bg-indigo-500 hover:bg-indigo-800 text-white rounded-lg" >Create</Link>
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table v-if="topics.length > 0" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        S/N
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Image
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr v-for="(topic, index) in topics" :key="index" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                      {{  index + 1 }}
                                    </th>
                                    <td class="px-6 py-4">
                                       {{ topic.name }}
                                    </td>
                                    
                                    <td class="px-6 py-4">
                                        <img :src="topic.image" class="h-auto w-24" alt="">
                                    </td>
                                    <td class="px-6 py-4 ">
                                        <div class="flex gap-1 items-center">

                                            <Link :href="`/topics/${topic.id}/edit`" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</Link>
                                            |
                                            <Link :href="`/topics/${topic.id}/delete`" method="delete" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</Link>
                                        </div>
                                    </td>
                                </tr>
                            
                            
                            </tbody>
                        </table>
                        <h2 class="text-gray-800 dark:text-white text-xl text-center" v-else >No data found...</h2>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
