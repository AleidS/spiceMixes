<script>
    // import { page, useForm } from '@inertiajs/svelte';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';
    import { router, page, Link } from '@inertiajs/svelte';
    import Button from '@/Components/Button.svelte';
    let { mixes } = $props();
</script>

<svelte:head>
    <title>Mixes</title>
</svelte:head>
<AuthenticatedLayout>
    User ID: {$page.props.auth.user.id}
    <h1>Mixes</h1>
    <table class="gap-3 border border-white p-4">
        <thead class="p-4">
            <tr>
                <th>Title</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            {#each mixes as mix}
                <tr
                    ><td class="border border-white">{mix.name}</td>
                    <td>{mix.description}</td>
                    <Link href={route('mixes.show', mix.id)} class="text-blue-500 hover:underline">
                        {mix.name}
                    </Link>
                </tr>
            {/each}
        </tbody>
    </table>

    <Link as="Button" href={route('mixes.create')} class="text-white hover:underline">
        <Button class="!bg-primary-600 !text-white">Add</Button>
    </Link>
</AuthenticatedLayout>

<!-- <button onclick={deleteMix}>Delete Mix</button> -->
