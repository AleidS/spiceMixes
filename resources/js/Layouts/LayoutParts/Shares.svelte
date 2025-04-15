<script>
    import ApplicationLogo from '@/Components/ApplicationLogo.svelte';
    import Dropdown from '@/Components/Dropdown.svelte';
    import DropdownLink from '@/Components/DropdownLink.svelte';
    import NavLink from '@/Components/NavLink.svelte';
    import ResponsiveNavLink from '@/Components/ResponsiveNavLink.svelte';
    import { inertia, page, router } from '@inertiajs/svelte';
    //   import { Button } from 'flowbite-svelte';
    //   https://flowbite-svelte.com/docs/components/buttons

    import Button from '@/Components/Button.svelte';
    import Icon from '@iconify/svelte';

    let shares = $page.props.auth.user.shares;
    console.log(shares);
    let open = $state(false);
    let showMessage = $state(false);

    function accept() {
        router.post(`/shares/accept/${showMessage.id}`);
    }

    function decline() {
        router.post(`/shares/accept/${showMessage.id}`);
    }
</script>

{#if shares.length > 0}
    <div class="relative flex">
        <Dropdown align="right" width="64">
            {#snippet trigger()}
                <div class="relative cursor-pointer">
                    <Icon icon="ph:bell-fill" class="text-xl" />
                    <div
                        class="absolute -right-[5px] -top-2 flex aspect-square items-center justify-center rounded-full bg-primary-600 px-[6px] text-xs"
                    >
                        <span class="text-xs font-bold"> {shares.length}</span>
                    </div>
                </div>{/snippet}

            {#snippet content()}
                <div class="box w-64 flex-col border-none !bg-uiDark-500">
                    <div class="flex-col gap-[2px] bg-uiDark-200">
                        {#each shares as share}
                            <button
                                class="cursor-pointer bg-uiDark-500"
                                onclick={() => {
                                    showMessage = share;
                                }}
                            >
                                {share?.name ?? 'Another user'} shared a mix with you. Click to view
                                details.
                            </button>
                        {/each}
                    </div>
                </div>
            {/snippet}
        </Dropdown>
    </div>
{/if}
{#if showMessage}
    <dialog open>
        <form method="dialog">
            {showMessage.name ?? 'another user'} shared a mix with you called {JSON.parse(
                showMessage.mix
            ).name}<br />
            {#if showMessage.message}
                They left the following message: {showMessage.message}
            {/if}
            <Button type="submit" onclick={decline}>Decline</Button>
            <Button type="submit" onclick={accept}>Accept!</Button>
        </form>
    </dialog>
{/if}
