<script>
    let {
        children,
        wrapperClass,
        labelClass,
        class: className,
        label,
        error,
        type,
        options,
        ...attrs
    } = $props();
</script>

<div class="label flex items-center gap-3 {wrapperClass}">
    <div class="text-white {labelClass}">{label}</div>
    {#if type == 'select'}
        <select>
            {#each options as option}
                <option value={option.value}> {option}</option>
            {/each}
        </select>
    {:else}
        <input
            {type}
            {...attrs}
            class="bg-uiGray-800 hover:bg-uiGray-700 focus:bg-uiGray-700 active:bg-uiGray-900 dark:text-uiGray-800 dark:focus:ring-offset-uiGray-800 dark:active:bg-uiGray-300 inline-flex items-center rounded-md border border-transparent px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:bg-gray-50 dark:hover:bg-white dark:focus:bg-white {className}"
        />
    {/if}
</div>
{#if error}
    <div>{error}</div>
{/if}
