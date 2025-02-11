<script>
    // import { page, useForm } from '@inertiajs/svelte';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';
    import { router, page, Link, useForm } from '@inertiajs/svelte';
    import Button from '@/Components/Button.svelte';
    import MixesFilters from '@/Layouts/LayoutParts/MixesFilters.svelte';
    export let mixes;
    export let cuisines;
    export let selectedCuisineId;
    console.log(mixes);
    console.log(cuisines);
</script>

<svelte:head>
    <title>Mixes</title>
</svelte:head>
<AuthenticatedLayout>
    <MixesFilters {cuisines} {selectedCuisineId} />
    <!-- User ID: {$page.props.auth.user.id} -->
    <div class="m-auto mt-5 flex h-full max-w-[750px] flex-1 flex-wrap items-center gap-2 gap-y-10">
        <h1 class="font-primary w-full text-center text-4xl font-semibold md:text-left">Mixes</h1>
        <div class="grid w-full grid-cols-1 gap-8 md:grid-cols-3">
            {#each mixes.data as mix}
                <Link href={route('mixes.show', mix.id)}>
                    <div
                        class="bg-uiGray-700 border-uiGray-500 relative col-span-1 overflow-hidden rounded-lg border-[1px] transition duration-200 ease-out hover:scale-105 hover:brightness-105 md:p-4"
                    >
                        <div
                            class="font-secondary bg-primary-900 absolute bottom-0 left-0 w-full bg-opacity-10 p-4 text-center text-3xl font-thin text-white backdrop-blur-md backdrop-brightness-50"
                        >
                            {mix.name}
                        </div>

                        <div class="h-[250px] overflow-hidden object-cover">
                            <img
                                src={mix.avatar}
                                alt="none"
                                class="max-h-full min-h-full min-w-full max-w-full rounded-md object-cover object-center"
                            />
                        </div>
                    </div>
                </Link>
            {/each}
        </div>

        <Link
            as="Button"
            href={route('mixes.create')}
            class="m-auto text-white hover:scale-105 hover:underline"
        >
            <Button class="!bg-primary-600 font-primary !text-white">Add New Mix</Button>
        </Link>
    </div>
</AuthenticatedLayout>

<!-- <button onclick={deleteMix}>Delete Mix</button> -->
