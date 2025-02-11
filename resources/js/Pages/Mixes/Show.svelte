<script>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';
    let { mix } = $props();
    import { router, page, Link } from '@inertiajs/svelte';
    import Button from '@/Components/Button.svelte';

    console.log(mix.data);
</script>

<svelte:head>
    <title>{mix.name}</title>
</svelte:head>

<AuthenticatedLayout>
    <div class="bg-uiDark-700 flex flex-col gap-6 rounded-lg p-8">
        <div>
            <h1 class="font-secondary text-3xl font-medium">
                {mix.data.name}
            </h1>
        </div>
        <div class="flex justify-between gap-6">
            <div class=" h-[250px] w-[300px] overflow-hidden object-cover">
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
                        <li>{ingredient.name}</li>
                    {/each}
                </ul>
            </div>
        </div>
        <p><strong>Description:</strong> {mix.data.description}</p>

        <p><strong>Cuisine:</strong> {mix.data.scuisine}</p>
    </div>

    <Link href={route('mixes.index')} class="text-blue-500 hover:underline">Back to Mixes</Link>
</AuthenticatedLayout>
