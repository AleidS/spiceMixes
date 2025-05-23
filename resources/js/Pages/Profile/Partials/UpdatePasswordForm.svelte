<script>
    import { useForm } from '@inertiajs/svelte';
    import InputError from '@/Components/InputError.svelte';
    import InputLabel from '@/Components/InputLabel.svelte';
    import PrimaryButton from '@/Components/PrimaryButton.svelte';
    import TextInput from '@/Components/TextInput.svelte';
    import { fade } from 'svelte/transition';
    import { cubicInOut } from 'svelte/easing';

    let { class: className = '' } = $props();

    let passwordInput;
    let currentPasswordInput;

    const form = useForm({
        current_password: '',
        password: '',
        password_confirmation: ''
    });

    function updatePassword(e) {
        e.preventDefault();
        $form.put(route('password.update'), {
            preserveScroll: true,
            onSuccess: () => $form.reset(),
            onError: () => {
                if ($form.errors.password) {
                    $form.reset('password', 'password_confirmation');
                    passwordInput?.focus();
                }
                if ($form.errors.current_password) {
                    $form.reset('current_password');
                    currentPasswordInput?.focus();
                }
            }
        });
    }
</script>

<section class={className}>
    <header>
        <h4 class="text-lg font-medium text-uiGray-900 dark:text-uiGray-100">Update Password</h4>

        <p class="mt-1 text-sm text-uiGray-600 dark:text-uiGray-400">
            Ensure your account is using a long, random password to stay secure.
        </p>
    </header>

    <form onsubmit={updatePassword} class="mt-6 space-y-6">
        <div>
            <InputLabel for="current_password" value="Current Password" />

            <TextInput
                id="current_password"
                bind:this={currentPasswordInput}
                bind:value={$form.current_password}
                type="password"
                class="mt-1 block w-full"
                autocomplete="current-password"
            />

            <InputError message={$form.errors.current_password} class="mt-2" />
        </div>

        <div>
            <InputLabel for="password" value="New Password" />

            <TextInput
                id="password"
                bind:this={passwordInput}
                bind:value={$form.password}
                type="password"
                class="mt-1 block w-full"
                autocomplete="new-password"
            />

            <InputError message={$form.errors.password} class="mt-2" />
        </div>

        <div>
            <InputLabel for="password_confirmation" value="Confirm Password" />

            <TextInput
                id="password_confirmation"
                bind:value={$form.password_confirmation}
                type="password"
                class="mt-1 block w-full"
                autocomplete="new-password"
            />

            <InputError message={$form.errors.password_confirmation} class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <PrimaryButton disabled={$form.processing}>Save</PrimaryButton>

            {#if $form.recentlySuccessful}
                <div transition:fade={{ easing: cubicInOut }}>
                    <p class="text-sm text-uiGray-600 transition ease-in-out dark:text-uiGray-400">
                        Saved.
                    </p>
                </div>
            {/if}
        </div>
    </form>
</section>
