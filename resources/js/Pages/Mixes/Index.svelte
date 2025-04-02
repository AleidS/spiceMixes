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
    export let is_own;
    export let search;
    export let pageNumber;
    import Switch from '@/Components/Switch.svelte';
    import { onMount } from 'svelte';

    let pageSize = '10',
        sections = [],
        checked = [],
        
        class_id = '',
        section_id = '',
        selectPage = false,
        selectAll = false;

    console.log(mixes);
    const updatedPageNumber = (page) => {
        pageNumber = page;
    };

    // const url = new URL($page.url, window.location.origin); // Create a URL object
    let cuisine_id = selectedCuisineId;
    let isOwn = is_own ==='true'?true:false
    let searchTerm =search!=false?search:''
    // let is_own = url.searchParams.get('is_own') === true;
    // let search = url.searchParams.get('filter[name]') || '';
    // let pageNumber = parseInt(url.searchParams.get('page')) || 1;
    

    function applyFilter() {
        router.get(
            '/',
            { page: pageNumber, cuisine_id: cuisine_id, is_own: isOwn, filter: { name: searchTerm } },
            // { preserveState: true, preserveScroll: true }
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
            class="z-1 relative m-auto mt-10 flex h-fit max-w-[950px] flex-1 flex-wrap items-start justify-start gap-2 gap-y-10"
        >
        <div class='w-full'>
            <div class='w-full min-h-6 text-uiDark-100'>  
                {cuisines.data.find((cuisine)=>cuisine.id==cuisine_id)?.name}
            </div>
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
                        bind:value={searchTerm}
                        placeholder="Search by name"
                        class="input"
                    />
                    <Button primary onclick={applyFilter}><Icon icon="mdi:magnify" /></Button>
                </div>
                <Switch text='Your mixes' bind:checked={isOwn} click={()=>{setTimeout(applyFilter,100)}}></Switch>
                <Link href={route('mixes.create')} class="ml-auto w-fit text-white sm:ml-0">
                    <Button class="w-fit text-nowrap !bg-primary-600 !text-white">
                        <Icon icon="mdi:plus-circle" class="mb-[3px] inline size-5" />
                        Add New Mix
                    </Button>
                </Link>
            </div>
        </div>
         {#if mixes.data.length>0}
        <div class="z-1 grid w-full grid-cols-1 gap-8 md:grid-cols-3" use:autoAnimate>
            {#each mixes.data as mix}
                <Link href={route('mixes.show', mix.id)}>
                    <MixCard {mix} />
                </Link>
            {/each}
        </div>  
        {:else}
            <span class='w-full text-center'>Sorry! No mixes found.</span>
            {/if}
        <Pagination data={mixes} {updatedPageNumber} />
    </div>
</AuthenticatedLayout>

<!-- <button onclick={deleteMix}>Delete Mix</button> -->
