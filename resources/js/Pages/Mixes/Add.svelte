<script>
    // import { page, useForm } from '@inertiajs/svelte';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';
    import { router, page, useForm, Link } from '@inertiajs/svelte';
    import autoAnimate from '@formkit/auto-animate';
    import Button from '@/Components/Button.svelte';
    import Input from '@/Components/Input.svelte';
    import Icon from '@iconify/svelte';
    import RichTextTipTap from '@/Components/RichTextTipTap.svelte';

    import { FileUpload } from 'melt/components';
    // import { Tooltip } from '@svelte-plugins/tooltips';
    import Switch from '@/Components/Switch.svelte';
    import { Tooltip } from 'flowbite-svelte';

    // let fileUpload;

    let { mix, errors, measures, cuisines } = $props();

    let richText = $state(false);

    $effect: if (Object.keys(errors)[0]) {
        open = true;
    }

    const form = useForm({
        name: '',
        ingredients: [
            { quantity: null, measure_id: null, name: null },
            { quantity: null, measure_id: null, name: null },
            { quantity: null, measure_id: null, name: null },
            { quantity: null, measure_id: null, name: null },
            { quantity: null, measure_id: null, name: null }
        ],
        description: '',
        source_url: '',
        source_name: '',
        user_id: $page.props.auth.user.id,
        cuisine_id: null,
        avatar: null,
        img_source: ''
    });

    let termsAccepted = $state(false);
    $effect(() => {
        console.log(mix?.data);
        if (mix?.data) {
            $form.name = mix.data.name;
            $form.ingredients = mix.data.ingredients;
            $form.description = mix.data.description;
            $form.user_id = mix.data.user_id;
            $form.cuisine_id = mix.data.cuisine_id;
            $form.avatar = mix.data.avatar;
            $form.img_source = mix.data.img_source;
        }
    });

    let image = $state();
    const reader = new FileReader();

    reader.addEventListener('load', function () {
        if (image) {
            image.setAttribute('src', reader.result);
        }
    });

    let preventEffect = false;

    $effect(() => {
        if ($form.avatar && !$form.processing && preventEffect == false) {
            if (typeof form.avatar === 'string') {
                // If avatar is a filename, set the image source directly
                image.setAttribute('src', $form.avatar);
            } else if (form.avatar instanceof Blob) {
                // If avatar is a Blob, read it as Data URL
                reader.readAsDataURL($form.avatar);
            }
        }
    });

    function handleImage(event) {
        const files = event.target.files;
        if (files.length > 0) {
            if (files[0].size > 2028000) {
                alert('max file size is 2mb');
                return;
            }
            $form.avatar = files[0];
            reader.readAsDataURL(files[0]);
        }
    }
    function handleDrop(event) {
        const files = event.dataTransfer.files;
        if (files.length > 0) {
            if (files[0].size > 2028000) {
                alert('max file size is 2mb');
                return;
            }
            $form.avatar = files[0];
            reader.readAsDataURL(files[0]);
        }
    }
    async function addMix(event) {
        preventEffect = true;
        event.preventDefault();
        // This means that the avatar has not been updated (in which case it would be a file)
        if (typeof $form.avatar == 'string') {
            delete $form.avatar;
        }
        let formData = { ...$form };
        console.log(formData);
        formData.ingredients = JSON.stringify(formData.ingredients); // Convert ingredients to JSON string
        // Send a put request with the modified form data if we are editing
        if (mix?.data) {
            // formData.avatar = 'lalala';
            router.post(`/mixes/${mix.data.id}`, formData, {
                headers: { 'Content-Type': 'multipart/form-data' }
            });
        }
        //Else send the entire thing as a post request for a new row
        else {
            router.post(`/mixes`, formData, {
                headers: { 'Content-Type': 'multipart/form-data' }
            });
        }
    }
    async function removeMix(event) {
        console.log('deleting');
        let formData = { ...$form };
        router.delete(`/mixes/delete/${mix.data.id}`);
    }
</script>

<svelte:head>
    <title>Add a mix</title>
