<script>
    // import { page, useForm } from '@inertiajs/svelte';
    import { router, page, Link, useForm } from '@inertiajs/svelte';
    import Button from '@/Components/Button.svelte';
    export let mixes;
    export let cuisines;
    export let selectedCuisineId;
    console.log(mixes);
    console.log(cuisines);

    function applyFilter(cuisine_id) {
        console.log(cuisine_id);
        router.get('/mixes', { cuisine_id });
    }
</script>

<div>
    <label for="cuisine">Filter by Cuisine:</label>

    <!-- <select class="bg-red-400" id="cuisine" bind:value={cuisine_id} on:change={applyFilter}>
        <option value="">All Cuisines</option> -->
    <div class="flex w-40 flex-col gap-3">
        {#each cuisines.data as cuisine}
            <Button
                class="!bg-primary-600 h-12 origin-left !text-white transition-transform duration-200 ease-in-out
                    {cuisine.id == selectedCuisineId
                    ? 'left-5 scale-x-105 border border-l-0 border-white'
                    : 'scale-x-100 hover:scale-x-105'}"
                style="background-color: {cuisine.color ?? ''}!important;"
                onclick={() => {
                    applyFilter(cuisine.id);
                }}
                >{cuisine.name}
            </Button>
        {/each}
    </div>
    <!-- </select> -->
</div>

<!-- <button onclick={deleteMix}>Delete Mix</button> -->
