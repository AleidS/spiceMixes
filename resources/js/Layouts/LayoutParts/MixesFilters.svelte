<script>
    // import { page, useForm } from '@inertiajs/svelte';
    import { router, page, Link, useForm } from '@inertiajs/svelte';
    import Button from '@/Components/Button.svelte';
    import Icon from '@iconify/svelte';
    export let mixes;
    export let cuisines;
    export let selectedCuisineId;
    export let is_own;
    export let search;
    export let pageNumber;
    import autoAnimate from '@formkit/auto-animate';
    // import { Tooltip } from '@svelte-plugins/tooltips';
    import { Tooltip, Button as FlowButton } from 'flowbite-svelte';

    let showFilters = false;

    // const url = new URL($page.url, window.location.origin); // Create a URL object
    let cuisine_id = selectedCuisineId;
    // let is_own = url.searchParams.get('is_own') =='true';
    // let search = url.searchParams.get('filter[name]') || '';
    // let pageNumber = parseInt(url.searchParams.get('page')) || 1;

    function applyFilter(cuisineId) {
        cuisine_id = cuisineId;
        router.get(
            '/',
            { page: pageNumber, cuisine_id: cuisineId, is_own: is_own, filter: { name: search } }
            // { preserveState: true, preserveScroll: true }
        );
    }

    console.log(cuisines);
</script>

<!-- <select class="bg-red-400" id="cuisine" bind:value={cuisine_id} on:change={applyFilter}>
        <option value="">All Cuisines</option> -->
<div
    use:autoAnimate
    class="!z-999 flex h-full w-full flex-col justify-end py-5 backdrop-blur-lg md:w-96 {showFilters
        ? 'h-full'
        : 'pointer-events-none h-fit !w-fit backdrop-blur-none '}"
>
    {#if showFilters}
        <!-- {#if true} -->
        <div
            class="items-between flex w-fit flex-1 flex-col flex-wrap justify-end gap-y-2 overflow-auto pb-2 pt-10 backdrop-blur-sm sm:gap-y-1"
        >
            <Button
                class="border-1 mb-4 h-fit max-h-full w-fit origin-left rounded-l-none rounded-r-full border-l-0 border-primary-500 !bg-uiDark-800 !bg-opacity-50 !text-lg !font-light !text-white transition-all duration-150 ease-in-out hover:pl-6
                                   "
                onclick={() => {
                    router.visit('/cuisines');
                }}
            >
                <Icon icon="mdi:pencil" />&nbsp; Manage cuisines
            </Button>
            {#each cuisines.data as cuisine}
                {#if cuisine.mixes_count > 0}
                    <Button
                        class="h-fit max-h-full w-fit origin-left rounded-l-none rounded-r-full !bg-primary-600 !text-lg !text-white transition-all duration-150 ease-in-out hover:pl-6
                                    {cuisine.id == selectedCuisineId
                            ? 'scale-x-99 left-5 border border-l-0 border-white'
                            : 'hover:scale-x-99 scale-x-95'}"
                        style="background-color: {cuisine.color ?? ''}!important;"
                        onclick={() => {
                            showFilters = false;
                            applyFilter(cuisine.id);
                        }}
                        >{cuisine.name}
                        <span class="text-xs">({cuisine.mixes_count})</span>
                    </Button>
                {/if}
            {/each}
        </div>
    {/if}
    <div
        class="!z-999 group pointer-events-auto relative flex w-fit !cursor-pointer items-center gap-2 rounded-r-full bg-primary-600 p-2 pl-1 shadow-lg shadow-uiDark-500"
    >
        <button
            onclick={() => {
                showFilters = !showFilters;
            }}
            class="flex w-fit items-center px-1"
        >
            <Icon icon="mdi:filter" class="size-10" />
            <span class="text-base">
                {#if selectedCuisineId}
                    {cuisines.data.find((mix) => mix.id == selectedCuisineId).name}
                {:else}
                    Cuisines &nbsp; &nbsp;
                {/if}
            </span>
        </button>

        {#if selectedCuisineId}
            <button
                onclick={(event) => {
                    event.preventDefault();
                    showFilters = false;
                    applyFilter(null);
                }}
                class=" flex aspect-square h-8 w-8 items-center justify-center rounded-full text-center"
            >
                <Icon icon="mdi:cross-circle" class="text-2xl" />
            </button>
        {/if}
        <div class="popup smallPopup">Filter mixes by cuisine</div>
    </div>
</div>
<!-- </select> -->

<!-- <button onclick={deleteMix}>Delete Mix</button> -->
