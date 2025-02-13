<script>
    // import { page, useForm } from '@inertiajs/svelte';
    import { router, page, Link, useForm } from '@inertiajs/svelte';
    import Button from '@/Components/Button.svelte';
    export let mixes;
    export let cuisines;
    export let selectedCuisineId;

    function applyFilter(cuisine_id) {
        router.get('/mixes', { cuisine_id });
    }
</script>

<!-- <select class="bg-red-400" id="cuisine" bind:value={cuisine_id} on:change={applyFilter}>
        <option value="">All Cuisines</option> -->
<div
    class="items-between flex h-full max-h-[600px] w-5 flex-col justify-between overflow-hidden pb-2 pt-10 md:w-40"
>
    {#each cuisines.data as cuisine}
        <Button
            class="!bg-primary-600 h-12 origin-left rounded-l-none !text-white transition-transform duration-200 ease-in-out
                    {cuisine.id == selectedCuisineId
                ? 'scale-x-99 left-5 border border-l-0 border-white'
                : 'hover:scale-x-99 scale-x-95'}"
            style="background-color: {cuisine.color ?? ''}!important;"
            onclick={() => {
                applyFilter(cuisine.id);
            }}
            >{cuisine.name}
        </Button>
    {/each}
</div>
<!-- </select> -->

<!-- <button onclick={deleteMix}>Delete Mix</button> -->
