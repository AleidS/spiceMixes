<script>
    let { children, class: className, type = 'button', ...attrs } = $props();
</script>

<button
    {...attrs}
    {type}
    class="inline-flex items-center rounded-md border border-uiGray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-uiGray-700 shadow-sm transition duration-150 ease-in-out hover:bg-uiGray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 dark:border-uiGray-500 dark:bg-uiGray-800 dark:text-uiGray-300 dark:hover:bg-uiGray-700 dark:focus:ring-offset-uiGray-800 {className}"
>
    {@render children()}
</button>
