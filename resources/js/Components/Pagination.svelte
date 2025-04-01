<script>
    import Icon from '@iconify/svelte';
    import { Link } from '@inertiajs/svelte';

    export let data,
        updatedPageNumber = () => {};
    console.log(data.meta);
</script>

<div class="bottom-0 m-auto w-full">
    <div
        class="m-auto flex w-fit max-w-[70vw] items-center justify-between gap-x-2 rounded-md bg-uiDark-600 px-4 py-3 sm:px-6"
    >
        <div class=" flex flex-1 flex-wrap items-center justify-center gap-x-3 gap-y-2">
            <div>
                <p class="text-sm text-uiGray-100">
                    <!-- space -->
                    showing mix
                    <span class="font-medium">{data.meta.from}</span>
                    <!-- space -->
                    to
                    <!-- space -->
                    <span class="font-medium">{data.meta.to}</span>
                    <!-- space -->
                    from
                    <!-- space -->
                    <span class="font-medium">{data.meta.total}</span>
                    <!-- space -->
                </p>
            </div>

            <nav
                class="relative z-0 inline-flex gap-x-2 rounded-md bg-uiDark-400 p-2"
                aria-label="Pagination"
            >
                {#each data.meta.links as link}
                    <a
                        href={link.url}
                        class="flex w-5 items-center justify-center rounded-sm pt-1 text-sm text-uiGray-100 {link.active
                            ? 'bg-uiDark-300 font-bold'
                            : ''}"
                    >
                        {#if link.label == '&laquo; Previous'}
                            <Icon icon="mdi:chevron-left" class="mb-1 size-4" />
                        {:else if link.label != 'Next &raquo;'}
                            {@html link.label}
                        {:else}
                            <Icon icon="mdi:chevron-right" class="mb-1 size-4" />
                        {/if}
                    </a>
                {/each}
            </nav>
        </div>
    </div>
</div>
