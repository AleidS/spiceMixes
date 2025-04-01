<script>
    let { children, class: className, ghost = false, primary = false, ...attrs } = $props();
</script>

<button
    {...attrs}
    class="inline-flex items-center rounded-md border border-transparent bg-uiGray-800 px-4 py-2 font-secondary text-xs font-semibold tracking-widest transition duration-150 ease-in-out hover:brightness-110 focus:bg-uiGray-700 focus:outline-none focus:ring-2 focus:ring-secondary-400 focus:ring-offset-2 active:bg-uiGray-900 dark:bg-uiGray-200 dark:text-uiGray-800 dark:focus:ring-offset-uiGray-800 dark:active:bg-uiGray-300 {(ghost
        ? `bg-none`
        : ``,
    primary ? '!bg-primary-600 !text-white' : '')}{className} flex gap-1"
>
    {@render children()}
</button>
