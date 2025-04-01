<script>
    // import { page, useForm } from '@inertiajs/svelte';
    import { router, page, Link, useForm } from '@inertiajs/svelte';
    import Button from '@/Components/Button.svelte';
    import Icon from '@iconify/svelte';
    export let mixes;
    export let cuisines;
    export let selectedCuisineId;
    import autoAnimate from '@formkit/auto-animate';

    let showFilters = false;

    function applyFilter(cuisine_id) {
        router.get('/', { cuisine_id });
    }
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
                </Button>
            {/each}
        </div>
    {/if}
    <div
        class="!z-999 pointer-events-auto flex w-fit !cursor-pointer items-center gap-2 rounded-r-full bg-primary-600 p-2 pl-1 shadow-lg shadow-uiDark-500"
    >
        <button
            onclick={() => {
                showFilters = !showFilters;
            }}
            class=""
        >
            <Icon icon="mdi:filter" class="size-10" />
        </button>
        {#if selectedCuisineId}
            {cuisines.data[selectedCuisineId].name} mixes
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
