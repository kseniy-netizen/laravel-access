<script setup>
import { Link, usePage, router } from '@inertiajs/vue3'
const props = defineProps({ posts: Array })
const user = usePage().props.auth.user

const canUpdate = (post) => user && (user.role === 'admin' || user.id === post.user_id)
const canDelete = (post) => user && user.role === 'admin'

const destroyPost = (post) => {
    if (confirm('Удалить пост?')) {
        router.delete(route('posts.destroy', post.id))
    }
}
</script>

<template>
    <div class="max-w-3xl mx-auto py-10 space-y-6">
        <h1 class="text-2xl font-bold">Список постов</h1>
        <div class="flex gap-4">
            <Link href="/admin" class="underline">Админ-панель</Link>
            <Link href="/" class="underline">Главная</Link>
        </div>
        <div v-if="user" class="mt-2">
            <Link v-if="['admin', 'editor', 'user'].includes(user.role)" :href="route('posts.create')" class="underline">
            Создать пост</Link>
        </div>
        <ul class="space-y-4">
            <li v-for="post in props.posts" :key="post.id" class="border p-4 rounded">
                <div class="text-lg font-semibold">{{ post.title }}</div>
                <div class="text-sm text-gray-600 mb-2">
                    Автор: {{ post.user?.name }} (id: {{ post.user_id }})
                </div>
                <div class="mb-3 whitespace-pre-wrap">{{ post.body }}</div>
                <div class="flex gap-3">
                    <Link v-if="canUpdate(post)" :href="route('posts.edit', post.id)" class="underline">
                    Редактировать
                    </Link>
                    <button v-if="canDelete(post)" @click="destroyPost(post)" class="underline">
                        Удалить
                    </button>
                </div>
            </li>
        </ul>
    </div>
</template>
