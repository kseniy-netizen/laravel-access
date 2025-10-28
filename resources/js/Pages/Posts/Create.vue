<script setup>
import { Link, useForm } from '@inertiajs/vue3'
const form = useForm({
    title: '',
    body: '',
})
const submit = () => {
    form.post(route('posts.store'))
}
</script>
<template>
    <div class="max-w-xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-6">Создать пост</h1>
        <form @submit.prevent="submit" class="space-y-4">
            <div>
                <label class="block mb-1">Заголовок</label>
                <input v-model="form.title" class="border rounded w-full p-2" required />
                <div v-if="form.errors.title" class="text-red-600 text-sm">{{ form.errors.title }}</div>
            </div>
            <div>
                <label class="block mb-1">Текст</label>
                <textarea v-model="form.body" rows="6" class="border rounded w-full p-2" required />
                <div v-if="form.errors.body" class="text-red-600 text-sm">{{ form.errors.body }}</div>
            </div>
            <div class="flex gap-3">
                <button class="px-4 py-2 border rounded" :disabled="form.processing">Сохранить</button>
                <Link class="underline" :href="route('posts.index')">Отмена</Link>
            </div>
        </form>
    </div>
</template>