<script>
    import { createEventDispatcher } from 'svelte';
    import Icon from '@iconify/svelte';

    let {
        children,
        wrapperClass,
        labelClass,
        labelMobileOnly = false,
        class: className,
        label,
        error,
        type,
        value = $bindable(''),
        options,
        ...attrs
    } = $props();

    // You can use type = select (in which case, send a list of options with id and Name),
    //  textArea (large area), number, or text (possibly file)
</script>

<div
    class="label flex w-full max-w-full flex-wrap items-center gap-3
        lg:max-w-80 {wrapperClass}"
>
    {#if label}
        <div class="text-white {labelClass} {labelMobileOnly ? 'block lg:hidden' : ''}">
            {label}
        </div>
    {/if}
    {#if type == 'select'}
        <select {...attrs} bind:value class="inputClass {className}">
            {#each options as option}
                <option value={option.id}> {option.name}</option>
            {/each}
        </select>
    {:else if type == 'textArea'}
        <textarea
            bind:value
            {...attrs}
            class="inputClass w-full min-w-full h-fit{className}"
            rows="5"
        >
        </textarea>
    {:else if type == 'color'}
        <input
            {type}
            bind:value
            {...attrs}
            class="aspect-square h-7 w-7 !appearance-none rounded-none border border-white !p-0 !outline-none"
            style="background-color: {value ?? ''}!important;"
        />
    {:else}
        <input {type} bind:value {...attrs} class="inputClass {className}" />
    {/if}
</div>
{#if error}
    <div class="error text-danger-300">
        <Icon icon="tabler:exclamation-circle-filled" class="mb-[4px] inline size-4" />
        {error}
    </div>
{/if}
