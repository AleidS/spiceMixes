<script>
    let {
        children,
        class: className,
        ghost = false,
        primary = false,
        disabled = false,
        outline = false,
        ...attrs
    } = $props();
</script>

<button
    {...attrs}
    {disabled}
    class="inline-flex items-center gap-1 rounded-lg border border-transparent bg-uiGray-800 px-4 py-2 font-secondary text-xs font-semibold tracking-widest transition duration-150 ease-in-out hover:brightness-110 focus:bg-uiGray-700 focus:outline-none focus:ring-2 focus:ring-secondary-400 focus:ring-offset-2 active:bg-uiGray-900 dark:bg-uiGray-200 dark:text-uiGray-800 dark:focus:ring-offset-uiGray-800 dark:active:bg-uiGray-300 {ghost
        ? `bg-none`
        : ``}
    {primary ? '!dark:bg-primary-500 !dark:text-white !bg-primary-600 !text-white' : ''} {outline
        ? '!dark:text-primary-50 !border-2  !border-primary-200 !bg-transparent !bg-none !text-white'
        : ''}{disabled ? ' !text-uiGray-300 !saturate-[50%]' : ''} {className}"
>
    {@render children()}
</button>
