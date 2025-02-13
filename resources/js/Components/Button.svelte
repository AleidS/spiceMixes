<script>
    let { children, class: className, ...attrs } = $props();
</script>

<button
    {...attrs}
    class="bg-uiGray-800 focus:bg-uiGray-700 active:bg-uiGray-900 dark:bg-uiGray-200 dark:text-uiGray-800 dark:focus:ring-offset-uiGray-800 dark:active:bg-uiGray-300 focus:ring-secondary-400 inline-flex items-center rounded-md border border-transparent px-4 py-2 text-xs font-semibold tracking-widest transition duration-150 ease-in-out hover:brightness-110 focus:outline-none focus:ring-2 focus:ring-offset-2 {className}"
>
    {@render children()}
</button>
