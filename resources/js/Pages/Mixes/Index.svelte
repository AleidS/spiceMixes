<script>
    // import { page, useForm } from '@inertiajs/svelte';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';
    import { router, page, Link, useForm } from '@inertiajs/svelte';
    import Button from '@/Components/Button.svelte';
    import MixesFilters from '@/Layouts/LayoutParts/MixesFilters.svelte';
    import autoAnimate from '@formkit/auto-animate';
    import Icon from '@iconify/svelte';
    export let mixes;
    export let measures;
    export let cuisines;
    export let selectedCuisineId;

    console.log(mixes);
</script>

<svelte:head>
    <title>Mixes</title>
</svelte:head>
<AuthenticatedLayout {cuisines} {selectedCuisineId} showFilter>
    <!-- <MixesFilters {cuisines} {selectedCuisineId} /> -->
    <!-- User ID: {$page.props.auth.user.id} -->
    <div class="m-auto mt-10 flex h-fit max-w-[950px]  flex-1 flex-wrap items-start justify-start gap-2 gap-y-10">
        <div class="flex w-full flex-row-reverse justify-between h-fit flex-wrap gap-2 ">
             <Link
                as="Button"
                href={route('mixes.create')}
                class="m-auto w-fit text-white hover:scale-105 hover:underline"
            >
                <Button class="w-fit text-nowrap !bg-primary-600 !text-white">
                    <Icon icon="mdi:plus-circle" class="mb-[2px] inline size-5" />
                    Add New Mix
                </Button>
            </Link>
            <h1 class="flex-1 text-left">Mixes</h1>
           
        </div>
        <div class="grid w-full grid-cols-1 gap-8 md:grid-cols-3  " use:autoAnimate>
            {#each mixes.data as mix}
                <Link href={route('mixes.show', mix.id)}>
                    <div
                        class="relative col-span-1 overflow-hidden rounded-lg border-[1px] border-uiGray-500 bg-uiDark-700 transition duration-200 ease-out hover:scale-105 hover:brightness-105 md:p-4"
                    >
                        <div
                            class="absolute bottom-0 left-0 w-full bg-primary-900 bg-opacity-10 p-4 text-center font-secondary text-3xl font-light text-white backdrop-blur-md backdrop-brightness-50"
                        >
                            {mix.name}
                        </div>

                        <div class="h-[300px] md:h-[180px] lg:h-[220px] overflow-hidden object-cover">
                            <img
                                src={mix.avatar}
                                alt="{mix.name}"
                                class="max-h-full min-h-full min-w-full max-w-full rounded-md object-cover object-center"
                            />
                        </div>
                    </div>
                </Link>
            {/each}
        </div>
    </div>
</AuthenticatedLayout>

<!-- <button onclick={deleteMix}>Delete Mix</button> -->
