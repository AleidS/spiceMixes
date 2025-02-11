<script>
    let { value, children, class: className, ...attrs } = $props();
</script>

<label
    {...attrs}
    class="text-uiGray-700 dark:text-uiGray-300 block text-sm font-medium {className}"
>
    {#if value}
        <span>{value}</span>
    {:else if children}
        {@render children()}
    {/if}
</label>
