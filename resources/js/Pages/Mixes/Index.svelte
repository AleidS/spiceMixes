<script>
    // import { page, useForm } from '@inertiajs/svelte';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';
    import { router, page, Link, useForm } from '@inertiajs/svelte';
    import Button from '@/Components/Button.svelte';
    import MixesFilters from '@/Layouts/LayoutParts/MixesFilters.svelte';
    import MixCard from '@/Pages/Mixes/MixesComponents/MixCard.svelte';
    import autoAnimate from '@formkit/auto-animate';
    import Pagination from '@/Components/Pagination.svelte';
    import Icon from '@iconify/svelte';
    import TextInput from '@/Components/TextInput.svelte';
    import Input from '@/Components/Input.svelte';
    export let mixes;
    export let measures;
    export let cuisines;
    export let selectedCuisineId;
    export let is_own;
    export let show_favorites;
    export let search;
    export let pageNumber;
    import Switch from '@/Components/Switch.svelte';

    console.log(mixes);
    const updatedPageNumber = (page) => {
        pageNumber = page;
        applyFilter(true);
    };

    let cuisine_id = selectedCuisineId;
    let isOwn = is_own === 'true' ? true : false;
    let showFavorites = show_favorites === 'true' ? true : false;
    let searchTerm = search != false ? search : '';

    import { Tooltip } from '@svelte-plugins/tooltips';

    function applyFilter(newpage = false) {
        router.get(
            '/',
            {
                page: newpage ? pageNumber : 0,
                cuisine_id: cuisine_id,
                is_own: isOwn,
                show_favorites: showFavorites,
                filter: { name: searchTerm }
            },
            { preserveState: true, preserveScroll: true }
        );
    }
</script>

<svelte:head>
    <title>Mixes</title>
</svelte:head>
<AuthenticatedLayout {cuisines} {selectedCuisineId} showFilter class="z-0">
    <!-- <MixesFilters {cuisines} {selectedCuisineId} /> -->
    <!-- User ID: {$page.props.auth.user.id} -->

    <div
        class="z-1 relative m-auto mt-10 flex h-fit max-w-[950px] flex-1 flex-wrap items-start justify-start gap-2 gap-y-10 pb-16"
    >
        <div class="w-full">
            <div class="min-h-6 w-full text-uiDark-100">
                {cuisines.data?.find((cuisine) => cuisine.id == cuisine_id)?.name}
            </div>
            {#if $page.props.auth?.user?.is_admin}
                <div class="mb-4">
                    You are logged in as Admin. Mixes with green icons are public.
                </div>
            {/if}
            <div
                class="flex h-fit w-full flex-1 flex-wrap items-center justify-between gap-2 gap-y-6 px-2"
            >
                <h1 class="w-fit text-left">Mixes</h1>
                {#if $page.props.auth.user}
                    <Link
                        href={route('mixes.create')}
                        class="ml-auto w-fit text-white sm:order-1 sm:ml-0"
                    >
                        <Button class="w-fit text-nowrap !bg-primary-600 !text-white">
                            <Icon icon="mdi:plus-circle" class="mb-[3px] inline size-5" />
                            Add New Mix
                        </Button>
                    </Link>
                {/if}
                <div
                    class="-gap-2 order-1 flex w-full translate-x-2 items-stretch sm:order-none sm:w-fit"
                >
                    <TextInput
                        onkeydown={(event) => {
                            if (event.key === 'Enter') {
                                applyFilter();
                            }
                        }}
                        on:clear={applyFilter}
                        type="text"
                        bind:value={searchTerm}
                        placeholder="Search by name"
                        class="input !flex-1 rounded-l-full"
                    />

                    <Button
                        onclick={applyFilter}
                        class="z-10 my-[1px] -ml-2 -translate-x-4 scale-105 !rounded-full !bg-primary-600"
                        ><Icon icon="mdi:magnify" class="text-xl text-white" /></Button
                    >
                </div>
                {#if $page.props.auth.user}
                    <div class="group relative w-fit">
                        <div class="popup smallPopup">
                            {isOwn === false ? 'Show your mixes only' : 'Show all mixes'}
                        </div>

                        <Switch
                            text="Your mixes"
                            bind:checked={isOwn}
                            click={() => {
                                setTimeout(applyFilter, 100);
                            }}
                        ></Switch>
                    </div>

                    <div class="group relative w-fit">
                        <div
                            class="popup smallPopup !-top-4 !-translate-y-8 {showFavorites === true
                                ? '!top-0'
                                : ''}"
                        >
                            {showFavorites === false
                                ? 'Show your favorite mixes only'
                                : 'Show all mixes'}
                        </div>
                        <Switch
                            text="Your favorites"
                            bind:checked={showFavorites}
                            click={() => {
                                setTimeout(applyFilter, 100);
                            }}
                        ></Switch>
                    </div>
                {:else}
                    <Link href={route('mixes.create')} class="ml-auto w-fit text-white sm:ml-0">
                        <Button class="w-fit text-nowrap !bg-primary-600 !text-white">
                            Login or register to add your own!
                        </Button>
                    </Link>
                {/if}
            </div>
        </div>
        {#if mixes.data.length > 0}
            <div
                class="z-1 grid w-full grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3"
                use:autoAnimate
            >
                {#each mixes.data as mix (mix.id)}
                    <Link href={route('mixes.show', mix.id)}>
                        <MixCard {mix} />
                    </Link>
                {/each}
            </div>
        {:else}
            <span class="w-full text-center">Sorry! No mixes found.</span>
        {/if}
        <Pagination data={mixes} {updatedPageNumber} />
    </div>
</AuthenticatedLayout>

<!-- <button onclick={deleteMix}>Delete Mix</button> -->
