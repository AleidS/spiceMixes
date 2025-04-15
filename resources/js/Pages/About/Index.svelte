<script>
    // import { page, useForm } from '@inertiajs/svelte';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';
    export let mixes;
    export let measures;
    export let cuisines;
    export let selectedCuisineId;
</script>

<svelte:head>
    <title>About</title>
</svelte:head>
<AuthenticatedLayout {cuisines} {selectedCuisineId} class="z-0">
    <!-- <MixesFilters {cuisines} {selectedCuisineId} /> -->
    <!-- User ID: {$page.props.auth.user.id} -->
    <div class="page m-auto mt-10 !max-w-[700px]">
        <h1>About</h1>
        <div class="flex-1">
            <!-- <h4>Ingredients:</h4> -->
            <p>
                This website was made to try out Svelte/Laravel/Inertia, with Breeze for login
                functionality. I started with an empty setup and looked at
                <a
                    class="underline"
                    href="https://github.com/tapan288/inertia-svelte-students-management/blob/master/resources/js/Pages/Students/Index.svelte"
                    >this project</a
                >
                for guidance, and used a lot of copilot help:)

                <br /><br />Code can be found
                <a class="underline" href="https://github.com/AleidS/spiceMixes">here</a>. Feel free
                to adapt it for your own project. If you want to start a similar project from
                scratch, here is a
                <a
                    class="underline"
                    href="https://github.com/AleidS/spiceMixes/blob/main/how_to_set_up_svelte_laravel_breeze_inertia_project.docx"
                    >how-to.
                </a>
                The documentation on the combination of Svelte/Laravel is a bit sparse, so that might
                be a challenge.
            </p>
        </div>
    </div>
</AuthenticatedLayout>

<!-- <button onclick={deleteMix}>Delete Mix</button> -->
