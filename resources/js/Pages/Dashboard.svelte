<script>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';
</script>

<svelte:head>
    <title>Dashboard</title>
</svelte:head>

<AuthenticatedLayout>
    {#snippet header()}
        <h4 class="text-xl font-semibold leading-tight text-uiGray-800 dark:text-uiGray-200">
            Dashboard
        </h4>
    {/snippet}

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-uiGray-800">
                <div class="p-6 text-uiGray-900 dark:text-uiGray-100">You're logged in!</div>
            </div>
        </div>
    </div>
</AuthenticatedLayout>
