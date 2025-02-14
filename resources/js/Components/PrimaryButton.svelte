<script>
    let { children, class: className, ...attrs } = $props();
</script>

<button
    {...attrs}
    class="inline-flex items-center rounded-md border border-transparent bg-uiGray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-uiGray-700 focus:bg-uiGray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-uiGray-900 dark:bg-uiGray-200 dark:text-uiGray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-uiGray-800 dark:active:bg-uiGray-300 {className}"
>
    {@render children()}
</button>
