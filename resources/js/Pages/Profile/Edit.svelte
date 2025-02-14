<script>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';
    import DeleteUserForm from './Partials/DeleteUserForm.svelte';
    import UpdatePasswordForm from './Partials/UpdatePasswordForm.svelte';
    import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.svelte';

    let { mustVerifyEmail, status } = $props();
</script>

<svelte:head>
    <title>Profile</title>
</svelte:head>

<AuthenticatedLayout>
    {#snippet header()}
        <h2 class="text-xl font-semibold leading-tight text-uiGray-800 dark:text-uiGray-200">
            Profile
        </h2>
    {/snippet}

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-uiGray-800">
                <UpdateProfileInformationForm {mustVerifyEmail} {status} class="max-w-xl" />
            </div>
            <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-uiGray-800">
                <UpdatePasswordForm class="max-w-xl" />
            </div>
            <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-uiGray-800">
                <DeleteUserForm class="max-w-xl" />
            </div>
        </div>
    </div>
</AuthenticatedLayout>
