<script>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';

    let { mix, measures } = $props();
    import Icon from '@iconify/svelte';
    import { router, page, Link } from '@inertiajs/svelte';
    import Button from '@/Components/Button.svelte';
    import FavoriteStar from '@/Components/FavoriteStar.svelte';

    import ShareMix from '@/Components/ShareMix.svelte';
    let multiplier = $state(1);

    console.log(mix.data);
</script>

<svelte:head>
    <title>{mix.data.name}</title>
</svelte:head>

<AuthenticatedLayout>
    <div class="page flex flex-col gap-6">
        <div class="flex w-full justify-between">
            <h1 class="flex items-center gap-2 font-primary text-3xl font-medium">
                {mix.data.name}
                <FavoriteStar mix={mix.data} class="inline" />
                {#if mix.data.editable}
                    <ShareMix {mix} />
                {/if}
            </h1>

            <Link href={route('mixes.edit', mix.data.id)}>
                {#if mix.data.editable}
                    <Button primary>
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

            <div class="box flex flex-1 flex-col justify-between gap-y-4">
                <div>
                    <h4>Ingredients:</h4>
                    <ul class="relative">
                        {#each mix.data.ingredients as ingredient}
                            <li>
                                <input
                                    type="checkbox"
                                    class="mb-2 text-primary-500 checked:bg-primary-500 focus:ring-primary-500 active:bg-primary-500"
                                />
                                <span class="font-medium">
                                    {ingredient?.quantity * multiplier}</span
                                >
                                <!-- Measure (tbs, ts, grams, cups etc) -->
                                <span>
                                    {measures.data.find(
                                        (measure) => measure.id == ingredient.measure_id
                                    )?.name}
                                </span>
                                <!-- Name -->
                                <span> {ingredient?.name}</span>

                                {#if ingredient?.alternatives?.dutch_name}
                                    <div class="group inline-flex justify-center sm:relative">
                                        <div
                                            class="inline w-fit -translate-y-2 rounded-full bg-uiDark-50 p-[2px] text-[6pt] font-bold text-uiDark-600"
                                        >
                                            NL
                                        </div>
                                        <div
                                            class="absolute left-8 z-10 hidden w-40 translate-y-4 rounded-md bg-uiDark-400 p-4 group-hover:block sm:-right-8 sm:left-auto"
                                        >
                                            <span>
                                                <strong>Dutch translation:</strong>
                                                <br />{ingredient?.alternatives?.dutch_name ??
                                                    ''}</span
                                            >
                                        </div>
                                    </div>
                                {/if}
                                {#if ingredient?.alternatives?.alternatives}
                                    <div class="group inline sm:relative">
                                        <span
                                            ><Icon
                                                icon="material-symbols:swap-horizontal-circle-rounded"
                                                class="inline -translate-y-2 text-uiDark-50"
                                            /></span
                                        >
                                        <div
                                            class="absolute left-8 z-10 hidden w-64
                                            rounded-md bg-uiDark-400 p-4 group-hover:block sm:-left-20 sm:w-80"
                                        >
                                            <strong>
                                                Possible alternatives to {ingredient?.name}:<br
                                                /></strong
                                            >
                                            {ingredient?.alternatives?.alternatives ?? ''}
                                            <div class="lh text-sm text-uiGray-200">
                                                <br />
                                                (Alternatives are not specific to this recipe)
                                            </div>
                                        </div>
                                    </div>
                                {/if}
                            </li>
                        {/each}
                    </ul>
                </div>
                <div class="flex items-center gap-2">
                    {#if mix.data.ingredients.length > 0}
                        <Button
                            class="!rounded-full !bg-primary-600 !px-2 !py-1 !text-white"
                            onclick={() => {
                                multiplier = multiplier / 2;
                            }}>Give me half</Button
                        >
                        <div class="min-w-16 text-center">
                            {multiplier == 1 ? 'original' : `* ${multiplier}`}
                        </div>
                        <Button
                            class="!rounded-full !bg-primary-600 !px-1 !py-1 !text-white"
                            onclick={() => {
                                multiplier = multiplier * 2;
                            }}>Double</Button
                        >
                        {#if multiplier != 1}
                            <Button
                                class="!rounded-full !bg-primary-600 !p-1 !text-white"
                                onclick={() => {
                                    multiplier = 1;
                                }}><Icon icon="mdi:arrow-u-left-top" /></Button
                            >
                        {/if}
                    {/if}
                </div>
            </div>
        </div>
        <div class="box">
            <h4>Description</h4>
            <p>{mix.data?.description}</p>
        </div>

        <p><strong>Cuisine:</strong> {mix.data.cuisine.name}</p>
        {#if mix.data?.source_url}
            <p>
                <strong>Source(s):</strong>
                <a href={mix.data.source_url} class="underline">{mix.data?.source_name ?? 'link'}</a
                >
            </p>
        {:else if mix.data?.source_name}
            <strong>Source:</strong>{mix.data?.source_name}
        {/if}
    </div>

    <Button class="mt-3 !bg-secondary-600 !text-uiGray-50 hover:bg-secondary-400 ">
        <Link href={route('home')} class="flex items-center gap-1 ">
            <Icon icon="mdi:arrow-left-circle" class="mb-[2px] size-4" />
            Back to Mixes
        </Link>
    </Button>
</AuthenticatedLayout>
