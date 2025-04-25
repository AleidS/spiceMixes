<script>
    import Icon from '@iconify/svelte';
    import {
        wholeAndFraction,
        multiplier,
        transformIngredient,
        useOriginals
    } from '../MixesLogic/maths.svelte';
    let { measures, ingredient } = $props();
    let multiplierValue = $state(1);
    multiplier.subscribe((value) => {
        multiplierValue = value;
    });

    let measureName = measures.data.find((measure) => measure.id == ingredient.measure_id)?.name;
</script>

<li class="grid list-none grid-cols-10">
    <input type="checkbox" class="checkbox col-span-1" />

    <!-- <span class="font-medium"> {wholeAndFraction(ingredient?.quantity * multiplierValue)}</span> -->
    <!-- Measure (tbs, ts, grams, cups etc) -->
    <!-- <span>
        {measureName}
    </span> -->
    <!-- Name -->
    <div class="col-span-9">
        {transformIngredient(ingredient?.quantity * multiplierValue, measureName)}
        <span> {ingredient?.name}</span>

        {#if ingredient?.alternatives?.dutch_name}
            <div class="group inline sm:relative">
                <div
                    class="inline-flex w-fit -translate-y-1 items-center justify-center rounded-full border border-uiDark-300 bg-uiDark-700 p-[4px] pt-1 text-[6pt] font-bold text-uiDark-100"
                >
                    <span> NL</span>
                </div>
                <div class="popup">
                    <span>
                        <strong>Dutch translation:</strong>
                        <br />{ingredient?.alternatives?.dutch_name ?? ''}</span
                    >
                </div>
            </div>
        {/if}
        {#if ingredient?.alternatives?.alternatives}
            <div class="group inline sm:relative">
                <div
                    class="inline-flex w-fit rounded-full border border-uiDark-300 bg-uiDark-700 p-[2px] text-sm font-bold text-uiDark-100"
                >
                    <div><Icon icon="mdi:swap-horizontal" class=" text-uiDark-50" /></div>
                </div>
                <div class="popup">
                    <strong>
                        Possible alternatives to {ingredient?.alternatives?.name}:<br /></strong
                    >
                    {ingredient?.alternatives?.alternatives ?? ''}
                    <div class="lh text-sm text-uiGray-200">
                        <br />
                        (Alternatives are not specific to this recipe, words like 'ground', 'powder'
                        and 'dried' are ignored)
                    </div>
                </div>
            </div>
        {/if}
    </div>
</li>
