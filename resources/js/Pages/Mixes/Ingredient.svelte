<script>
    import Icon from '@iconify/svelte';
    import { wholeAndFraction, multiplier } from './maths.svelte';

    import { writable, get } from 'svelte/store';

    let { mix, measures, ingredient } = $props();
    let multiplierValue = $state(1);
    multiplier.subscribe((value) => {
        multiplierValue = value;
    });
</script>

<li>
    <input type="checkbox" class="checkbox" />
    <span class="font-medium"> {wholeAndFraction(ingredient?.quantity * multiplierValue)}</span>
    <!-- Measure (tbs, ts, grams, cups etc) -->
    <span>
        {measures.data.find((measure) => measure.id == ingredient.measure_id)?.name}
    </span>
    <!-- Name -->
    <span> {ingredient?.name}</span>

    {#if ingredient?.alternatives?.dutch_name}
        <div class="group inline-flex justify-center sm:relative">
            <div
                class="inline w-fit -translate-y-2 rounded-full bg-uiDark-50 p-[2px] text-[6pt] font-bold text-uiDark-600"
            >
                NL
            </div>
            <div
                class="absolute left-8 z-10 hidden w-40 translate-y-4 rounded-md bg-uiDark-400 p-4 group-hover:block sm:-right-8 sm:left-auto"
            >
                <span>
                    <strong>Dutch translation:</strong>
                    <br />{ingredient?.alternatives?.dutch_name ?? ''}</span
                >
            </div>
        </div>
    {/if}
    {#if ingredient?.alternatives?.alternatives}
        <div class="group inline sm:relative">
            <span
                ><Icon
                    icon="material-symbols:swap-horizontal-circle-rounded"
                    class="inline -translate-y-2 text-uiDark-50"
                /></span
            >
            <div
                class="absolute left-8 z-10 hidden w-64
                                            rounded-md bg-uiDark-400 p-4 group-hover:block sm:-left-20 sm:w-80"
            >
                <strong> Possible alternatives to {ingredient?.name}:<br /></strong>
                {ingredient?.alternatives?.alternatives ?? ''}
                <div class="lh text-sm text-uiGray-200">
                    <br />
                    (Alternatives are not specific to this recipe)
                </div>
            </div>
        </div>
    {/if}
</li>
