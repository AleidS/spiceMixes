<script>
    import Icon from '@iconify/svelte';
    import { page, useForm, router } from '@inertiajs/svelte';
    import FavoriteStar from './FavoriteStar.svelte';

    let { children, class: className, mix, ...attrs } = $props();
    let imgError = $state(false);
    function handleError() {
        imgError = true;
    }
</script>

<div
    class="z-1 group relative col-span-1 rounded-lg border-[1px] border-uiGray-500 bg-uiDark-700 pb-4 transition duration-200 ease-out hover:brightness-105"
>
    {#if mix.editable}
        <div
            class="r-0 absolute -right-2 top-0 z-20 -mt-2 mr-0 w-fit rounded-full {mix.user_id ==
            null
                ? 'bg-success-600'
                : 'bg-primary-600'} p-1 text-xl"
        >
            <Icon icon={mix.user_id == null ? 'mdi:people' : 'mdi:user'} />
        </div>
    {/if}
    <div class="!z-0 h-[300px] overflow-hidden rounded-md object-cover md:h-[180px] lg:h-[190px]">
        <!-- Try to load avatar if there should be one, if it doesnt load (no dimensions), show alternative. -->
        {#if !mix.avatar || imgError}
            <img
                src="/storage/pexels-martabranco-1340116.jpg"
                alt={mix.name}
                class="!-z-2 max-h-full min-h-full min-w-full max-w-full rounded-md object-cover object-center transition-transform duration-200 group-hover:scale-x-105 group-hover:scale-y-105"
            />
        {:else if mix.avatar}
            <img
                onerror={handleError}
                src={mix.avatar}
                alt={mix.name}
                class="!-z-2 max-h-full min-h-full min-w-full max-w-full object-cover object-center transition-transform duration-200 group-hover:scale-x-105 group-hover:scale-y-105"
            />
        {/if}
    </div>
    <div class="absolute left-2 top-1 my-auto scale-125"><FavoriteStar {mix} /></div>
    <div
        class="absolute bottom-0 left-0 z-0 w-full rounded-b-lg bg-primary-900 bg-opacity-10 p-4 text-center font-secondary text-xl font-light text-white backdrop-blur-md backdrop-brightness-50"
    >
        {mix.name}
    </div>
</div>
