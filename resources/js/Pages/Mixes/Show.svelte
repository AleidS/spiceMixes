<script>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';

    let { mix, measures } = $props();
    import Icon from '@iconify/svelte';
    import { router, page, Link } from '@inertiajs/svelte';
    import Button from '@/Components/Button.svelte';
</script>

<svelte:head>
    <title>{mix.data.name}</title>
</svelte:head>

<AuthenticatedLayout>
    <div class="page flex flex-col gap-6">
        <div class="flex w-full justify-between">
            <h1 class="font-primary text-3xl font-medium">
                {mix.data.name}
            </h1>
            <Link href={route('mixes.edit', mix.data.id)}>
                {#if mix.data.editable}
                    <Button class="rounded-xl !bg-primary-400">
                        <Icon icon="mdi:pencil" class="mb-1" />
                        Edit
                    </Button>
                {/if}
            </Link>
        </div>
        <div class="flex flex-wrap justify-stretch gap-6 md:justify-between">
            <div
                class=" sm: h-[250px] w-full overflow-hidden object-cover sm:max-w-[300px] md:max-w-[300px]"
            >
                {#if mix.data.avatar}
                    <img
                        src={mix.data.avatar}
                        alt={mix.data.name}
                        class="max-h-full min-h-full min-w-full max-w-full rounded-md border border-uiGray-400 object-cover object-center"
                    />
                {:else}
                    <img
                        src="/storage/pexels-martabranco-1340116.jpg"
                        alt="4 spoons with spices"
                        class="max-h-full min-h-full min-w-full max-w-full rounded-md border border-uiGray-400 object-cover object-center"
                    />
                {/if}
            </div>

            <div class="box flex-1">
                <h4>Ingredients:</h4>
                <ul>
                    {#each mix.data.ingredients as ingredient}
                        <li>
                            {ingredient?.quantity}
                            {measures.data.find((measure) => measure.id == ingredient.measure_id)
                                ?.name}
                            {ingredient?.name}
                        </li>
                    {/each}
                </ul>
            </div>
        </div>
        <div class="box">
            <h4>Description</h4>
            <p>{mix.data.description}</p>
        </div>

        <p><strong>Cuisine:</strong> {mix.data.cuisine.name}</p>
    </div>

    <Button class="mt-3 !bg-secondary-600 !text-uiGray-50 hover:bg-secondary-400 ">
        <Link href={route('home')} class="flex items-center gap-1 ">
            <Icon icon="mdi:arrow-left-circle" class="mb-[2px] size-4" />
            Back to Mixes
        </Link>
    </Button>
</AuthenticatedLayout>
