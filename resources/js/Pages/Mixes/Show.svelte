<script>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';

    let { mix, measures } = $props();
    import Icon from '@iconify/svelte';
    import { router, page, Link } from '@inertiajs/svelte';
    import Button from '@/Components/Button.svelte';
    import FavoriteStar from '@/Components/FavoriteStar.svelte';

    import ShareMix from '@/Pages/Mixes/ShareMix.svelte';
    import Calculator from '@/Components/calculator/Calculator.svelte';
    import Draggable from '@/Components/calculator/Draggable.svelte';
    let multiplier = $state(1);

    let calculator = $state(false);
    let unitConversions = $state(false);
    console.log(mix.data);
</script>

<svelte:head>
    <title>{mix.data.name}</title>
</svelte:head>

<AuthenticatedLayout>
    <div
        class="page flex cursor-auto flex-col gap-6"
        role="button"
        tabindex="0"
        onkeyup={() => {
            calculator = false;
        }}
        onclick={(calculator = false)}
    >
        <div class="flex w-full items-center justify-between">
            <Button class=" !bg-secondary-600 !text-uiGray-50 hover:bg-secondary-400 ">
                <Link href={route('home')} class="flex items-center gap-1 ">
                    <Icon icon="mdi:arrow-left-circle" class="mb-[2px] size-4" />
                    Back to Mixes
                </Link>
            </Button>
            {#if mix.data.editable}
                <Link href={route('mixes.edit', mix.data.id)}>
                    <Button primary>
                        <Icon icon="mdi:pencil" class="" />
                        Edit
                    </Button>
                </Link>
            {:else if $page.props.auth.user}
                <Link href={route('mixes.duplicate', mix.data.id)}>
                    <Button primary>
                        <Icon icon="mdi:pencil" class="" />
                        Duplicate & edit
                    </Button>
                </Link>
            {/if}
        </div>
        <div
            class="flex w-full justify-between {calculator
                ? 'pointer-events-none'
                : 'pointer-events-auto'}"
        >
            <h1 class="flex items-center gap-2 font-primary text-3xl font-medium">
                {mix.data.name}
                <FavoriteStar mix={mix.data} class="inline" />
            </h1>

            {#if mix.data.editable}
                <ShareMix {mix} />
            {/if}
        </div>
        <div class="flex flex-wrap justify-stretch gap-6 md:justify-between">
            <div
                class=" sm: relative h-[250px] w-full overflow-hidden object-cover sm:max-w-[300px] md:max-w-[300px]"
            >
                {#if mix.data.avatar}
                    <img
                        src={mix.data.avatar}
                        alt={mix.data.name}
                        class="max-h-full min-h-full min-w-full max-w-full rounded-md border border-uiGray-400 object-cover object-center"
                    />
                    {#if mix.data.img_source != '' && mix.data.img_source != null}
                        <a
                            href={`${mix.data.img_source}`}
                            target="_blank"
                            class="z-2 absolute bottom-[1px] left-[1px] rounded-md p-1 text-2xl backdrop-blur-sm hover:scale-105 hover:brightness-110"
                            ><Icon icon="mdi:link-variant" class="inline" />
                        </a>
                    {/if}
                {:else}
                    <img
                        src="/storage/pexels-martabranco-1340116.jpg"
                        alt="4 spoons with spices"
                        class="max-h-full min-h-full min-w-full max-w-full rounded-md border border-uiGray-400 object-cover object-center"
                    />
                {/if}
            </div>

            <div class="box flex flex-1 flex-col justify-between gap-y-4">
                <div class="flex w-full items-start justify-between">
                    <div>
                        <div class="flex items-center justify-start">
                            <h4>Ingredients:</h4>
                            &nbsp;
                            <div class="mb-1 inline text-center font-light text-uiDark-100">
                                {multiplier == 1
                                    ? ''
                                    : multiplier < 1
                                      ? `/ ${1 / multiplier}`
                                      : `* ${multiplier}`}
                            </div>
                        </div>
                        <ul class="relative">
                            {#each mix.data.ingredients.filter((ingredient) => !ingredient.optional) as ingredient}
                                <li>
                                    <input type="checkbox" class="checkbox" />
                                    <span class="font-medium">
                                        {ingredient?.quantity * multiplier}</span
                                    >
                                    <!-- Measure (tbs, ts, grams, cups etc) -->
                                    <span>
                                        {measures.data.find(
                                            (measure) => measure.id == ingredient.measure_id
                                        )?.name}
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
                                                    <br />{ingredient?.alternatives?.dutch_name ??
                                                        ''}</span
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
                                                <strong>
                                                    Possible alternatives to {ingredient?.name}:<br
                                                    /></strong
                                                >
                                                {ingredient?.alternatives?.alternatives ?? ''}
                                                <div class="lh text-sm text-uiGray-200">
                                                    <br />
                                                    (Alternatives are not specific to this recipe)
                                                </div>
                                            </div>
                                        </div>
                                    {/if}
                                </li>
                            {/each}

                            {#if mix.data.ingredients.filter((ingredient) => ingredient.optional).length > 0}
                                <div class="mb-1 mt-2"><strong>Optional:</strong></div>
                                {#each mix.data.ingredients.filter((ingredient) => ingredient.optional) as ingredient}
                                    <li>
                                        <input type="checkbox" class="checkbox" />
                                        <span class="font-medium">
                                            {ingredient?.quantity * multiplier}</span
                                        >
                                        <!-- Measure (tbs, ts, grams, cups etc) -->
                                        <span>
                                            {measures.data.find(
                                                (measure) => measure.id == ingredient.measure_id
                                            )?.name}
                                        </span>
                                        <!-- Name -->
                                        <span> {ingredient?.name}</span>

                                        {#if ingredient?.alternatives?.dutch_name}
                                            <div
                                                class="group inline-flex justify-center sm:relative"
                                            >
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
                                                        <br />{ingredient?.alternatives
                                                            ?.dutch_name ?? ''}</span
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
                                                    <strong>
                                                        Possible alternatives to {ingredient?.name}:<br
                                                        /></strong
                                                    >
                                                    {ingredient?.alternatives?.alternatives ?? ''}
                                                    <div class="lh text-sm text-uiGray-200">
                                                        <br />
                                                        (Alternatives are not specific to this recipe)
                                                    </div>
                                                </div>
                                            </div>
                                        {/if}
                                    </li>
                                {/each}
                            {/if}
                        </ul>
                    </div>
                    <button
                        class="rounded-lg border border-primary-400 p-1 text-white"
                        onclick={(event) => {
                            event.stopPropagation();
                            calculator = true;
                        }}><Icon icon="mdi:calculator" class="text-2xl" /></button
                    >
                </div>
                <div class="flex items-center gap-2">
                    {#if mix.data.ingredients.length > 0}
                        <Button
                            class="!rounded-full !bg-primary-600 !px-2 !py-1 !text-white"
                            onclick={() => {
                                multiplier = multiplier / 2;
                            }}>half</Button
                        >

                        <Button
                            class="!rounded-full !bg-primary-600 !px-1 !py-1 !text-white"
                            onclick={() => {
                                multiplier = multiplier * 2;
                            }}>double</Button
                        >
                        {#if multiplier != 1}
                            <Button
                                class="!rounded-full !bg-primary-600 !p-1 !text-white"
                                onclick={() => {
                                    multiplier = 1;
                                }}><Icon icon="mdi:arrow-u-left-top" /></Button
                            >
                        {/if}
                    {/if}
                </div>
            </div>
        </div>
        {#if mix.data?.description}
            <div class="box">
                <h4>Description</h4>
                <p>{mix.data?.description}</p>
            </div>
        {/if}

        <p><strong>Cuisine:</strong> {mix.data.cuisine.name}</p>
        {#if mix.data?.source_url}
            <p>
                <strong>Source(s):</strong>
                <a href={mix.data.source_url} class="underline">{mix.data?.source_name ?? 'link'}</a
                >
            </p>
        {:else if mix.data?.source_name}
            <strong>Source:</strong>{mix.data?.source_name}
        {/if}
    </div>

    {#if calculator}
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
                    <div
                        class="pointer-events-auto flex flex-col items-center justify-center gap-2"
                    >
                        <div class="flex w-full justify-end">
                            <Button
                                onclick={() => {
                                    calculator = !calculator;
                                }}>X</Button
                            >
                        </div>
                        <Calculator class="!pointer-events-auto" />

                        <Button
                            onclick={(event) => {
                                event.stopPropagation();
                                unitConversions = !unitConversions;
                            }}>Show Unit conversions ?</Button
                        >
                    </div>
                    {#if unitConversions}
                        <div
                            class="flex h-fit flex-col items-center gap-2 rounded-md bg-uiDark-400 p-4"
                        >
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
    {/if}
</AuthenticatedLayout>
