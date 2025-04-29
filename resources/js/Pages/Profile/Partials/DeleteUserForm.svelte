<script>
    import DangerButton from '@/Components/DangerButton.svelte';
    import InputLabel from '@/Components/InputLabel.svelte';
    import InputError from '@/Components/InputError.svelte';
    import Modal from '@/Components/Modal.svelte';
    import SecondaryButton from '@/Components/SecondaryButton.svelte';
    import TextInput from '@/Components/TextInput.svelte';
    import { useForm } from '@inertiajs/svelte';

    let { class: className = '' } = $props();

    let confirmingUserDeletion = $state(false);

    /** @type {HTMLInputElement} */
    let passwordInput;

    const form = useForm({
        password: ''
    });

    function confirmUserDeletion() {
        confirmingUserDeletion = true;
        setTimeout(() => passwordInput?.focus(), 250);
    }

    function deleteUser() {
        $form.delete(route('profile.destroy'), {
            onSuccess: () => closeModal(),
            onError: () => passwordInput?.focus(),
            onFinish: () => $form.reset()
        });
        confirmingUserDeletion = false;
    }

    function closeModal() {
        $form.clearErrors();
        $form.reset();
        confirmingUserDeletion = false;
    }
</script>

<section class="space-y-6 {className}">
    <header>
        <h4 class="text-lg font-medium text-uiGray-900 dark:text-uiGray-100">Delete Account</h4>
        <p class="mt-1 text-sm text-uiGray-600 dark:text-uiGray-400">
            Once your account is deleted, you won't be able to restore it. Before deleting your
            account, please download any data or information that you wish to retain. Also delete
            any photos and recipes you want completely gone from the database.
        </p>
    </header>

    <DangerButton type="button" onclick={confirmUserDeletion}>Delete Account</DangerButton>

    <Modal onclose={closeModal} show={confirmingUserDeletion}>
        <div class="p-6">
            <h4 class="text-lg font-medium text-uiGray-900 dark:text-uiGray-100">
                Are you sure you want to delete your account?
            </h4>

            <p class="mt-1 text-sm text-uiGray-600 dark:text-uiGray-400">
                Once your account is deleted, you won't be able to restore it. Please enter your
                password to confirm you would like to permanently delete your account.
                <br /><br />
                <strong
                    >If you used Google login, first logout, request a new password, then use it to
                    delete your account.</strong
                >
            </p>

            <div class="mt-6">
                <InputLabel for="password" value="Password" class="sr-only" />

                <TextInput
                    id="password"
                    bind:this={passwordInput}
                    bind:value={$form.password}
                    type="password"
                    class="mt-1 block w-full"
                    placeholder="Password"
                    onkeyup={(event) => {
                        if (event.key === 'Enter') deleteUser();
                    }}
                />

                <InputError message={$form.errors.password} class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <SecondaryButton onclick={closeModal}>Cancel</SecondaryButton>

                <DangerButton class="ml-3" processing={$form.processing} onclick={deleteUser}>
                    Delete Account
                </DangerButton>
            </div>
        </div>
    </Modal>
</section>
