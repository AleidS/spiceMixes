<script>
    // import { page, useForm } from '@inertiajs/svelte';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';
</script>

<svelte:head>
    <title>Contact</title>
</svelte:head>
<AuthenticatedLayout class="z-0">
    <!-- <MixesFilters {cuisines} {selectedCuisineId} /> -->
    <!-- User ID: {$page.props.auth.user.id} -->
    <div class="box m-auto mt-10 !max-w-[700px]">
        <h1>Contact</h1>
        <div class="flex-1">
            <!-- <h4>Ingredients:</h4> -->
            <p>
                For questions, remarks and suggestions, please email me at;
                <a class="underline" href="mailto:aleidoonk@gmail.com">aleidoonk@gmail.com</a>
            </p>
        </div>
    </div>
</AuthenticatedLayout>

<!-- <button onclick={deleteMix}>Delete Mix</button> -->
