<script>
    // import { page, useForm } from '@inertiajs/svelte';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';
    import { router, page, Link } from '@inertiajs/svelte';
    import Button from '@/Components/Button.svelte';
    export let mixes;
    console.log(mixes);
</script>

<svelte:head>
    <title>Mixes</title>
</svelte:head>
<AuthenticatedLayout>
    <!-- User ID: {$page.props.auth.user.id} -->
    <div class="m-auto flex max-w-[700px] flex-1 flex-wrap items-center gap-2 gap-y-4 pt-10">
        <h1 class="text-4xl font-semibold">Mixes</h1>
        <div class="grid w-full grid-cols-3">
            {#each mixes.data as mix}
                <Link href={route('mixes.show', mix.id)}>
                    <div
                        class="bg-primary-800 relative col-span-1 rounded-lg p-4 duration-100 hover:scale-105"
                    >
                        <div
                            class="absolute bottom-0 left-0 w-full p-4 text-center text-3xl font-bold text-white backdrop-blur-md backdrop-brightness-50"
                        >
                            {mix.name}
                        </div>

                        <div class="max-h-[300px] overflow-hidden">
                            <img src={mix.avatar} alt="none" class="w-full" />
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
            <Button class="!bg-primary-600 !text-white">Add New Mix</Button>
        </Link>
    </div>
</AuthenticatedLayout>

<!-- <button onclick={deleteMix}>Delete Mix</button> -->
