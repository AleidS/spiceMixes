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
    let imgError = $state(false);
    function handleError() {
        imgError = true;
    }

    // Reactive statement to calculate totals
</script>

<svelte:head>
    <title>{mix?.data?.name ?? 'mix'}</title>
</svelte:head>

<AuthenticatedLayout>
    <div
        class="page flex cursor-auto flex-col gap-6"
        role="button"
        tabindex="0"
        onkeyup={() => {
            calculator = false;
        }}
        onclick={() => {
            calculator = false;
        }}
    >
        <div class="flex w-full items-center justify-between gap-6 px-2">
            <Button class=" !bg-secondary-600 !text-uiGray-50 hover:bg-secondary-400 ">
                <Link href={route('home')} class="flex items-center gap-1 ">
                    <Icon icon="mdi:arrow-left-circle" class="mb-[2px] size-4" />
                    Back to Mixes
                </Link>
            </Button>
            {#if mix.data.editable}
                <Link href={route('mixes.edit', mix.data.id)}>
                    <Button
                        primary={mix.data.user_id == null ? 'false' : 'true'}
                        class={mix.data.user_id == null ? '!bg-success-600' : 'bg-primary-600'}
                    >
                        <Icon icon="mdi:pencil" class="" />
                        Edit {mix.data.user_id == null ? 'for everyone' : ''}
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
            class="flex w-full flex-wrap justify-between px-2 {calculator
                ? 'pointer-events-none'
                : 'pointer-events-auto'}"
        >
            <h1 class="flex w-full items-center gap-2 font-primary text-3xl font-medium sm:w-fit">
                {mix.data.name}
                <span class="hidden items-center sm:flex">
                    <FavoriteStar mix={mix.data} class="inline" /></span
                >
                {#if !mix.data.editable}
                    <span class=" flex items-center sm:hidden">
                        <FavoriteStar mix={mix.data} /></span
                    >
                {/if}
            </h1>

            <div class="flex w-fit items-end">
                {#if mix.data.editable}
                    <span class="flex items-center sm:hidden">
                        <FavoriteStar mix={mix.data} /></span
                    >
                    <ShareMix {mix} class="mt-2" />
                {/if}
            </div>
        </div>
        <div class="flex flex-wrap items-stretch justify-stretch gap-6 md:justify-between">
            <div
                class="relative max-h-[250px] !w-full !min-w-[calc(min(400px,100%))] flex-1 overflow-hidden rounded-md border border-uiGray-400 object-cover sm:max-h-[700px] md:max-w-[500px]"
            >
                {#if !mix.data.avatar || imgError}
                    <img
                        src="/storage/pexels-martabranco-1340116.jpg"
                        alt="4 spoons with spices"
                        class="max-h-full min-h-full w-full min-w-full max-w-full overflow-hidden rounded-md object-cover object-center"
                    />
                    <a
                        href={`https://www.pexels.com/photo/four-assorted-spices-on-wooden-spoons-1340116/`}
                        target="_blank"
                        class="z-2 absolute bottom-[0px] left-[0px] rounded-tr-md p-1 text-base font-light backdrop-blur-sm backdrop-brightness-50 hover:scale-105 hover:brightness-110"
                        >Fallback<Icon icon="mdi:link-variant" class="inline" />
                    </a>
                {:else if mix.data.avatar && !imgError}
                    <img
                        onerror={handleError}
                        src={mix.data.avatar}
                        alt={mix.data.name}
                        class="max-h-full min-h-full min-w-full max-w-full overflow-hidden rounded-md object-cover object-center"
                    />
                    {#if mix.data.img_source != '' && mix.data.img_source != null}
                        <a
                            href={`${mix.data.img_source}`}
                            target="_blank"
                            class="z-2 absolute bottom-[0px] left-[0px] rounded-tr-md p-1 text-base font-light backdrop-blur-sm backdrop-brightness-50 hover:scale-105 hover:brightness-110"
                            >src <Icon icon="mdi:link-variant" class="inline" />
                        </a>
                    {/if}
                {/if}
            </div>

            <div
                class="box flex min-w-[calc(min(400px,100%))] flex-1 flex-col justify-between gap-y-4"
            >
                <div class="flex w-full items-start justify-between">
                    <div class="w-full">
                        <div class="flex w-full flex-1 items-start justify-between py-4">
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
                            <button
                                class="rounded-lg border border-primary-400 p-1 text-white"
                                onclick={(event) => {
                                    event.stopPropagation();
                                    calculator = true;
                                }}><Icon icon="mdi:calculator" class="text-2xl" /></button
                            >
                        </div>
                        <ul class="leading-0 relative ml-0 w-fit list-none">
                            {#each mix.data.ingredients.filter((ingredient) => ingredient.optional == 0 || ingredient.optional == '0') as ingredient}
                                <Ingredient {ingredient} {mix} {measures} />
                            {/each}

                            {#if mix.data.ingredients.filter((ingredient) => ingredient.optional == 1 || ingredient.optional == '1').length > 0}
                                <div class="mb-1 mt-2"><strong>Optional:</strong></div>
                                {#each mix.data.ingredients.filter((ingredient) => ingredient.optional == 1 || ingredient.optional == '1') as ingredient}
                                    <Ingredient {ingredient} {mix} {measures} />
                                {/each}
                            {/if}
                        </ul>
                    </div>
                </div>
                {#if mix.data.ingredients.length > 0}
                    <div class="flex items-center gap-2">
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
                    ></Switch>{/if}
            </div>
        </div>
        {#if mix.data?.description}
            <div class="box">
                <h4>Description</h4>
                <p class="flex flex-col gap-1">{@html mix.data?.description}</p>
            </div>
        {/if}

        <div class="px-4">
            <p><strong>Cuisine:</strong> {mix.data.cuisine.name}</p>
            {#if mix.data?.source_url}
                <p>
                    <strong>Source(s):</strong>
                    <a href={mix.data.source_url} class="underline"
                        >{mix.data?.source_name ?? 'link'}</a
                    >
                </p>
            {:else if mix.data?.source_name}
                <strong>Source:</strong>{mix.data?.source_name}
            {/if}
        </div>

        {#if $page.props.auth.user && mix.data?.share_mix == true}
            <div class="px-4">
                <p>
                    <strong class="mb-2">Share status: <br /></strong>

                    Thank you for submitting your mix for sharing on the homepage! The status is:
                    <br />
                    {#if mix.data?.share_accepted == true}
                        <strong>Accepted!</strong> Thank you for contributing to tastier cooking for
                        all:) You should be able to find a public mix with this name now.
                    {:else if mix.data?.share_accepted == false}
                        <strong>Denied.</strong> Sorry! Maybe next time:)
                        {#if mix.data?.share_decline_reason}
                            <br />
                            <strong>Reason given:</strong>
                            {mix.data.share_decline_reason}
                        {/if}
                    {:else}
                        <strong>Under review!</strong> Please be patient:)
                    {/if}
                </p>
            </div>
        {/if}
    </div>

    {#if calculator}
        <CalculatorComponent on:close={() => (calculator = false)} />
    {/if}
</AuthenticatedLayout>
