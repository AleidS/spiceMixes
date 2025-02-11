<script>
    import { onMount } from 'svelte';
    let { class: className, value = $bindable(), ...attrs } = $props();

    let input;

    export function focus() {
        input?.focus();
    }

    onMount(() => {
        if (attrs.autofocus && input) {
            input.focus();
        }
    });
</script>

<input
    {...attrs}
    class="border-uiGray-300 dark:border-uiGray-700 dark:bg-uiGray-900 dark:text-uiGray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-600 dark:focus:ring-indigo-600 {className}"
    bind:value
    bind:this={input}
/>
