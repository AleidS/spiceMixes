<script>
    let { checked = $bindable(false), class: className, ...attrs } = $props();
</script>

<input
    {...attrs}
    type="checkbox"
    bind:checked
    class="border-uiGray-300 dark:border-uiGray-700 dark:bg-uiGray-900 dark:focus:ring-offset-uiGray-800 rounded text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 {className}"
/>
