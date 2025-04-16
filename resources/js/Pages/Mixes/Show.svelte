<script>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';

    import CalculatorComponent from './MixesComponents/calculator/CalculatorWrapper.svelte';
    import Icon from '@iconify/svelte';
    import { router, page, Link } from '@inertiajs/svelte';
    import Button from '@/Components/Button.svelte';
    import Switch from '@/Components/Switch.svelte';
    import FavoriteStar from '@/Pages/Mixes/MixesComponents/FavoriteStar.svelte';

    import ShareMix from '@/Pages/Mixes/MixesComponents/ShareMix.svelte';

    import Ingredient from './MixesComponents/Ingredient.svelte';

    import {
        calculateTotals,
        totalStr,
        multiplier,
        double,
        half,
        original,
        useOriginals,
        switchOriginals
    } from './MixesLogic/maths.svelte.js';
    let { mix, measures } = $props();
    original(mix, measures);
    calculateTotals(mix, measures);

    let newTotalStr = $state();
    totalStr.subscribe((value) => {
        newTotalStr = value;
    });
    let useOriginalsState = $state();
    useOriginals.subscribe((value) => {
        useOriginalsState = value;
    });

    let newMultiplier = $state(1);
    multiplier.subscribe((value) => {
        newMultiplier = value;
    });

    let calculator = $state(false);
    // Reactive statement to calculate totals
</script>

<svelte:head>
    <title>{mix.data.name}</title>
</svelte:head>

<AuthenticatedLayout>
    <div
        class="page flex cursor-auto flex-col gap-6"
        role="button"
        tabindex="0"
        onkeyup={() => {
            calculator = false;
        }}
        onclick={(calculator = false)}
    >
        <div class="flex w-full items-center justify-between">
            <Button class=" !bg-secondary-600 !text-uiGray-50 hover:bg-secondary-400 ">
                <Link href={route('home')} class="flex items-center gap-1 ">
                    <Icon icon="mdi:arrow-left-circle" class="mb-[2px] size-4" />
                    Back to Mixes
                </Link>
            </Button>
            {#if mix.data.editable}
                <Link href={route('mixes.edit', mix.data.id)}>
                    <Button primary>
                        <Icon icon="mdi:pencil" class="" />
                        Edit
                    </Button>
                </Link>
            {:else if $page.props.auth.user}
                <Link href={route('mixes.duplicate', mix.data.id)}>
                    <Button primary>
                        <Icon icon="mdi:pencil" class="" />
                        Duplicate & edit
                    </Button>
                </Link>
            {/if}
        </div>
        <div
            class="flex w-full justify-between {calculator
                ? 'pointer-events-none'
                : 'pointer-events-auto'}"
        >
            <h1 class="flex items-center gap-2 font-primary text-3xl font-medium">
                {mix.data.name}
                <FavoriteStar mix={mix.data} class="inline" />
            </h1>

            {#if mix.data.editable}
                <ShareMix {mix} />
            {/if}
        </div>
        <div class="flex flex-wrap justify-stretch gap-6 md:justify-between">
            <div
                class=" sm: relative h-[250px] w-full overflow-hidden object-cover sm:max-w-[300px] md:max-w-[300px]"
            >
                {#if mix.data.avatar}
                    <img
                        src={mix.data.avatar}
                        alt={mix.data.name}
                        class="max-h-full min-h-full min-w-full max-w-full rounded-md border border-uiGray-400 object-cover object-center"
                    />
                    {#if mix.data.img_source != '' && mix.data.img_source != null}
                        <a
                            href={`${mix.data.img_source}`}
                            target="_blank"
                            class="z-2 absolute bottom-[1px] left-[1px] rounded-md p-1 text-2xl backdrop-blur-sm hover:scale-105 hover:brightness-110"
                            ><Icon icon="mdi:link-variant" class="inline" />
                        </a>
                    {/if}
                {:else}
                    <img
                        src="/storage/pexels-martabranco-1340116.jpg"
                        alt="4 spoons with spices"
                        class="max-h-full min-h-full min-w-full max-w-full rounded-md border border-uiGray-400 object-cover object-center"
                    />
                {/if}
            </div>

            <div class="box flex flex-1 flex-col justify-between gap-y-4">
                <div class="flex w-full items-start justify-between">
                    <div>
                        <div class="flex items-center justify-start">
                            <h4>Ingredients:</h4>
                            &nbsp;
                            <div class="mb-1 inline text-center font-light text-uiDark-100">
                                {newMultiplier == 1
                                    ? ''
                                    : newMultiplier < 1
                                      ? `/ ${1 / newMultiplier}`
                                      : `* ${newMultiplier}`}
                            </div>
                        </div>
                        <ul class="relative">
                            {#each mix.data.ingredients.filter((ingredient) => !ingredient.optional) as ingredient}
                                <Ingredient {ingredient} {mix} {measures} />
                            {/each}

                            {#if mix.data.ingredients.filter((ingredient) => ingredient.optional).length > 0}
                                <div class="mb-1 mt-2"><strong>Optional:</strong></div>
                                {#each mix.data.ingredients.filter((ingredient) => ingredient.optional) as ingredient}
                                    <Ingredient {ingredient} {mix} {measures} />
                                {/each}
                            {/if}
                        </ul>
                    </div>

                    <button
                        class="rounded-lg border border-primary-400 p-1 text-white"
                        onclick={(event) => {
                            event.stopPropagation();
                            calculator = true;
                        }}><Icon icon="mdi:calculator" class="text-2xl" /></button
                    >
                </div>
                <div class="flex items-center gap-2">
                    {#if mix.data.ingredients.length > 0}
                        <Button
                            class="!rounded-full !bg-primary-600 !px-2 !py-1 !text-white"
                            onclick={(event) => {
                                event.stopPropagation();
                                half(mix, measures);
                            }}>half</Button
                        >

                        <Button
                            class="!rounded-full !bg-primary-600 !px-1 !py-1 !text-white"
                            onclick={(event) => {
                                event.stopPropagation();
                                double(mix, measures);
                            }}>double</Button
                        >
                        {#if newMultiplier != 1}
                            <Button
                                class="!rounded-full !bg-primary-600 !p-1 !text-white"
                                onclick={(event) => {
                                    event.stopPropagation();
                                    original(mix, measures);
                                }}><Icon icon="mdi:arrow-u-left-top" /></Button
                            >
                        {/if}
                    {/if}
                </div>
                <div class="-mb-2 mt-2 text-sm font-light">
                    <strong>Total</strong> (excl. weight measures) ≈
                    <span class="font-medium">
                        {newTotalStr}
                    </span>
                </div>
                <Switch
                    switchClass="!scale-75"
                    textClass="font-light text-sm"
                    text="Use original units"
                    bind:checked={useOriginalsState}
                    click={() => {
                        setTimeout(switchOriginals(), 100);
                    }}
                ></Switch>
            </div>
        </div>
        {#if mix.data?.description}
            <div class="box">
                <h4>Description</h4>
                <p>{mix.data?.description}</p>
            </div>
        {/if}

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

    {#if calculator}
        <CalculatorComponent on:close={() => (calculator = false)} />
    {/if}
</AuthenticatedLayout>
