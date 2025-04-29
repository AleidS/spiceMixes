<script>
    // import { page, useForm } from '@inertiajs/svelte';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';
    import { router, page, Link, useForm } from '@inertiajs/svelte';
    import Button from '@/Components/Button.svelte';

    import Icon from '@iconify/svelte';
    import Input from '@/Components/Input.svelte';

    export let errors;
    export let form;
    export let mix;
    export let open;

    function remove() {
        console.log('deleting');
        router.delete(`/mixes/delete/${mix.data.id}`);
    }
</script>

<dialog {open}>
    <form method="dialog" class="flex flex-col gap-y-4 text-base font-normal">
        <h2>Remove cuisine</h2>
        <p>Are you sure? this cannot be undone</p>

        <div class="flex w-full justify-between">
            <Button type="submit" outline>Back</Button>
            <Button type="submit" class="!bg-danger-500 !text-white" onclick={remove}
                >Yes, delete this mix</Button
            >
        </div>
    </form>
</dialog>
