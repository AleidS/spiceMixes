<script>
    import ApplicationLogo from '@/Components/ApplicationLogo.svelte';
    import Dropdown from '@/Components/Dropdown.svelte';
    import DropdownLink from '@/Components/DropdownLink.svelte';
    import NavLink from '@/Components/NavLink.svelte';
    import ResponsiveNavLink from '@/Components/ResponsiveNavLink.svelte';
    import { inertia, page } from '@inertiajs/svelte';
    import MixesFilters from './LayoutParts/MixesFilters.svelte';

    //   import { Button } from 'flowbite-svelte';
    //   https://flowbite-svelte.com/docs/components/buttons

    import Button from '@/Components/Button.svelte';
    import Shares from './LayoutParts/Shares.svelte';
    import Icon from '@iconify/svelte';
    import { onMount } from 'svelte';
    let { children, header, cuisines, selectedCuisineId, showFilter = false } = $props();

    console.log($page.props);

    let showDialog = $state(false);
    onMount(() => {
        const hasSeenDialog = localStorage.getItem('hasSeenDialog');
        if (!hasSeenDialog) {
            showDialog = true; // Show the dialog if it hasn't been seen
        }
    });

    function handleDialogClose() {
        // Mark the dialog as seen in localStorage
        localStorage.setItem('hasSeenDialog', 'true');
        showDialog = false; // Close the dialog
    }

    let showingNavigationDropdown = $state(false);
</script>

