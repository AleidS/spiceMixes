<script>
    import ApplicationLogo from '@/Components/ApplicationLogo.svelte';
    import Dropdown from '@/Components/Dropdown.svelte';
    import DropdownLink from '@/Components/DropdownLink.svelte';
    import NavLink from '@/Components/NavLink.svelte';
    import ResponsiveNavLink from '@/Components/ResponsiveNavLink.svelte';
    import { inertia, page } from '@inertiajs/svelte';

    let { children, header } = $props();

    let showingNavigationDropdown = $state(false);
</script>

<div class="dark:bg-uiDark-800 bg-uiGray-100 min-h-screen">
    <nav class="dark:bg-uiDark-600 border-uiGray-100 dark:border-uiGray-700 border-b bg-white">
        <!-- Primary Navigation Menu -->
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 justify-between">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex shrink-0 items-center">
                        <a use:inertia href={route('dashboard')}>
                            <ApplicationLogo
                                class="text-uiGray-800 dark:text-uiGray-200 block h-9 w-auto fill-current"
                            />
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
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
                                        class="text-uiGray-500 dark:bg-uiDark-500 dark:text-uiGray-200 dark:hover:text-uiGray-100 hover:text-uiGray-700 inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 transition duration-150 ease-in-out focus:outline-none"
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
                        class="text-uiGray-400 dark:text-uiGray-500 dark:hover:bg-uiGray-900 dark:hover:text-uiGray-400 dark:focus:bg-uiGray-900 dark:focus:text-uiGray-400 hover:bg-uiGray-100 hover:text-uiGray-500 focus:bg-uiGray-100 focus:text-uiGray-500 inline-flex items-center justify-center rounded-md p-2 transition duration-150 ease-in-out focus:outline-none"
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
            </div>

            <!-- Responsive Settings Options -->
            <div class="dark:border-uiGray-600 border-uiGray-200 border-t pb-1 pt-4">
                <div class="px-4">
                    <div class="dark:text-uiGray-200 text-uiGray-800 text-base font-medium">
                        {$page.props.auth.user.name}
                    </div>
                    <div class="text-uiGray-500 text-sm font-medium">
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
        <header class="dark:bg-uiGray-800 bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                {@render header()}
            </div>
        </header>
    {/if}

    <!-- Page Content -->
    <main class="md:p-10">
        {@render children()}
    </main>
</div>
