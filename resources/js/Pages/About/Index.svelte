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
        <div class="box flex-1">
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

            <h4 class="mt-4">Code sources:</h4>
            <p>
                Pagination & some code reference: <br />
                <a
                    class="underline"
                    href="https://github.com/tapan288/inertia-svelte-students-management/blob/master/resources/js/Components/Pagination.svelte"
                    >Tapan288 Github project/tutorial</a
                >
            </p>
            <p>
                Switch
                <a
                    class="underline"
                    href="https://svelte.dev/playground/35d77f2ab11e4197a19ffd8e7c4ac74e?version=5.25.6"
                    >Svelte playground</a
                >
            </p>
            <h4 class="mt-4">Image sources:</h4>
            <p>
                Fallback image:
                <img
                    src="/storage/pexels-martabranco-1340116.jpg"
                    alt="3 spoons with various spices"
                    class="!-z-2 my-1 h-auto w-32 rounded-md object-cover object-center transition-transform duration-200 group-hover:scale-x-105 group-hover:scale-y-105"
                />
                <a
                    class="underline"
                    href="https://www.pexels.com/photo/four-assorted-spices-on-wooden-spoons-1340116/"
                    >Photo by Marta Branco from Pexels
                </a>
            </p>
        </div>
    </div>
</AuthenticatedLayout>

<!-- <button onclick={deleteMix}>Delete Mix</button> -->
