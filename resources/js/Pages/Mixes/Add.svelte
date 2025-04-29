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
        img_source: '',
        share_mix: false,
        share_is_original: false,
        share_name: ''
    });

    let termsAccepted = $state(false);
    $effect(() => {
        console.log(mix);
        if (mix?.data) {
            $form.name = mix.data.name;
            $form.ingredients = mix.data.ingredients;
            $form.description = mix.data.description;
            $form.user_id = mix.data.user_id;
            $form.cuisine_id = mix.data.cuisine_id;
            $form.avatar = mix.data.avatar;
            $form.img_source = mix.data.img_source;
            $form.share_mix = mix.data.share_mix ? true : false;
            $form.share_name = mix.data.share_name ?? '';
            $form.share_is_original = mix.data.share_is_original ? true : false;
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
        $form.ingredients = JSON.stringify($form.ingredients); // Convert ingredients to JSON string
        // Send a put request with the modified form data if we are editing
        if (mix?.data.id) {
            // formData.avatar = 'lalala';
            router.post(`/mixes/${mix.data.id}`, $form, {
                headers: { 'Content-Type': 'multipart/form-data' },
                preserveState: true,
                onError: () => {
                    // Parse ingredients back to an array if validation fails
                    $form.ingredients = JSON.parse($form.ingredients);
                }
            });
        }
        //Else send the entire thing as a post request for a new row
        else {
            router.post(`/mixes`, $form, {
                headers: { 'Content-Type': 'multipart/form-data' },
                preserveState: true,
                onError: () => {
                    // Parse ingredients back to an array if validation fails
                    $form.ingredients = JSON.parse($form.ingredients);
                }
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
                        class="flex h-fit w-full flex-col items-center justify-start rounded-md bg-uiDark-600 p-4 py-8 md:h-auto md:w-fit"
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

                    <div
                        class="flex min-w-[calc(min(600px,100%))] max-w-full flex-1 flex-col gap-4"
                    >
                        <div class="box flex h-full flex-col gap-4 !p-4 !py-4 md:!px-6 md:!py-6">
                            <h3 class="">Ingredients</h3>

                            <div
                                use:autoAnimate
                                class="grid w-full grid-cols-12 items-end gap-2 lg:grid-cols-11"
                            >
                                <div class="col-span-2 py-2 text-sm lg:col-span-2 lg:text-base">
                                    <div class="w-fit -rotate-45 lg:rotate-0">Quantity</div>
                                </div>
                                <div class="col-span-3 py-2 text-sm lg:col-span-3 lg:text-base">
                                    <div class="w-fit -rotate-45 lg:rotate-0">Measure</div>
                                </div>
                                <div class="col-span-5 py-2 text-sm lg:col-span-4 lg:text-base">
                                    <div class="w-fit translate-y-1 -rotate-45 lg:rotate-0">
                                        Name
                                    </div>
                                </div>
                                <div
                                    class="col-span-1 py-2 text-sm lg:col-span-2 lg:block lg:text-left lg:text-base"
                                >
                                    <div
                                        class="w-fit -translate-x-4 -rotate-45 sm:translate-x-0 lg:rotate-0"
                                    >
                                        Optional
                                    </div>
                                </div>
                                <div
                                    class="col-span-1 px-2 py-2 text-sm lg:col-span-2 lg:block lg:text-left lg:text-base"
                                >
                                    <div class="w-fit -rotate-45 lg:rotate-0"></div>
                                </div>
                                <div class="col-span-12 h-0"></div>
                                {#each $form.ingredients as ingredient, index}
                                    <div
                                        key={index}
                                        class="col-span-12 grid w-full grid-cols-12 !content-center items-center gap-1 gap-y-1 lg:col-span-11 lg:grid-cols-11"
                                    >
                                        <Input
                                            type="number"
                                            bind:value={ingredient.quantity}
                                            placeholder="Quantity"
                                            wrapperClass="col-span-2 lg:col-span-2 "
                                            class="text-black placeholder:text-transparent md:placeholder:text-uiGray-200"
                                            min="0"
                                            step=".25"
                                        />
                                        <Input
                                            options={measures.data}
                                            type="select"
                                            bind:value={ingredient.measure_id}
                                            placeholder="Measure"
                                            wrapperClass="col-span-3 lg:col-span-3"
                                            class=" text-black"
                                        />
                                        <Input
                                            type="text"
                                            bind:value={ingredient.name}
                                            wrapperClass="col-span-5 lg:col-span-4 "
                                            placeholder="Name"
                                            class=" w-64 flex-1 text-black"
                                        />
                                        <div
                                            class="relative col-span-1 flex h-full items-center justify-start px-1 lg:col-span-1 lg:translate-x-0"
                                        >
                                            <span class="hidden">optional </span><input
                                                type="checkbox"
                                                bind:checked={ingredient.optional}
                                                class="checkbox mb-2 ml-0 translate-x-1 lg:ml-2"
                                            />
                                            <button
                                                type="button"
                                                onclick={() => {
                                                    $form.ingredients.splice(index, 0, {
                                                        quantity: null,
                                                        measure_id: null,
                                                        name: null
                                                    });
                                                    $form.ingredients = $form.ingredients;
                                                }}
                                                class="!sm:justify-center absolute -left-1 bottom-5 col-span-1 flex h-full items-center !justify-end gap-1 !text-success-400"
                                            >
                                                <!-- <span class=" hidden items-center gap-2 xl:flex">
                                                    <Icon
                                                        icon="mdi:plus-circle"
                                                        class="mb-[2px] size-4"
                                                    />
                                                </span> -->
                                                <span class="n block"> + </span>
                                            </button>
                                        </div>

                                        <button
                                            type="button"
                                            onclick={() => {
                                                $form.ingredients.splice(index, 1);
                                                $form.ingredients = $form.ingredients;
                                            }}
                                            class="!sm:justify-center col-span-1 flex items-center !justify-end gap-1 !text-danger-200 lg:col-span-1 lg:translate-x-0"
                                        >
                                            <span class="hidden items-center gap-2 xl:flex">
                                                <Icon icon="mdi:trash" class="mb-[2px] size-3" />
                                                remove</span
                                            >
                                            <span class="block xl:hidden"> x </span>
                                        </button>
                                    </div>
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

                <div class="box flex flex-wrap items-center gap-6">
                    <Input
                        label="*Cuisine"
                        type="select"
                        options={cuisines.data}
                        bind:value={$form.cuisine_id}
                        placeholder="Cuisine"
                        class="text-black"
                        error={errors.cuisine_id}
                    />
                    <a href="/cuisines" target="_blank" class="w-full underline md:w-fit"
                        >Manage cuisines</a
                    >
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
                <div class="box">
                    <h4>Share this mix!</h4>
                    <p>
                        Do you want to submit this mix to be reviewed and shared on the platform <strong
                            >for all to see?</strong
                        ><br />
                    </p>
                    <Switch
                        text="Share this mix"
                        switchClass="scale-75"
                        bind:checked={$form.share_mix}
                    ></Switch>

                    <br />
                    {#if $form.share_mix}
                        <p>
                            Great! I'll review them when I have time:)
                            <br /><br />
                            <strong>Please read: </strong><br />
                            -You will not be able to edit the public version of your mix or claim any
                            rights associated with your submission <br />
                            -Details might be changed and images will not be included.<br />
                            -Only submit mixes that are your own original recipes (i.e. if it's a common
                            blend, it must be your own variation)
                            <br /><br />

                            <strong>
                                Please confirm you have read these terms and this is your own
                                original mix:
                            </strong>
                            <br />
                            <br />
                            I Agree
                            <input
                                label="this is my own original mix"
                                type="checkbox"
                                bind:checked={$form.share_is_original}
                                class="checkbox ml-2"
                            />
                        </p>

                        <br />
                        <p>
                            If you want credits (in the description) please enter your name or
                            pseudonym here. This cannot be changed or removed once accepted.
                            <br /><br />
                        </p>

                        <Input
                            label=""
                            type="text"
                            bind:value={$form.share_name}
                            placeholder="Name for credits"
                            class="w-full text-black"
                            error={errors.share_name}
                        />
                    {/if}
                </div>

                <div class="flex w-full items-center justify-end gap-2 p-2 text-right font-light">
                    <div>
                        By uploading my content I agree to the
                        <a href="/uploadTerms" target="_blank" class="tab-link-class underline">
                            upload terms and conditions
                        </a>
                        and
                        <a href="/generalTerms" target="_blank" class="tab-link-class underline">
                            general terms and conditions
                        </a>
                    </div>

                    <input type="checkbox" bind:checked={termsAccepted} class="checkbox ml-2" />
                </div>

                <div class="flex flex-wrap justify-between gap-2">
                    <Button class=" w-fit !bg-secondary-600 !text-uiGray-50 hover:bg-secondary-400">
                        <Link href={route('home')} class="flex items-center gap-1 ">
                            <Icon icon="mdi:arrow-left-circle" class="mb-[2px] size-4" />
                            Go Back / Cancel
                        </Link>
                    </Button>
                    <Tooltip triggeredBy="#submitbutton">
                        {termsAccepted === false ? 'Please accept the terms' : ''}</Tooltip
                    >

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
                <br /><br /><br /><br />
                {#if mix?.data?.id}
                    <div class="box w-fit !bg-danger-600 text-xl font-medium">
                        <Icon icon="solar:danger-triangle-bold" class="mb-2 inline" />&nbsp;Danger
                        zone
                        <br /><br />
                        <Button
                            onclick={(e) => {
                                e.preventDefault(), removeMix();
                            }}
                            class="h-auto w-fit text-nowrap !bg-danger-500 !text-white"
                        >
                            <Icon icon="mdi:trash" class="mb-1" /> Delete mix
                        </Button>
                    </div>
                {/if}
            </form>
        </div>
    {:else}
        Nope, manually typing in that url does not work :)
    {/if}
</AuthenticatedLayout>

<!-- <button onclick={deleteMix}>Delete Mix</button> -->
