<script>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';

    let { mix, measures } = $props();
    import Icon from '@iconify/svelte';
    import { router, page, Link } from '@inertiajs/svelte';
    import Button from '@/Components/Button.svelte';

    console.log(mix.data);
    console.log(measures.data.find((measure) => measure.id == 1).name);
</script>

<svelte:head>
    <title>{mix.data.name}</title>
</svelte:head>

<AuthenticatedLayout>
    <div class="bg-uiDark-700 flex flex-col gap-6 rounded-lg p-4 md:p-8">
        <div>
            <h1 class="font-primary text-3xl font-medium">
                {mix.data.name}
            </h1>
        </div>
        <div class="flex flex-wrap justify-stretch gap-6 md:justify-between">
            <div
                class=" sm: h-[250px] w-full overflow-hidden object-cover sm:max-w-[300px] md:max-w-[300px]"
            >
                <img
                    src={mix.data.avatar}
                    alt="none"
                    class="border-uiGray-400 max-h-full min-h-full min-w-full max-w-full rounded-md border object-cover object-center"
                />
            </div>

            <div class="bg-uiDark-600 flex-1 rounded-md p-4">
                <h2>Ingredients:</h2>
                <ul>
                    {#each mix.data.ingredients as ingredient}
                        <li>
                            {ingredient.quantity}
                            {measures.data.find((measure) => measure.id == ingredient.measure_id)
                                .name}
                            {ingredient.name}
                        </li>
                    {/each}
                </ul>
            </div>
        </div>
        <div class="bg-uiDark-600 p-4">
            <h2>Description</h2>
            <p>{mix.data.description}</p>
        </div>

        <p><strong>Cuisine:</strong> {mix.data.cuisine.name}</p>
    </div>

    <Button class="!bg-secondary-600 hover:bg-secondary-400 !text-uiGray-50 mt-3 ">
        <Link href={route('mixes.index')} class="flex items-center gap-1 ">
            <Icon icon="mdi:arrow-left-circle" class="mb-[2px] size-4" />
            Back to Mixes
        </Link>
    </Button>
</AuthenticatedLayout>
