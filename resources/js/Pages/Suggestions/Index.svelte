<script>
    // import { page, useForm } from '@inertiajs/svelte';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';
    import RichTextTipTap from '@/Components/RichTextTipTap.svelte';
    import Switch from '@/Components/Switch.svelte';
    import Input from '@/Components/Input.svelte';
    import Button from '@/Components/Button.svelte';
    const form = useForm({
        name: '',
        suggestion: ''
    });

    async function send(event) {
        preventEffect = true;
        event.preventDefault();

        let formData = { ...$form };
        formData.post('/suggestions');
    }

    let richText = $state(false);
    let termsAccepted = $state(false);
</script>

<svelte:head>
    <title>Suggestions</title>
</svelte:head>
<AuthenticatedLayout class="z-0">
    <!-- <MixesFilters {cuisines} {selectedCuisineId} /> -->
    <!-- User ID: {$page.props.auth.user.id} -->
    <div class="page m-auto mt-10 !max-w-[700px]">
        <h1>Suggestions</h1>
        <div class="box flex-1">
            <!-- <h4>Ingredients:</h4> -->
            <p>
                Have good ideas to improve this app? Let me know:) For urgent things, send me an
                email!
            </p>
            <form onsubmit={addMix} class=" flex flex-col gap-y-6">
                <div>Suggestion</div>
                <Switch text="Show Rich Text Editor" switchClass="scale-75" bind:checked={richText}
                ></Switch>
                {#if !richText}
                    <Input
                        type="textArea"
                        bind:value={$form.suggestions}
                        placeholder="Description"
                        wrapperClass="!max-w-full"
                        class="h-fit !p-4 text-black"
                        error={errors.suggestions}
                    />
                {:else}
                    <RichTextTipTap bind:value={$form.description} />
                {/if}
                <Input
                    label="Your name (optional)"
                    labelClass="w-full"
                    type="text"
                    bind:value={$form.name}
                    placeholder="Source url"
                    class="!w-full text-black"
                    error={errors.name}
                    wrapperClass="flex-wrap"
                />
                <div class="w-full p-2 text-right font-light">
                    By uploading my suggestions I agree to the
                    <a href="/uploadTerms" target="_blank" class="tab-link-class underline">
                        upload terms and conditions
                    </a>
                    ,
                    <a href="/generalTerms" target="_blank" class="tab-link-class underline">
                        the general terms and conditions
                    </a>
                    and I do agree that these suggestions might be used, with or without credit.
                    <input type="checkbox" bind:checked={termsAccepted} class="checkbox ml-2" />
                </div>

                <Button
                    id="submitbutton"
                    type="submit"
                    disabled={!termsAccepted}
                    primary
                    class="h-auto w-fit text-nowrap !bg-success-600 !text-white !saturate-[120%]"
                >
                    <Icon icon="mdi:floppy" class="mb-1 size-5" />
                    {mix ? 'Save mix' : 'Add Mix'}
                </Button>
            </form>
        </div>
    </div>
</AuthenticatedLayout>

<!-- <button onclick={deleteMix}>Delete Mix</button> -->
