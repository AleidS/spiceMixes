<script>
    import ApplicationLogo from '@/Components/ApplicationLogo.svelte';
    import { inertia } from '@inertiajs/svelte';

    let { children } = $props();
</script>

<div
    class="bg-uiGray-100 dark:bg-uiGray-900 flex min-h-screen flex-col items-center pt-6 sm:justify-center sm:pt-0"
>
    <div>
        <a use:inertia href="/">
            <ApplicationLogo class="text-uiGray-500 h-20 w-20 fill-current" />
        </a>
    </div>

    <div
        class="dark:bg-uiGray-800 mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg"
    >
        {@render children()}
    </div>
</div>
