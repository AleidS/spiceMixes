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
    let cuisine_id = selectedCuisineId
    // let is_own = url.searchParams.get('is_own') =='true';
    // let search = url.searchParams.get('filter[name]') || '';
    // let pageNumber = parseInt(url.searchParams.get('page')) || 1;
    

    function applyFilter(cuisineId) {
        cuisine_id=cuisineId
        router.get(
            '/',
            { page: pageNumber, cuisine_id: cuisineId, is_own: is_own, filter: { name: search } },
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
        class="!z-999 pointer-events-auto flex w-fit !cursor-pointer items-center gap-2 rounded-r-full bg-primary-600 p-2 pl-1 shadow-lg shadow-uiDark-500"
    >
           
            <FlowButton
                onclick={() => {
                    showFilters = !showFilters;
                }}
                class=""
            >
                <Icon icon="mdi:filter" class="size-10" />
            </FlowButton>
             <Tooltip class='bg-uiDark-500 !z-[999]'>
                Filter mixes by cuisine
            </Tooltip>
        
        {#if selectedCuisineId}
            {cuisines.data.find((mix) => mix.id == selectedCuisineId).name} mixes
            <button
                class="px-3"
                onclick={() => {
                    showFilters = false;
                    applyFilter(null);
                }}
            >
                X
            </button>
        {/if}
    </div>
</div>
<!-- </select> -->

<!-- <button onclick={deleteMix}>Delete Mix</button> -->
