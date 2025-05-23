<script>
    import GuestLayout from '@/Layouts/GuestLayout.svelte';
    import InputLabel from '@/Components/InputLabel.svelte';
    import TextInput from '@/Components/TextInput.svelte';
    import InputError from '@/Components/InputError.svelte';
    import Checkbox from '@/Components/Checkbox.svelte';
    import { inertia, useForm } from '@inertiajs/svelte';
    import PrimaryButton from '@/Components/PrimaryButton.svelte';
    import Icon from '@iconify/svelte';

    let { canResetPassword, status } = $props();

    const form = useForm({
        email: '',
        password: '',
        remember: false
    });

    function submit(e) {
        e.preventDefault();
        $form.post(route('login'), {
            onFinish: () => $form.reset('password')
        });
    }
</script>

<svelte:head>
    <title>Log in</title>
</svelte:head>

<GuestLayout>
    <!-- Session Status -->
    {#if status}
        <div class="mb-4 text-sm font-medium text-green-600">
            {status}
        </div>
    {/if}
    <div class="m-auto flex w-full items-center justify-center">
        <a
            href={route('auth.google.redirect')}
            class="btn mb-4 block rounded-md bg-uiDark-400 p-3 text-uiGray-100 shadow-sm"
        >
            <Icon icon="flat-color-icons:google" class="text-3x1 mb-1 inline" /> Login/Register with
            Google
        </a>
    </div>
    <div class="my-4 w-full text-center">Or login with email:</div>
    <form onsubmit={submit}>
        <!-- Email Address -->
        <div>
            <InputLabel for="email" value="Email" />
            <TextInput
                id="email"
                class="mt-1 block w-full"
                type="email"
                name="email"
                bind:value={$form.email}
                required
                autocomplete="username"
                clearable={false}
            />
            <InputError message={$form.errors.email} class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <InputLabel for="password" value="Password" />
            <TextInput
                id="password"
                class="mt-1 block w-full"
                type="password"
                name="password"
                bind:value={$form.password}
                required
                autocomplete="current-password"
                clearable={false}
            />
            <InputError message={$form.errors.password} class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="mt-4 block">
            <label for="remember-me" class="flex items-center">
                <Checkbox id="remember-me" name="remember" />
                <span class="ms-2 text-sm text-uiGray-600 dark:text-uiGray-400">Remember me</span>
            </label>
        </div>

        <div class="mt-4 flex items-center justify-end">
            {#if canResetPassword}
                <a
                    use:inertia
                    href={route('password.request')}
                    class="rounded-md text-sm text-uiGray-600 underline hover:text-uiGray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-uiGray-400 dark:hover:text-uiGray-100 dark:focus:ring-offset-uiGray-800"
                >
                    Forgot your password?
                </a>
            {/if}
            &nbsp;
            <a
                use:inertia
                href="/register"
                class="rounded-md text-sm text-uiGray-600 underline hover:text-uiGray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-uiGray-400 dark:hover:text-uiGray-100 dark:focus:ring-offset-uiGray-800"
            >
                or click here to Register
            </a>

            <PrimaryButton
                class="ms-4 {$form.processing && 'opacity-25'}"
                disabled={$form.processing}>Log in</PrimaryButton
            >
        </div>
    </form>
</GuestLayout>
