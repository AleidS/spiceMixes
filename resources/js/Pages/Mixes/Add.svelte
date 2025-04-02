<script>
    // import { page, useForm } from '@inertiajs/svelte';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';
    import { router, page, useForm, Link } from '@inertiajs/svelte';
    import autoAnimate from '@formkit/auto-animate';
    import Button from '@/Components/Button.svelte';
    import Input from '@/Components/Input.svelte';
    import Icon from '@iconify/svelte';

    import { FileUpload } from 'melt/components';
    import { writable } from 'svelte/store';

    // let fileUpload;

    let { mix, errors, measures, cuisines } = $props();

    const form = useForm({
        name: '',
        ingredients: [{ quantity: null, measure_id: null, name: null }],
        description: '',
        user_id: $page.props.auth.user.id,
        cuisine_id: null,
        avatar: null
    });

    $effect(() => {
        console.log(mix?.data);
        if (mix?.data) {
            $form.name = mix.data.name;
            $form.ingredients = mix.data.ingredients;
            $form.description = mix.data.description;
            $form.user_id = mix.data.user_id;
            $form.cuisine_id = mix.data.cuisine_id;
            $form.avatar = mix.data.avatar;
        }
    });

    let image;
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
            form.avatar = files[0];
            reader.readAsDataURL(files[0]);
        }
        console.log(form.avatar);
    }
    async function addMix(event) {
        preventEffect = true;
        event.preventDefault();
        // This means that the avatar has not been updated (in which case it would be a file)
        if (typeof $form.avatar == 'string') {
            delete $form.avatar;
        }
        let formData = { ...$form };
        formData.ingredients = JSON.stringify(formData.ingredients); // Convert ingredients to JSON string

        // Send a put request with the modified form data if we are editing
        if (mix?.data) {
            formData.put(`/mixes/${mix.data.id}`, mix.data.id);
        }
        //Else send the entire thing as a post request for a new row
        else {
            formData.post('/mixes');
        }
    }
</script>

<svelte:head>
    <title>Add a mix</title>
</svelte:head>
<AuthenticatedLayout>
    {#if mix?.data?.editable != false}
        <div class="page">
            <!-- <h1>{mix?'Edit mix':'Add Mix'}</h1> -->

            <form onsubmit={addMix} class="flex flex-col gap-y-6">
           <div class='flex justify-between'>
                     <Button class=" !bg-secondary-600 !text-uiGray-50 hover:bg-secondary-400 w-fit">
                        <Link href={route('home')} class="flex items-center gap-1 ">
                            <Icon icon="mdi:arrow-left-circle" class="mb-[2px] size-4" />
                            Back to Mixes
                        </Link>
                    </Button>
                    <Button
                        type="submit"
                        primary
                        class="h-auto w-fit text-nowrap !text-white"
                    >
                        <Icon icon="mdi:floppy" class="mb-1 size-5" />
                        {mix ? 'Save mix' : 'Add Mix'}
                    </Button>
                 </div>     
                <div
                    class="flex flex-1 flex-row flex-wrap items-center justify-start gap-3 md:justify-between"
                >

                    <Input
                        type="text"
                        bind:value={$form.name}
                        placeholder="Title"
                        class="!min-w-64 flex-1 border !border-uiGray-400 !py-1 font-primary !text-2xl !font-bold text-black"
                        wrapperClass="!justify-start !w-[300px]"
                        label={mix ? null : 'Title'}
                        error={errors?.name}
                    />
                </div>

                <div class="flex min-h-56 flex-wrap items-stretch justify-stretch gap-6">
                    <div
                        class="flex h-fit w-full flex-col items-center justify-start rounded-md bg-uiDark-600 md:h-auto md:w-fit"
                    >
                        <FileUpload class="h-auto w-96" onSelectedChange={handleImage}>
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
                                            src={$form.avatar}
                                            alt=""
                                            class="-z-1 absolute left-0 top-0 h-full w-full border-none object-cover"
                                        />
                                    {/if}
                                    <div
                                        class="z-2 relative h-fit w-fit rounded-md p-4 backdrop-blur-md"
                                    >
                                        {#if fileUpload.isDragging}
                                            Drop files here
                                        {:else}
                                            Click to upload or drag and drop
                                        {/if}
                                    </div>
                                </div>
                            {/snippet}
                        </FileUpload>
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
                                <div class="col-span-1 hidden lg:col-span-5 lg:block">Name</div>
                                <div class="col-span-1 hidden lg:col-span-2 lg:block"></div>
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
                                        wrapperClass="col-span-1 lg:col-span-5"
                                        placeholder="Name"
                                        class="w-64 flex-1 text-black"
                                    />
                                    <Button
                                        type="button"
                                        onclick={() => {
                                            $form.ingredients.splice(index, 1);
                                            $form.ingredients = $form.ingredients;
                                        }}
                                        class="col-span-1 w-fit !bg-transparent !text-danger-100 lg:col-span-2"
                                    >
                                        <Icon icon="mdi:trash" class="mb-[2px] size-3" />
                                        Remove
                                    </Button>
                                {/each}
                            </div>
                            <Button
                                type="button"
                                onclick={() => {
                                    if ($form.ingredients.length<40){
                                    $form.ingredients.push({
                                        quantity: '',
                                        measure_id: '',
                                        name: ''
                                    }),
                                        ($form.ingredients = $form.ingredients);
                                    }
                                    else{
                                        alert('too many ingredients!')
                                    }
                                }}
                                class="w-fit !bg-success-400 !bg-opacity-50 !text-white"
                            >
                                <Icon icon="mdi:plus-circle" class="mb-[2px] size-3" />
                                Add
                            </Button>

                            {#if errors?.ingredients}
                                <div class="error">{errors.ingredients}</div>
                            {/if}
                        </div>
                    </div>
                </div>

                <div class="box">
                    <Input
                        label="Description"
                        type="textArea"
                        bind:value={$form.description}
                        placeholder="Description"
                        wrapperClass="!max-w-full"
                        class="!p-4 text-black"
                        error={errors.description}
                    />
                </div>

                <div class="box">
                    <Input
                        label="Cuisine"
                        type="select"
                        options={cuisines.data}
                        bind:value={$form.cuisine_id}
                        placeholder="Cuisine"
                        class="text-black"
                        error={errors.cuisine_id}
                    />
                </div>

                <!-- <ImageInput bind:files={$form.avatar} onchange={console.log($form.avatar)} /> -->
                <!-- <input
                type="file"
                id="avatar"
                bind:files={$form.avatar}
                {...fileUpload.input}
                class="border-uiGray-300 mt-1 block w-full rounded-md border px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
            />
    
            <div
                class="flex h-40 w-40 items-center justify-center border border-dashed border-white text-center text-white"
                {...fileUpload.dropzone}
            >
                {$form.avatar?.name}
                <img src={form.avatar} alt="" />
                {#if fileUpload.isDragging}
                    Drop files here
                {:else}
                    Click to upload or drag and drop
                {/if}
            </div> -->

                 <div class='flex justify-between'>
                     <Button class=" !bg-secondary-600 !text-uiGray-50 hover:bg-secondary-400 w-fit">
                        <Link href={route('home')} class="flex items-center gap-1 ">
                            <Icon icon="mdi:arrow-left-circle" class="mb-[2px] size-4" />
                            Back to Mixes
                        </Link>
                    </Button>
                    <Button
                        type="submit"
                        primary
                        class="h-auto w-fit text-nowrap !text-white"
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
