<script>
    let { children, class: className, type = 'button', ...attrs } = $props();
</script>

<button
    {...attrs}
    {type}
    class="border-uiGray-300 text-uiGray-700 hover:bg-uiGray-50 dark:border-uiGray-500 dark:bg-uiGray-800 dark:text-uiGray-300 dark:hover:bg-uiGray-700 dark:focus:ring-offset-uiGray-800 inline-flex items-center rounded-md border bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest shadow-sm transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 {className}"
>
    {@render children()}
</button>