</svelte:head>
<AuthenticatedLayout>
    {#if mix?.data?.editable != false}
        <div class="page">
            {#if Object.keys(errors)[0]}
                <dialog open>
                    <form method="dialog">
                        there were one or multiple errors:
                        <br /><br />
                        {#each Object.keys(errors) as error, index}
                            {index + 1}. {errors[error]}
                            <br />
                        {/each}
                        <br />
                        <Button type="submit">OK</Button>
                    </form>
                </dialog>
            {/if}
            <!-- <h1>{mix?'Edit mix':'Add Mix'}</h1> -->

            <form onsubmit={addMix} class="flex flex-col gap-y-6">
                <div class="flex justify-between">
                    <Button class=" w-fit !bg-secondary-600 !text-uiGray-50 hover:bg-secondary-400">
                        <Link href={route('home')} class="flex items-center gap-1 ">
                            <Icon icon="mdi:arrow-left-circle" class="mb-[2px] size-4" />
                            Back to Mixes / Cancel
                        </Link>
                    </Button>
                </div>

                <div
                    class="flex w-fit flex-1 flex-row flex-wrap items-center justify-start gap-3 md:justify-start"
                >
                    <Input
                        type="text"
                        bind:value={$form.name}
                        placeholder="Title"
                        class="w-fit !min-w-64 flex-1 border !border-uiGray-400 !py-1 font-primary !text-2xl !font-bold text-black"
                        wrapperClass="!justify-start !w-[320px] "
                        label={'*Title'}
                        error={errors?.name}
                    />
                </div>

                <div class="flex min-h-56 flex-wrap items-stretch justify-stretch gap-6">
                    <div
                        ondrop={handleDrop}
                        ondragover={(e) => e.preventDefault()}
                        ondragenter={(e) => e.preventDefault()}
                        aria-label="File upload dropzone"
                        role="region"
                        class="flex h-fit w-full flex-col items-center justify-start rounded-md bg-uiDark-600 md:h-auto md:w-fit"
                    >
                        <FileUpload class="h-auto w-96">
                            {#snippet children(fileUpload)}
                                <input
                                    accept="image/*"
                                    {...fileUpload.input}
                                    type="file"
                                    onchange={handleImage}
                                />
                                <div
                                    {...fileUpload.dropzone}
                                    class="relative flex h-[250px] w-[300px] max-w-full items-center justify-center overflow-hidden rounded-md border border-dashed border-white bg-uiDark-500 p-4 text-center"
                                >
                                    {#if $form.avatar}
                                        <img
                                            ref="image"
                                            bind:this={image}
                                            alt=""
                                            src={typeof $form.avatar === 'string'
                                                ? $form.avatar
                                                : undefined}
                                            class="-z-1 absolute left-0 top-0 h-full w-full border-none object-cover"
                                        />
                                    {:else}
                                        <div
                                            class="absolute bottom-4 h-fit w-fit text-sm font-light"
                                        >
                                            no image selected, will use a fallback
                                        </div>
                                    {/if}

                                    <div
                                        class="z-2 relative h-fit w-fit rounded-md p-4 backdrop-blur-md"
                                    >
                                        {#if fileUpload.isDragging}
                                            Drop files here
                                        {:else}
                                            Click <span class="hidden sm:inline">or drag</span> to
                                            upload
                                            <br />
                                            <span class="text-sm font-light"
                                                >(max 2mb, allowed types: jpeg,png,jpg,svg)</span
                                            >
                                        {/if}
                                    </div>
                                </div>
                            {/snippet}
                        </FileUpload>
                        <Input
                            label="&nbsp; Imgage source link (optional)"
                            type="text"
                            bind:value={$form.img_source}
                            placeholder="http://www.imagesource.com"
                            wrapperClass="!p-2 w-full gap-y-1 mt-4 flex-row col-span-1 lg:col-span-2"
                            class=" text-black"
                            min="0"
                        />
                        {#if errors?.avatar}
                            <div class="error h-fit max-w-48 text-wrap px-4 py-2 text-danger-300">
                                <Icon
                                    icon="tabler:exclamation-circle-filled"
                                    class="mb-[4px] inline size-4"
                                />
                                {errors?.avatar}
                            </div>
                        {/if}
                    </div>

                    <div class="flex w-[300px] max-w-full flex-1 flex-col gap-4">
                        <div class="box flex h-full flex-col gap-4">
                            <h3 class="">Ingredients</h3>

                            <div
                                use:autoAnimate
                                class="grid w-full grid-cols-1 items-end gap-2 lg:grid-cols-12"
                            >
                                <div class="col-span-1 hidden lg:col-span-2 lg:block">Quantity</div>
                                <div class="col-span-1 hidden lg:col-span-3 lg:block">Measure</div>
                                <div class="col-span-1 hidden lg:col-span-4 lg:block">Name</div>
                                <div class="col-span-1 hidden lg:col-span-2 lg:block">Optional</div>
                                {#each $form.ingredients as ingredient, index}
                                    <Input
                                        label="Quantity"
                                        labelMobileOnly
                                        type="number"
                                        bind:value={ingredient.quantity}
                                        placeholder="Quantity"
                                        wrapperClass="col-span-1 lg:col-span-2"
                                        class=" text-black"
                                        min="0"
                                        step=".25"
                                    />
                                    <Input
                                        label="Measure"
                                        labelMobileOnly
                                        options={measures.data}
                                        type="select"
                                        bind:value={ingredient.measure_id}
                                        placeholder="Measure"
                                        wrapperClass="col-span-1 lg:col-span-3"
                                        class=" text-black"
                                    />
                                    <Input
                                        label="Name"
                                        labelMobileOnly
                                        type="text"
                                        bind:value={ingredient.name}
                                        wrapperClass="col-span-1 lg:col-span-4"
                                        placeholder="Name"
                                        class="w-64 flex-1 text-black"
                                    />
                                    <div class="flex items-center">
                                        <span class="block sm:hidden">optional </span><input
                                            type="checkbox"
                                            bind:checked={ingredient.optional}
                                            class="checkbox mb-2 ml-2"
                                        />
                                    </div>
                                    <Button
                                        type="button"
                                        onclick={() => {
                                            $form.ingredients.splice(index, 1);
                                            $form.ingredients = $form.ingredients;
                                        }}
                                        class="col-span-1 w-fit !bg-transparent !text-danger-200 lg:col-span-2"
                                    >
                                        <Icon icon="mdi:trash" class="mb-[2px] size-3" />
                                        Remove
                                    </Button>
                                {/each}
                            </div>
                            <Button
                                type="button"
                                onclick={() => {
                                    if ($form.ingredients.length < 40) {
                                        $form.ingredients.push({
                                            quantity: '',
                                            measure_id: '',
                                            name: ''
                                        }),
                                            ($form.ingredients = $form.ingredients);
                                    } else {
                                        alert('too many ingredients!');
                                    }
                                }}
                                class="w-fit !bg-transparent !bg-opacity-100 px-0 !text-white outline-2 !outline-uiDark-200"
                            >
                                <Icon
                                    icon="mdi:plus-circle"
                                    class="mb-[2px]  !text-lg text-success-400"
                                />
                                Add new Ingredient
                            </Button>

                            {#if errors?.ingredients}
                                <div class="error">{errors.ingredients}</div>
                            {/if}
                        </div>
                    </div>
                </div>

                <div class="box flex !h-fit flex-col gap-y-4">
                    <div>Description</div>
                    <Switch
                        text="Show Rich Text Editor"
                        switchClass="scale-75"
                        bind:checked={richText}
                    ></Switch>
                    {#if !richText}
                        <Input
                            type="textArea"
                            bind:value={$form.description}
                            placeholder="Description"
                            wrapperClass="!max-w-full"
                            class="h-fit !p-4 text-black"
                            error={errors.description}
                        />
                    {:else}
                        <RichTextTipTap bind:value={$form.description} />
                    {/if}
                </div>

                <div class="box flex items-center gap-2">
                    <Input
                        label="*Cuisine"
                        type="select"
                        options={cuisines.data}
                        bind:value={$form.cuisine_id}
                        placeholder="Cuisine"
                        class="text-black"
                        error={errors.cuisine_id}
                    />
                    <a href="/cuisines" target="_blank" class="underline">Manage cuisines</a>
                </div>
                <div class="box flex flex-wrap gap-4">
                    <Input
                        label="Source link (optional)"
                        labelClass="w-full"
                        type="text"
                        bind:value={$form.source_url}
                        placeholder="Source url"
                        class="!w-full text-black"
                        error={errors.source_url}
                        wrapperClass="flex-wrap"
                    />
                    <Input
                        label="Source name (optional)"
                        type="text"
                        bind:value={$form.source_name}
                        placeholder="Source name"
                        class="w-full text-black"
                        error={errors.source_name}
                    />
                </div>
                <div class="w-full p-2 text-right font-light">
                    By uploading my content I agree to the
                    <a href="/uploadTerms" target="_blank" class="tab-link-class underline">
                        upload terms and conditions
                    </a>
                    and
                    <a href="/generalTerms" target="_blank" class="tab-link-class underline">
                        general terms and conditions
                    </a>
                    <input type="checkbox" bind:checked={termsAccepted} class="checkbox ml-2" />
                </div>

                <div class="flex flex-wrap justify-between gap-2">
                    <Button class=" w-fit !bg-secondary-600 !text-uiGray-50 hover:bg-secondary-400">
                        <Link href={route('home')} class="flex items-center gap-1 ">
                            <Icon icon="mdi:arrow-left-circle" class="mb-[2px] size-4" />
                            Back to Mixes / Cancel
                        </Link>
                    </Button>
                    <Tooltip triggeredBy="#submitbutton">
                        {termsAccepted === false ? 'Please accept the terms' : ''}</Tooltip
                    >
                    {#if mix?.data?.id}
                        <Button
                            onclick={(e) => {
                                e.preventDefault(), removeMix();
                            }}
                            class="h-auto w-fit text-nowrap !bg-danger-500 !text-white"
                        >
                            <Icon icon="mdi:trash" class="mb-1 size-5" />
                            Delete mix
                        </Button>
                    {/if}

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
                </div>
            </form>
        </div>
    {:else}
        Nope, manually typing in that url does not work :)
    {/if}
</AuthenticatedLayout>

<!-- <button onclick={deleteMix}>Delete Mix</button> -->
