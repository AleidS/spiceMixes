<script>
    let { children, class: className, mix, ...attrs } = $props();
</script>

<div
    class="z-1 group relative col-span-1 rounded-lg border-[1px] border-uiGray-500 bg-uiDark-700 transition duration-200 ease-out hover:brightness-105 md:p-4"
>
    {#if mix.editable}
        <div
            class="r-0 absolute -right-2 top-0 z-20 -mt-2 mr-0 w-fit rounded-md bg-primary-600 p-1 text-sm"
        >
            Your mix
        </div>
    {/if}
    <div class="!z-0 h-[300px] overflow-hidden object-cover md:h-[180px] lg:h-[220px]">
        {#if mix.avatar}
            <img
                src={mix.avatar}
                alt={mix.name}
                class="!-z-2 max-h-full min-h-full min-w-full max-w-full rounded-md object-cover object-center transition-transform duration-200 group-hover:scale-x-105 group-hover:scale-y-105"
            />
        {:else}
            <img
                src="/storage/pexels-martabranco-1340116.jpg"
                alt={mix.name}
                class="!-z-2 max-h-full min-h-full min-w-full max-w-full rounded-md object-cover object-center transition-transform duration-200 group-hover:scale-x-105 group-hover:scale-y-105"
            />
        {/if}
    </div>
    <div
        class="absolute bottom-0 left-0 z-0 w-full rounded-b-lg bg-primary-900 bg-opacity-10 p-4 text-center font-secondary text-3xl font-light text-white backdrop-blur-md backdrop-brightness-50"
    >
        {mix.name}
    </div>
</div>
