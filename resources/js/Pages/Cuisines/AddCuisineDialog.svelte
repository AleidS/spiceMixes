<script>
    // import { page, useForm } from '@inertiajs/svelte';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';
    import { router, page, Link, useForm } from '@inertiajs/svelte';
    import Button from '@/Components/Button.svelte';

    import Icon from '@iconify/svelte';
    import Input from '@/Components/Input.svelte';

    export let cuisines;
    export let errors;
    export let cuisine;
    console.log(cuisine);

    const form = useForm({
        color: cuisine?.color ?? '',
        name: cuisine?.name ?? '',
        id: cuisine?.id ?? null
    });

    function save() {
        console.log(form);
        $form.post('/cuisines', form, { onSuccess: () => form.reset() });
        router.reload({ only: ['users'] });
    }
    function remove() {
        $form.delete(`/cuisines/delete/${cuisine.id}`);
    }
</script>

<dialog open>
    <form method="dialog" class="flex flex-col gap-y-4 text-base font-normal">
        <h2>{cuisine ? 'Edit' : 'New'} Cuisine</h2>
        <p>Add your own cuisine with custom color!</p>

        <Input
            type="text"
            bind:value={$form.name}
            placeholder="name"
            class="w-80 flex-1 text-black"
            wrapperClass="col-span-1 lg:col-span-5"
            label={'Cuisine name'}
            error={errors?.name}
        />

        <div class="flex w-full items-end justify-stretch gap-3">
            <Input
                type="text"
                bind:value={$form.color}
                placeholder="#RRGGBB"
                class="w-80 !flex-1 text-black"
                wrapperClass="col-span-1 lg:col-span-5"
                label={'Color'}
                error={errors?.color}
            />
            <Input
                type="color"
                bind:value={$form.color}
                placeholder=""
                class="!mb-2 !w-fit text-black"
                wrapperClass="!w-fit !mb-1"
                error={errors?.color}
            />
        </div>
        <Icon icon="mdi:colorpick" />
        <div class="flex">
            <div
                class="w-fit text-nowrap p-1 px-2 font-secondary font-semibold text-white"
                style="background-color: {$form.color != '' ? $form.color : ''}!important;"
            >
                {$form.color ? 'Readibility check' : '_'}
            </div>
        </div>
        <div class="flex w-full justify-between">
            <Button type="submit" outline>Back</Button>
            <Button type="submit" class="!bg-success-500 !text-white" onclick={save}>Save!</Button>
        </div>
        {#if cuisine?.mixes_count == 0}
            This cuisine has no mixes. You can delete it;
            <Button type="submit" class="w-fit !bg-danger-500 !text-white" onclick={remove}
                >Delete Cuisine</Button
            >
        {/if}
    </form>
</dialog>
