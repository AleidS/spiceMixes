<script>
    // import { page, useForm } from '@inertiajs/svelte';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';
    import { router, page, useForm } from '@inertiajs/svelte';
    import Button from '@/Components/Button.svelte';
    let { mixes, errors } = $props();

    const form = useForm({
        name: 'Henkiee',
        ingredients: '{"name":"John", "age":30, "car":null}',
        description: '123',
        user_id: $page.props.auth.user.id,
        cuisine: '2',
        photo_url: 'abc.com',
        avatar: null
    });

    async function addMix(event) {
        event.preventDefault();
        $form.post('/mixes');
        // form.name = '';
        // form.ingredients = '';
        // form.description = '';
        // form.user_id = '';
        // form.cuisine = '';
        // form.photo_url = '';
        // form.avatar = '';
    }
</script>

<svelte:head>
    <title>Add a mix</title>
</svelte:head>
<AuthenticatedLayout>
    <h2>Add Mix</h2>
    <form onsubmit={addMix} class="flex flex-col gap-y-1">
        <input type="text" bind:value={$form.name} placeholder="Name" class="text-black" />
        {#if errors?.name}
            <div class="error">{errors.name}</div>
        {/if}

        <input
            type="text"
            bind:value={$form.ingredients}
            placeholder="Ingredients (JSON)"
            class="text-black"
        />
        {#if errors?.ingredients}
            <div class="error">{errors.ingredients}</div>
        {/if}

        <input
            type="text"
            bind:value={$form.description}
            placeholder="Description"
            class="text-black"
        />
        {#if errors?.description}
            <div class="error">{errors.description}</div>
        {/if}

        <input type="number" bind:value={$form.cuisine} placeholder="Cuisine" class="text-black" />
        {#if errors?.cuisine}
            <div class="error">{errors.cuisine}</div>
        {/if}

        <input
            type="file"
            id="avatar"
            bind:files={$form.avatar}
            class="border-uiGray-300 mt-1 block w-full rounded-md border px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
        />
        <Button type="submit" class="!bg-red-400">Add Mix</Button>
    </form>
</AuthenticatedLayout>

<!-- <button onclick={deleteMix}>Delete Mix</button> -->
