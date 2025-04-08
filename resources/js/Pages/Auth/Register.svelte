<script>
    import { useForm, inertia } from '@inertiajs/svelte';
    import GuestLayout from '@/Layouts/GuestLayout.svelte';
    import InputLabel from '@/Components/InputLabel.svelte';
    import TextInput from '@/Components/TextInput.svelte';
    import InputError from '@/Components/InputError.svelte';
    import PrimaryButton from '@/Components/PrimaryButton.svelte';

    import { Link } from '@inertiajs/svelte';
    import Button from '@/Components/Button.svelte';
    import Icon from '@iconify/svelte';
    const form = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        terms: false
    });

    let termsAccepted = $state(false);

    const onSubmit = (event) => {
        event.preventDefault();
        $form.post(route('register'), {
            onFinish: () => $form.reset('password', 'password_confirmation')
        });
    };
</script>

<svelte:head>
    <title>Register</title>
</svelte:head>

<GuestLayout>
    <div class="m-auto flex w-full items-center justify-center">
        <a
            href={route('auth.google.redirect')}
            class="btn mb-4 block rounded-md bg-uiDark-400 p-3 text-uiGray-100 shadow-sm"
        >
            <Icon icon="flat-color-icons:google" class="text-3x1 mb-1 inline" /> Login/Register with
            Google
        </a>
    </div>
    <div class="my-4 w-full text-center">Or register with email:</div>
    <form onsubmit={onSubmit}>
        <!-- Name -->
        <div>
            <InputLabel for="name" value="Name" />
            <TextInput
                id="name"
                class="mt-1 block w-full"
                bind:value={$form.name}
                type="text"
                name="name"
                required
                autofocus
                autocomplete="name"
            />
            <InputError message={$form.errors.name} class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <InputLabel for="email" value="Email" />
            <TextInput
                id="email"
                class="mt-1 block w-full"
                bind:value={$form.email}
                type="email"
                name="email"
                required
                autocomplete="username"
            />
            <InputError message={$form.errors.email} class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <InputLabel for="password" value="Password" />
            <TextInput
                id="password"
                class="mt-1 block w-full"
                bind:value={$form.password}
                type="password"
                required
                autocomplete="new-password"
            />
            <InputError message={$form.errors.password} class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <InputLabel for="password-confirmation" value="Confirm Password" />
            <TextInput
                id="password-confirmation"
                class="mt-1 block w-full"
                bind:value={$form.password_confirmation}
                type="password"
                required
                autocomplete="new-password"
            />
            <InputError message={$form.errors.password} class="mt-2" />
        </div>

        <div class="text-md my-4 font-light">
            <input type="checkbox" bind:checked={termsAccepted} class="" />
            By registering on this platform I confirm that I have read and agree to the

            <a href="/generalTerms" target="_blank" class="tab-link-class underline">
                terms and conditions
            </a>
        </div>

        <div class="mt-4 flex items-center justify-end gap-4">
            <a
                use:inertia
                href={route('login')}
                class="rounded-md text-sm text-uiGray-600 underline hover:text-uiGray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-uiGray-400 dark:hover:text-uiGray-100 dark:focus:ring-offset-uiGray-800"
            >
                Already Registered?
            </a>

            <Button
                primary
                disabled={!termsAccepted}
                type="submit"
                class="ms-4"
                processing={$form.processing}>Register</Button
            >
        </div>
    </form>
</GuestLayout>