<div class="fixed flex h-full w-full flex-col bg-uiGray-100 dark:bg-uiDark-800">
    <nav
        class="sticky top-0 z-40 border-b border-uiGray-100 bg-white dark:border-uiGray-700 dark:bg-uiDark-600"
    >
        <!-- Primary Navigation Menu -->
        <div class="mx-auto w-full px-4 md:px-8 lg:px-16">
            <div class="flex h-16 items-center justify-between">
                <div class="flex h-full items-stretch">
                    <!-- Logo -->
                    <div class="flex shrink-0 items-center">
                        <a use:inertia href={route('home')}>
                            <ApplicationLogo
                                class="block h-9 w-auto fill-current text-uiGray-800 dark:text-uiGray-200"
                            />
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="top-0 z-40 hidden h-auto space-x-8 sm:ml-10 md:flex">
                        <NavLink href="/" active={route().current('home')}
                            ><Icon icon="mdi:home" /></NavLink
                        >

                        {#if $page.props.auth.user}
                            <NavLink href="/cuisines" active={route().current('cuisines')}
                                >Cuisines</NavLink
                            >
                        {/if}
                        <NavLink href="/about" active={route().current('about')}>About</NavLink>
                        <NavLink href="/sources" active={route().current('sources')}
                            >Sources</NavLink
                        >
                        <NavLink href="/contact" active={route().current('contact')}
                            >Contact</NavLink
                        >
                    </div>
                </div>
                <!-- <ResponsiveNavLink href="/login" class="block sm:hidden">
                    <Button class="!bg-primary-600 !text-white">Log in</Button>
                </ResponsiveNavLink> -->

                <div class="hidden sm:ms-6 sm:items-center md:flex">
                    <!-- Settings Dropdown -->
                    {#if $page.props.auth.user}
                        <Shares />
                    {/if}
                    <div class="relative ms-3">
                        {#if $page.props.auth.user}
                            <Dropdown align="right" width="48">
                                {#snippet trigger()}
                                    <span class="inline-flex rounded-md">
                                        <button
                                            type="button"
                                            class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 font-secondary text-sm font-medium leading-4 text-uiGray-500 transition duration-150 ease-in-out hover:text-uiGray-700 focus:outline-none dark:bg-uiDark-500 dark:text-uiGray-200 dark:hover:text-uiGray-100"
                                        >
                                            {$page.props.auth.user.name}
                                            <svg
                                                class="-me-0.5 ms-2 h-4 w-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </span>
                                {/snippet}

                                {#snippet content()}
                                    <DropdownLink href={route('profile.edit')}>Profile</DropdownLink
                                    >
                                    <DropdownLink href={route('logout')} method="post" as="button"
                                        >Log Out</DropdownLink
                                    >
                                {/snippet}
                            </Dropdown>
                        {:else}
                            <NavLink href="/register">
                                <Button
                                    class="border-3 border border-primary-600 !bg-uiDark-600 !font-bold !text-uiGray-100"
                                >
                                    register
                                </Button>
                            </NavLink>

                            <NavLink href="/login">
                                <Button class="!bg-primary-600 !text-white">Log in</Button>
                            </NavLink>
                        {/if}
                    </div>
                </div>

                <div class="flex items-center gap-3 md:hidden">
                    {#if $page.props.auth.user}
                        <Shares />
                    {/if}
                    <!-- Hamburger -->
                    <div class="-me-2 flex items-center">
                        <!-- svelte-ignore a11y_consider_explicit_label -->
                        <button
                            onclick={() => (showingNavigationDropdown = !showingNavigationDropdown)}
                            class="inline-flex items-center justify-center rounded-md p-2 text-uiGray-400 transition duration-150 ease-in-out hover:bg-uiGray-100 hover:text-uiGray-500 focus:bg-uiGray-100 focus:text-uiGray-500 focus:outline-none dark:text-uiGray-500 dark:hover:bg-uiGray-900 dark:hover:text-uiGray-400 dark:focus:bg-uiGray-900 dark:focus:text-uiGray-400"
                        >
                            <svg
                                class="h-6 w-6"
                                stroke="currentColor"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    class={showingNavigationDropdown ? 'hidden' : 'inline-flex'}
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                                <path
                                    class={showingNavigationDropdown ? 'inline-flex' : 'hidden'}
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div class={`${showingNavigationDropdown ? 'block' : 'hidden'} md:hidden`}>
            <div class="space-y-1 pb-3 pt-2">
                <ResponsiveNavLink href="/" active={route().current('home')}
                    ><Icon icon="mdi:home" /></ResponsiveNavLink
                >

                {#if $page.props.auth.user}
                    <ResponsiveNavLink href="/cuisines" active={route().current('cuisines')}
                        >Cuisines</ResponsiveNavLink
                    >
                {/if}
                <ResponsiveNavLink href="/about" active={route().current('about')}
                    >About</ResponsiveNavLink
                >
                <ResponsiveNavLink href="/sources" active={route().current('sources')}
                    >Sources</ResponsiveNavLink
                >
                <ResponsiveNavLink href="/contact" active={route().current('contact')}
                    >Contact</ResponsiveNavLink
                >
                <!-- <ResponsiveNavLink href={route('mixes')} active={route().current('mixes.index')}>
                    Mixes
                </ResponsiveNavLink> -->
            </div>

            {#if $page.props.auth.user}
                <!-- Responsive Settings Options -->
                <div class="border-t border-uiGray-200 pb-1 pt-4 dark:border-uiGray-600">
                    <div class="px-4">
                        <div class="text-base font-medium text-uiGray-800 dark:text-uiGray-200">
                            {$page.props.auth.user.name}
                        </div>
                        <div class="text-sm font-medium text-uiGray-500">
                            {$page.props.auth.user.email}
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <ResponsiveNavLink
                            href={route('profile.edit')}
                            active={route().current('profile.edit')}>Profile</ResponsiveNavLink
                        >
                        <ResponsiveNavLink href={route('logout')} method="post" as="button"
                            >Log Out</ResponsiveNavLink
                        >
                    </div>
                </div>
            {:else}
                <ResponsiveNavLink href="/register">register</ResponsiveNavLink>
            {/if}
        </div>
    </nav>

    <!-- Page Heading -->
    {#if header}
        <header class="bg-white shadow dark:bg-uiGray-800">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                {@render header()}
            </div>
        </header>
    {/if}

    <!-- Page Content -->
    <main class="relative h-full flex-1 overflow-hidden">
        <div class="z-1 absolute top-0 h-full w-full overflow-auto p-2 md:p-10">
            {@render children()}
        </div>
        {#if showFilter}
            <MixesFilters {cuisines} {selectedCuisineId} class="fixed left-0 top-0 !z-20 h-full" />
        {/if}
    </main>
</div>

{#if showDialog}
    <dialog open>
        <form method="dialog" onsubmit={handleDialogClose}>
            <p>
                Hello!
                <br />
                <br />
                Please be aware this website is still a work in progress and hiccups might occur (backup
                your recipes!)
                <br /><br />
            </p>
            <Button type="submit">Understood!</Button>
        </form>
    </dialog>
{/if}
