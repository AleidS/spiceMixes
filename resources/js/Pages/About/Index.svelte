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
    <div class="box m-auto mt-10 !max-w-[700px]">
        <h1>About</h1>
        <div class="mt-4 flex-1">
            <!-- <h4>Ingredients:</h4> -->
            <p>
                This website was made to try out Svelte/Laravel/Inertia, with Breeze for login
                functionality. I started with an empty setup and looked at
                <a
                    class="underline"
                    href="https://github.com/tapan288/inertia-svelte-students-management/blob/master/resources/js/Pages/Students/Index.svelte"
                    >this project</a
                >
                for guidance, and used some copilot help too:)

                <br /><br />Code can be found
                <a class="underline" href="https://github.com/AleidS/spiceMixes">here</a>.
                More info on this project (stack) is in the 
                <a
                    class="underline"
                    href="https://www.notion.so/Spicemixes-project-1d1bb3b2e78080ecb630c03ee0738bfc?pvs=4"
                    >Notion docs
                </a>.
                <br/><br/>
                The documentation on the combination of Svelte/Laravel is a bit sparse, so that might
                be a challenge if you're looking to make something similar.
            </p>
        </div>
    </div>
</AuthenticatedLayout>

<!-- <button onclick={deleteMix}>Delete Mix</button> -->
