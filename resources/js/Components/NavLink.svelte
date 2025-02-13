<script>
    import { Link } from '@inertiajs/svelte';

    let { active = false, children, href, ...attrs } = $props();
</script>

<Link
    {...attrs}
    {href}
    class={active
        ? 'border-primary-400 focus:border-primary-700 dark:border-primary-600 dark:text-ui-100 text-ui-900 inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none'
        : 'focus:text-ui-700 focus:border-ui-300 hover:text-ui-700 text-ui-500 dark:text-ui-400 hover:border-ui-300 dark:hover:text-ui-300 dark:hover:border-ui-700 dark:focus:border-ui-700 dark:focus:text-ui-300 inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none'}
>
    <h2 class="mb-0">{@render children()}</h2>
</Link>
