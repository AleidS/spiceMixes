<script>
    export let checked ;
    export let color = '#2196F3';
    export let text = '';

    // https://svelte.dev/docs/svelte/v5-migration-guide Component events explains this 
    export let click;
    // import { createEventDispatcher } from 'svelte';
    // const dispatch = createEventDispatcher(); // Create an event dispatcher

    // // Emit a custom 'change' event whenever the state changes
    // $: dispatch('change', { checked });
</script>
<div class='flex items-center gap-2'>
    {text}
    
    <label class="switch">
        <input type="checkbox" bind:checked onclick={click(checked)}/>
        <span class="slider" />
    </label>
    
</div>
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;

        -webkit-transition: 0.4s;
        transition: 0.4s;
        border-radius: 34px;
        @apply bg-uiDark-200 hover:bg-uiDark-100;

    }

    .slider:before {
        position: absolute;
        content: '';
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: 0.4s;
        transition: 0.4s;
        border-radius: 50%;
    }

    input:checked + .slider {
        @apply bg-primary-600 hover:bg-primary-500;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }
</style>
