<script>
    import { inertia, page, useForm } from '@inertiajs/svelte';
    import InputError from '@/Components/InputError.svelte';
    import InputLabel from '@/Components/InputLabel.svelte';
    import PrimaryButton from '@/Components/PrimaryButton.svelte';
    import TextInput from '@/Components/TextInput.svelte';
    import { fade } from 'svelte/transition';
    import { cubicInOut } from 'svelte/easing';

    let { class: className = '', mustVerifyEmail, status } = $props();

    const user = $page.props.auth.user;
    const form = useForm({
        name: user.name,
        email: user.email
    });

    function submit(e) {
        e.preventDefault();
        $form.patch(route('profile.update'));
    }
</script>

<section class={className}>
    <header>
        <h2 class="text-uiGray-900 dark:text-uiGray-100 text-lg font-medium">
            Profile Information
        </h2>

        <p class="text-uiGray-600 dark:text-uiGray-400 mt-1 text-sm">
            Update your account's profile information and email address.
        </p>
    </header>

    <form onsubmit={submit} class="mt-6 space-y-6">
        <div>
            <InputLabel for="name" value="Name" />

            <TextInput
                id="name"
                type="text"
                class="mt-1 block w-full"
                bind:value={$form.name}
                required
                autofocus
                autocomplete="name"
            />

            <InputError class="mt-2" message={$form.errors.name} />
        </div>

        <div>
            <InputLabel for="email" value="Email" />

            <TextInput
                id="email"
                type="email"
                class="mt-1 block w-full"
                bind:value={$form.email}
                required
                autocomplete="username"
            />

            <InputError class="mt-2" message={$form.errors.email} />
        </div>

        {#if mustVerifyEmail && user.email_verified_at === null}
            <p class="text-uiGray-800 dark:text-uiGray-200 mt-2 text-sm">
                Your email address is unverified.
                <button
                    use:inertia={{ href: route('verification.send'), method: 'post' }}
                    class="text-uiGray-600 hover:text-uiGray-900 dark:text-uiGray-400 dark:hover:text-uiGray-100 dark:focus:ring-offset-uiGray-800 rounded-md text-sm underline focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Click here to re-send the verification email.
                </button>
            </p>

            {#if status === 'verification-link-sent'}
                <div class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">
                    A new verification link has been sent to your email address.
                </div>
            {/if}
        {/if}

        <div class="flex items-center gap-4">
            <PrimaryButton disabled={$form.processing}>Save</PrimaryButton>

            {#if $form.recentlySuccessful}
                <div transition:fade={{ easing: cubicInOut }}>
                    <p class="text-uiGray-600 dark:text-uiGray-400 text-sm transition ease-in-out">
                        Saved.
                    </p>
                </div>
            {/if}
        </div>
    </form>
</section>
