<script>
    import { Link } from '@inertiajs/svelte';

    let { active = false, children, href, ...attrs } = $props();
</script>

<Link
    {...attrs}
    {href}
    class={active
        ? 'block w-full border-l-4 border-indigo-400 bg-indigo-50 py-2 pe-4 ps-3 text-start text-base font-medium text-indigo-700 transition duration-150 ease-in-out focus:border-indigo-700 focus:bg-indigo-100 focus:text-indigo-800 focus:outline-none dark:border-indigo-600 dark:bg-indigo-900/50 dark:text-indigo-300 dark:focus:border-indigo-300 dark:focus:bg-indigo-900 dark:focus:text-indigo-200'
        : 'block w-full border-l-4 border-transparent py-2 pe-4 ps-3 text-start text-base font-medium text-uiGray-600 transition duration-150 ease-in-out hover:border-uiGray-300 hover:bg-uiGray-50 hover:text-uiGray-800 focus:border-uiGray-300 focus:bg-uiGray-50 focus:text-uiGray-800 focus:outline-none dark:text-uiGray-400 dark:hover:border-uiGray-600 dark:hover:bg-uiGray-700 dark:hover:text-uiGray-200 dark:focus:border-uiGray-600 dark:focus:bg-uiGray-700 dark:focus:text-uiGray-200'}
>
    {@render children()}
</Link>
