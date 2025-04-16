<script>
    import Calculator from '@/Pages/Mixes/MixesComponents/calculator/Calculator.svelte';
    import Icon from '@iconify/svelte';
    import Button from '@/Components/Button.svelte';
    import Draggable from '@/Pages/Mixes/MixesComponents/calculator/Draggable.svelte';
    import { createEventDispatcher } from 'svelte';
    const dispatch = createEventDispatcher();
    let unitConversions = $state(false);
</script>

<div
    class="w-xl h-xl pointer-events-none fixed bottom-0 left-0 top-0 z-40 m-auto flex h-full w-full flex-wrap items-center justify-center gap-2 bg-transparent backdrop-saturate-0"
    open
>
    <Draggable>
        <div
            class="absolute -left-2 -top-2 hidden rounded-full bg-uiDark-300 p-1 text-2xl !text-white md:block"
        >
            <Icon icon="fluent:arrow-move-24-regular" />
        </div>
        <div class="flex h-fit w-fit flex-wrap items-center justify-center gap-2">
            <div class="pointer-events-auto flex flex-col items-center justify-center gap-2">
                <div class="flex w-full justify-end">
                    <Button
                        onclick={() => {
                            // Emit a custom event to notify the parent to close the calculator
                            dispatch('close');
                        }}>X</Button
                    >
                </div>
                <Calculator class="!pointer-events-auto" />

                <Button
                    onclick={(event) => {
                        event.stopPropagation();
                        unitConversions = !unitConversions;
                    }}>Show Unit conversions</Button
                >
            </div>
            {#if unitConversions}
                <div class="flex h-fit flex-col items-center gap-2 rounded-md bg-uiDark-400 p-4">
                    <ul>
                        <li>1 cup = 16 tbs or 240 ml</li>
                        <li>1 tbsp (Tablespoon) = 3 ts or 15 ml</li>
                        <li>1 ts (Teaspoon) = 5 ml</li>
                        <li>1 pinch is around 1/16 teaspoon</li>
                    </ul>
                </div>
            {/if}
        </div>
    </Draggable>
</div>
