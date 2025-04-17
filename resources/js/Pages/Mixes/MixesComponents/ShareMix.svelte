<script>
    import { inertia, page, router, useForm } from '@inertiajs/svelte';
    //   import { Button } from 'flowbite-svelte';
    //   https://flowbite-svelte.com/docs/components/buttons

    import Button from '@/Components/Button.svelte';
    import Input from '@/Components/Input.svelte';
    import Icon from '@iconify/svelte';
    let { mix, errors, measures, cuisines } = $props();

    let showDialog = $state(false);

    const form = {
        email: '',
        name: '',
        message: '',
        mix_id: mix.data.id,
        mix: JSON.stringify(mix.data)
    };

    function send() {
        console.log(form);
        router.post('/shares/send', form);
        alert(
            'Thank you! We cannot tell you if the email adress is registered, but if it is,\
             the other user should get a notification when they login/refresh the page!'
        );
    }
</script>

{#if $page.props?.auth?.user}
    <button
        class="relative flex text-2xl text-uiGray-200"
        onclick={() => (showDialog = !showDialog)}><Icon icon="mdi:share" />Share</button
    >
    {#if showDialog}
        <dialog open>
            <form method="dialog" class="flex flex-col gap-y-4 text-base font-normal">
                <h2>Share recipe</h2>
                <p>
                    Share this mix with another user by typing in their email adress below. The mix
                    will be sent as-is (it's not collaborative), and images are not included. If you
                    want to submit the mix for sharing on the homepage, click 'edit' instead!
                </p>

                <Input
                    type="text"
                    bind:value={form.email}
                    placeholder="email"
                    class="w-80 flex-1 text-black"
                    wrapperClass="!w-80 col-span-1 lg:col-span-5"
                    label={'target user email'}
                    error={errors?.email}
                />
                <p>What is your name? If not given, you will send the recipe anonymously</p>
                <Input
                    type="text"
                    bind:value={form.name}
                    placeholder="name"
                    class="w-80 flex-1 text-black"
                    wrapperClass="col-span-1 lg:col-span-5"
                    label={'Your name'}
                    error={errors?.name}
                />
                <p>Want to include a personal message?</p>
                <Input
                    type="textfield"
                    bind:value={form.message}
                    placeholder="message"
                    class="w-80 flex-1 text-black"
                    wrapperClass="col-span-1 lg:col-span-5"
                    label={'Custom message'}
                    error={errors?.message}
                />
                <div class="flex w-full justify-between">
                    <Button type="submit">Back</Button>
                    <Button type="submit" class="!bg-success-500 !text-white" onclick={send}
                        >Send!</Button
                    >
                </div>
            </form>
        </dialog>
    {/if}
{/if}
