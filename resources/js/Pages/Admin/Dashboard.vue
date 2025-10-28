<script setup>
import { usePage, Link } from '@inertiajs/vue3'
const user = usePage().props.auth.user
</script>
<template>
    <div class="max-w-xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-4">Админ-панель</h1>
        <p class="mb-4">Здравствуйте, {{ user.name }}!</p>
        <Link href="/posts" class="underline">К постам</Link>
    </div>
</template>