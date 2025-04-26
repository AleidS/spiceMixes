<script>
    // import { page, useForm } from '@inertiajs/svelte';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';
    export let mixes;
    export let measures;
    export let cuisines;
    export let selectedCuisineId;
</script>

<svelte:head>
    <title>Sources</title>
</svelte:head>
<AuthenticatedLayout {cuisines} {selectedCuisineId} class="z-0">
    <!-- <MixesFilters {cuisines} {selectedCuisineId} /> -->
    <!-- User ID: {$page.props.auth.user.id} -->
    <div class="box m-auto mt-10 !max-w-[700px]">
        <h1>Sources</h1>
        <div class="flex flex-1 flex-col gap-y-4">
            <!-- <h4>Ingredients:</h4> -->

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
            <p>
                Calculator:
                <a
                    class="underline"
                    href="https://svelte.dev/playground/e71f42a349af4ea2996b9552dd2e98fb?version=5.26.3"
                    >Svelte playground</a
                >
            </p>
            <div>
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
    </div>
</AuthenticatedLayout>

<!-- <button onclick={deleteMix}>Delete Mix</button> -->
