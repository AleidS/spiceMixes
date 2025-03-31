<script>
    // import { page, useForm } from '@inertiajs/svelte';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';
    import { router, page, Link, useForm } from '@inertiajs/svelte';
    import Button from '@/Components/Button.svelte';
    import MixesFilters from '@/Layouts/LayoutParts/MixesFilters.svelte';
    import MixCard from '@/Components/MixCard.svelte';
    import autoAnimate from '@formkit/auto-animate';
    import Pagination from '@/Components/Pagination.svelte';

    import Icon from '@iconify/svelte';
    export let mixes;
    export let measures;
    export let cuisines;
    export let selectedCuisineId;

    let pageSize = '10',
        pageNumber = 1,
        sections = [],
        checked = [],
        searchTerm = '',
        class_id = '',
        section_id = '',
        selectPage = false,
        selectAll = false;

    console.log(mixes);
    const updatedPageNumber = (page) => {
        pageNumber = page;
    };
</script>

<svelte:head>
    <title>Mixes</title>
</svelte:head>
<AuthenticatedLayout {cuisines} {selectedCuisineId} showFilter class="z-0">
    <!-- <MixesFilters {cuisines} {selectedCuisineId} /> -->
    <!-- User ID: {$page.props.auth.user.id} -->
    <div
        class="z-1 relative m-auto mt-10 flex h-fit max-w-[950px] flex-1 flex-wrap items-start justify-start gap-2 gap-y-10"
    >
        <div class="flex h-fit w-full flex-row-reverse flex-wrap justify-between gap-2">
            <Link href={route('mixes.create')} class="m-auto w-fit text-white">
                <Button class="w-fit text-nowrap !bg-primary-600 !text-white">
                    <Icon icon="mdi:plus-circle" class="mb-[3px] inline size-5" />
                    Add New Mix
                </Button>
            </Link>
            <h1 class="flex-1 text-left">Mixes</h1>
        </div>
        <div class="z-1 grid w-full grid-cols-1 gap-8 md:grid-cols-3" use:autoAnimate>
            {#each mixes.data as mix}
                <Link href={route('mixes.show', mix.id)}>
                    <MixCard {mix} />
                </Link>
            {/each}
        </div>
        <Pagination data={mixes} {updatedPageNumber} />
    </div>
</AuthenticatedLayout>

<!-- <button onclick={deleteMix}>Delete Mix</button> -->
