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
    import TextInput from '@/Components/TextInput.svelte';
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

    let search = '';

    function applyFilter() {
        router.get('/', { filter: { name: search } });
    }
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
        <div class="flex h-fit w-full flex-1 flex-wrap justify-between gap-2 gap-y-4">
            <h1 class="w-fit text-left">Mixes</h1>
            <div class="flex items-stretch gap-2">
                <TextInput
                    onkeydown={(event) => {
                        if (event.key === 'Enter') {
                            applyFilter();
                        }
                    }}
                    type="text"
                    bind:value={search}
                    placeholder="Search by name"
                    class="input"
                />
                <Button primary onclick={applyFilter}><Icon icon="mdi:magnify" /></Button>
            </div>
            <Link href={route('mixes.create')} class="ml-auto w-fit text-white sm:ml-0">
                <Button class="w-fit text-nowrap !bg-primary-600 !text-white">
                    <Icon icon="mdi:plus-circle" class="mb-[3px] inline size-5" />
                    Add New Mix
                </Button>
            </Link>
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
