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
    class="rounded-md border-uiGray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 dark:border-uiGray-700 dark:bg-uiGray-900 dark:text-uiGray-300 dark:focus:border-secondary-600 dark:focus:ring-secondary-600 {className}"
    bind:value
    bind:this={input}
/>
