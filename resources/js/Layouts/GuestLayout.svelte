<script>
    import ApplicationLogo from '@/Components/ApplicationLogo.svelte';
    import { inertia } from '@inertiajs/svelte';

    let { children } = $props();
</script>

<div
    class="flex min-h-screen flex-col items-center bg-uiGray-100 pt-6 sm:justify-center sm:pt-0 dark:bg-uiGray-900"
>
    <div>
        <a use:inertia href="/">
            <ApplicationLogo class="h-20 w-20 fill-current text-uiGray-500" />
        </a>
    </div>

    <div
        class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg dark:bg-uiGray-800"
    >
        {@render children()}
    </div>
</div>
