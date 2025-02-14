<script>
    import { inertia, page } from '@inertiajs/svelte';
    let { canLogin, canRegister, laravelVersion, phpVersion } = $props();
</script>

<svelte:head>
    <title>Welcome</title>
</svelte:head>

<div class="bg-uiGray-50 text-black/50 dark:bg-black dark:text-white/50">
    <img
        id="background"
        class="absolute -left-20 top-0 max-w-[877px]"
        alt="Background"
        src="https://laravel.com/assets/img/welcome/background.svg"
    />
    <div
        class="relative flex min-h-screen flex-col items-center justify-center  selection:text-white"
    >
        <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
            <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                <div class="flex lg:col-start-2 lg:justify-center">
                    
                </div>
                {#if canLogin}
                    <nav class="-mx-3 flex flex-1 justify-end">
                        {#if $page.props.auth.user}
                            <a
                                use:inertia
                                href="/dashboard"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Dashboard
                            </a>
                        {:else}
                            <a
                                use:inertia
                                href="/login"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </a>

                            {#if canRegister}
                                <a
                                    use:inertia
                                    href="/register"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                >
                                    Register
                                </a>
                            {/if}
                        {/if}
                    </nav>
                {/if}
            </header>

           
        </div>
    </div>
</div>
