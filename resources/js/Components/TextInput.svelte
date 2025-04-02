<script>
    import { onMount } from 'svelte';
    let { class: className, value = $bindable(), clearable=true, ...attrs } = $props();

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

<div class='relative flex items-center'>
    <input
        {...attrs}
        class="rounded-md placeholder-uiDark-100 border-uiGray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 dark:border-uiGray-700 dark:bg-uiGray-900 dark:text-uiDark-100 dark:focus:border-secondary-600 dark:focus:ring-secondary-600 {className}"
        bind:value
        bind:this={input}
    />
    {#if clearable && value!=''}
    <button class='absolute my-auto right-3 text-lg text-primary-20 bg-uiDark-900' onclick={()=>{value=''}}>x</button>
    {/if}
</div>
