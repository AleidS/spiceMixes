<script>
    // import { page, useForm } from '@inertiajs/svelte';
    import { router, page, Link, useForm } from '@inertiajs/svelte';
    import Button from '@/Components/Button.svelte';
    import Icon from '@iconify/svelte';
    export let mixes;
    export let cuisines;
    export let selectedCuisineId;
    import autoAnimate from '@formkit/auto-animate';
    
    let showFilters=false

    function applyFilter(cuisine_id) {
        router.get('/mixes', { cuisine_id });
    }
</script>

<!-- <select class="bg-red-400" id="cuisine" bind:value={cuisine_id} on:change={applyFilter}>
        <option value="">All Cuisines</option> -->
      <div  use:autoAnimate
      class='!z-99  w-full md:w-96 backdrop-blur-lg flex flex-col py-5 justify-end h-full {showFilters?'h-full':'h-fit pointer-events-none !w-fit backdrop-blur-none '}'>
          
     
           
        {#if showFilters}
        <div
        
            class="items-between backdrop-blur-lg flex flex-1 flex-col justify-between overflow-auto pb-2 pt-10 w-full md:w-96"
        >
      
            {#each cuisines.data as cuisine}
                <Button
               
                    class="h-16 max-h-full !text-lg origin-left rounded-l-none !bg-primary-600 !text-white transition-transform duration-200 ease-in-out
                                {cuisine.id == selectedCuisineId
                        ? 'scale-x-99 left-5 border border-l-0 border-white'
                        : 'hover:scale-x-99 scale-x-95'}"
                    style="background-color: {cuisine.color ?? ''}!important;"
                    onclick={() => {
                        showFilters=false
                        applyFilter(cuisine.id);
                    }}
                    >{cuisine.name}
                </Button>
            {/each}
        </div>
        {/if}
         <div class='pointer-events-auto !z-99 bg-primary-600 !cursor-pointer w-fit rounded-r-full p-2 pl-1 shadow-lg shadow-uiDark-500 flex items-center gap-2'>
          <button onclick={()=>{showFilters=!showFilters}} class=''>
                    <Icon icon='mdi:filter' class='size-10'/>
                     
                </button>
                {#if selectedCuisineId}
                <button
                class='px-3'
                 onclick={() => {
                            showFilters=false
                            applyFilter(null);
                        }}>
                X
                </button>
                {/if}
      </div>
      </div>
<!-- </select> -->

<!-- <button onclick={deleteMix}>Delete Mix</button> -->
