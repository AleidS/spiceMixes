<script>
    import ApplicationLogo from '@/Components/ApplicationLogo.svelte';
    import Dropdown from '@/Components/Dropdown.svelte';
    import DropdownLink from '@/Components/DropdownLink.svelte';
    import NavLink from '@/Components/NavLink.svelte';
    import ResponsiveNavLink from '@/Components/ResponsiveNavLink.svelte';
    import { inertia, page } from '@inertiajs/svelte';
    import MixesFilters from './LayoutParts/MixesFilters.svelte';

    let { children, header, cuisines, selectedCuisineId, showFilter = false } = $props();

    let showingNavigationDropdown = $state(false);
</script>

<div class="relative flex h-screen flex-col bg-uiGray-100 dark:bg-uiDark-800">
    <nav
        class="sticky top-0 z-40 border-b border-uiGray-100 bg-white dark:border-uiGray-700 dark:bg-uiDark-600"
    >
        <!-- Primary Navigation Menu -->
        <div class="mx-auto w-full px-4 sm:px-16 lg:px-16">
            <div class="flex h-16 justify-between">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex shrink-0 items-center">
                        <a use:inertia href={route('mixes')}>
                            <ApplicationLogo
                                class="block h-9 w-auto fill-current text-uiGray-800 dark:text-uiGray-200"
                            />
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="z-40 hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <NavLink href={route('dashboard')} active={route().current('dashboard')}>
                            Dashboard
                        </NavLink>
                        <NavLink href={route('mixes')} active={route().current('mixes.index')}>
                            Mixes
                        </NavLink>
                    </div>
                </div>

                <div class="hidden sm:ms-6 sm:flex sm:items-center">
                    <!-- Settings Dropdown -->
                    <div class="relative ms-3">
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
                                <DropdownLink href={route('profile.edit')}>Profile</DropdownLink>
                                <DropdownLink href={route('logout')} method="post" as="button"
                                    >Log Out</DropdownLink
                                >
                            {/snippet}
                        </Dropdown>
                    </div>
                </div>

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <!-- svelte-ignore a11y_consider_explicit_label -->
                    <button
                        onclick={() => (showingNavigationDropdown = !showingNavigationDropdown)}
                        class="inline-flex items-center justify-center rounded-md p-2 text-uiGray-400 transition duration-150 ease-in-out hover:bg-uiGray-100 hover:text-uiGray-500 focus:bg-uiGray-100 focus:text-uiGray-500 focus:outline-none dark:text-uiGray-500 dark:hover:bg-uiGray-900 dark:hover:text-uiGray-400 dark:focus:bg-uiGray-900 dark:focus:text-uiGray-400"
                    >
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
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

        <!-- Responsive Navigation Menu -->
        <div class={`${showingNavigationDropdown ? 'block' : 'hidden'} sm:hidden`}>
            <div class="space-y-1 pb-3 pt-2">
                <ResponsiveNavLink href={route('dashboard')} active={route().current('dashboard')}>
                    Dashboard
                </ResponsiveNavLink>
                <ResponsiveNavLink href={route('mixes')} active={route().current('mixes.index')}>
                    Mixes
                </ResponsiveNavLink>
            </div>

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
