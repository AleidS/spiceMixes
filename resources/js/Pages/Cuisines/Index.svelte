<script>
    // import { page, useForm } from '@inertiajs/svelte';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';
    import { router, page, Link, useForm } from '@inertiajs/svelte';
    import Icon from '@iconify/svelte';
    import AddCuisineDialog from './CuisinesComponents/AddCuisineDialog.svelte';
    import Switch from '@/Components/Switch.svelte';
    import Button from '@/Components/Button.svelte';
    export let cuisines;
    export let totalCreatedCuisines;
    let showDialog = false;
    let cuisineObj = null;
</script>

<svelte:head>
    <title>Cuisines</title>
</svelte:head>
<AuthenticatedLayout class="z-0">
    <!-- <MixesFilters {cuisines} {selectedCuisineId} /> -->
    <!-- User ID: {$page.props.auth.user.id} -->

    <div
        class="z-1 relative m-auto mt-10 flex h-fit max-w-[950px] flex-1 flex-wrap items-start justify-start gap-2 gap-y-10 py-10"
    >
        <div class="w-full">
            <div
                class=" h-fit w-full flex-1 flex-wrap items-center justify-between gap-2 gap-y-6 px-2"
            >
                <h1 class="mb-4 w-fit text-left">Manage your cuisines</h1>
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    {#if $page.props.auth.user}
                        <div class="box">
                            <h3>Public cuisines</h3>
                            <div class="flex-col flex-wrap gap-2">
                                {#each cuisines.data.filter((cuisine) => cuisine.user_id == null) as cuisine}
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="mb-1 inline h-fit max-h-full w-fit origin-left text-nowrap rounded-none !bg-primary-600 p-2 !text-lg !text-white"
                                            style="background-color: {cuisine.color ??
                                                ''}!important;"
                                        ></div>
                                        {cuisine.name}
                                    </div>
                                {/each}
                            </div>
                        </div>
                        <div class="box">
                            <h3>Your cuisines ({totalCreatedCuisines} out of max 10)</h3>
                            <div class="items-between flex h-full flex-col justify-between pb-8">
                                <div class="flex-col flex-wrap gap-2">
                                    {#each cuisines.data.filter((cuisine) => cuisine.user_id != null) as cuisine}
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="mb-1 inline h-fit max-h-full w-fit origin-left text-nowrap rounded-none !bg-primary-600 p-2 !text-lg !text-white"
                                                style="background-color: {cuisine.color ??
                                                    ''}!important;"
                                            ></div>
                                            {cuisine.name}
                                            <button
                                                onclick={() => {
                                                    cuisineObj = cuisine;
                                                    showDialog = !showDialog;
                                                }}
                                                class="flex w-fit gap-1 !bg-transparent !bg-opacity-100 px-0 !text-white outline-2 !outline-uiDark-200"
                                            >
                                                <Icon
                                                    icon="mdi:pencil"
                                                    class="mb-[2px]  !text-lg text-white"
                                                />
                                            </button>
                                        </div>
                                    {/each}
                                </div>

                                <button
                                    onclick={() => {
                                        cuisineObj = null;
                                        showDialog = !showDialog;
                                    }}
                                    class="flex w-fit gap-1 !bg-transparent !bg-opacity-100 px-0 !text-white outline-2 !outline-uiDark-200"
                                >
                                    <Icon
                                        icon="mdi:plus-circle"
                                        class="mb-[2px]  !text-lg text-success-400"
                                    />
                                    Add new Cuisine</button
                                >
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <!-- <Switch /> -->
                            <div class="">Note: Only cuisines with mixes are shown on homepage</div>
                        </div>
                    {/if}
                </div>
                <Button
                    class="mt-10 w-fit !bg-secondary-600 !text-uiGray-50 hover:bg-secondary-400"
                >
                    <Link href={route('home')} class="flex items-center gap-1 ">
                        <Icon icon="mdi:arrow-left-circle" class="mb-[2px] size-4" />
                        Back to Mixes
                    </Link>
                </Button>
            </div>
        </div>
    </div></AuthenticatedLayout
>

{#if showDialog}
    <AddCuisineDialog cuisine={cuisineObj} />
{/if}

<!-- <button onclick={deleteMix}>Delete Mix</button> -->
