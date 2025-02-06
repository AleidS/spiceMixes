<script>
    // import { page, useForm } from '@inertiajs/svelte';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';
    import { router, page } from '@inertiajs/svelte';
    import Button from '@/Components/Button.svelte';
    let { mixes, errors } = $props();

    let form = {
        name: '',
        ingredients: '',
        description: '',
        user_id: '',
        cuisine: '',
        photo_url: ''
    };

    async function addMix(event) {
        event.preventDefault();
        await router.post('/mixes', form);
        form.name = '';
        form.ingredients = '';
        form.description = '';
        form.user_id = '';
        form.cuisine = '';
        form.photo_url = '';
    }
</script>

<svelte:head>
    <title>Add a mix</title>
</svelte:head>
<AuthenticatedLayout>
    <h2>Add Mix</h2>
    <form onsubmit={addMix} class="flex flex-col gap-y-1">
        <input type="text" bind:value={form.name} placeholder="Name" />
        {#if errors?.name}
            <div class="error">{errors.name}</div>
        {/if}

        <input type="text" bind:value={form.ingredients} placeholder="Ingredients (JSON)" />
        {#if errors?.ingredients}
            <div class="error">{errors.ingredients}</div>
        {/if}

        <input type="text" bind:value={form.description} placeholder="Description" />
        {#if errors?.description}
            <div class="error">{errors.description}</div>
        {/if}

        <input type="number" bind:value={form.user_id} placeholder="User ID" />
        {#if errors?.user_id}
            <div class="error">{errors.user_id}</div>
        {/if}

        <input type="number" bind:value={form.cuisine} placeholder="Cuisine" />
        {#if errors?.cuisine}
            <div class="error">{errors.cuisine}</div>
        {/if}

        <input type="text" bind:value={form.photo_url} placeholder="Photo URL" />
        {#if errors?.photo_url}
            <div class="error">{errors.photo_url}</div>
        {/if}
        <Button type="submit" class="!bg-red-400">Add Mix</Button>
    </form>
</AuthenticatedLayout>

<!-- <button onclick={deleteMix}>Delete Mix</button> -->
