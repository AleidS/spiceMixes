<script>
    import { Link } from '@inertiajs/svelte';

    let { href = '#', children, ...attrs } = $props();
</script>

<Link
    {...attrs}
    {href}
    class="block w-full px-4 py-2 text-start text-sm leading-5 text-uiGray-700 transition duration-150 ease-in-out hover:bg-uiGray-100 focus:bg-uiGray-100 focus:outline-none dark:text-uiGray-300 dark:hover:bg-uiGray-800 dark:focus:bg-uiGray-800"
>
    {@render children()}
</Link>
