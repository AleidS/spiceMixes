<script>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';
    let { mix } = $props();
    import { router, page, Link } from '@inertiajs/svelte';
    import Button from '@/Components/Button.svelte';
</script>

<svelte:head>
    <title>{mix.name}</title>
</svelte:head>

<AuthenticatedLayout>
    <h1>{mix.name}</h1>
    <p><strong>Description:</strong> {mix.description}</p>
    <p><strong>Ingredients:</strong> {mix.ingredients}</p>
    <p><strong>Cuisine:</strong> {mix.cuisine}</p>
    <p><strong>User ID:</strong> {mix.user_id}</p>
    <p><strong>Photo URL:</strong> <a href={mix.photo_url} target="_blank">{mix.photo_url}</a></p>

    <Link href={route('mixes.index')} class="text-blue-500 hover:underline">Back to Mixes</Link>
</AuthenticatedLayout>
