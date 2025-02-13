<script>
    // import { page, useForm } from '@inertiajs/svelte';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';
    import { router, page, useForm } from '@inertiajs/svelte';

    import Button from '@/Components/Button.svelte';
    import Input from '@/Components/Input.svelte';

    import { FileUpload } from 'melt/builders';

    const fileUpload = new FileUpload();

    let { mixes, errors, measures } = $props();

    const form = useForm({
        name: 'Henkiee',
        ingredients: '[{}]',
        description: '123',
        user_id: $page.props.auth.user.id,
        cuisine_id: '2',
        avatar: null
    });

    $effect(() => {
        console.log(form.avatar);
    });

    async function addMix(event) {
        event.preventDefault();
        console.log(form.avatar);
        $form.post('/mixes');
    }
</script>

<svelte:head>
    <title>Add a mix</title>
</svelte:head>
<AuthenticatedLayout>
    <h2>Add Mix</h2>

    <form onsubmit={addMix} class="flex flex-col gap-y-1">
        <input {...fileUpload.input} />
        <div {...fileUpload.dropzone}>
            {#if fileUpload.isDragging}
                Drop files here
            {:else}
                Click to upload or drag and drop
            {/if}
        </div>

        <Input
            type="text"
            bind:value={$form.name}
            placeholder="Name"
            class="text-black"
            label="Title"
            error={errors?.name}
        />

        {#each $form.ingredients as ingredient}
            <div class="flex">
                <Input
                    label="quantity"
                    type="select"
                    bind:value={ingredient.quantity}
                    placeholder="Ingredients (JSON)"
                    class="text-black"
                />
                <Input
                    label="measure"
                    options={measures}
                    type="select"
                    bind:value={ingredient.measure}
                    placeholder="Ingredients (JSON)"
                    class="text-black"
                />
                <Input
                    label="name"
                    type="text"
                    bind:value={ingredient.name}
                    placeholder="Ingredients (JSON)"
                    class="text-black"
                />
            </div>
        {/each}

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

        <input
            type="number"
            bind:value={$form.cuisine_id}
            placeholder="Cuisine"
            class="text-black"
        />
        {#if errors?.cuisine}
            <div class="error">{errors.cuisine_id}</div>
        {/if}

        <!-- <ImageInput bind:files={$form.avatar} onchange={console.log($form.avatar)} /> -->
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
