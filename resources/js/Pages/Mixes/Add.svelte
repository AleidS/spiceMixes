<script>
    // import { page, useForm } from '@inertiajs/svelte';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';
    import { router, page, useForm } from '@inertiajs/svelte';
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

    $effect(()=>{
        console.log(mix?.data)
        if (mix?.data){
            $form.name = mix.data.name;
            $form.ingredients = mix.data.ingredients;
            $form.description = mix.data.description;
            $form.user_id = mix.data.user_id;
            $form.cuisine_id = mix.data.cuisine_id;
            $form.avatar = mix.data.avatar
        }
    })

    let image;
    const reader = new FileReader();
    reader.addEventListener('load', function () {
        image.setAttribute('src', reader.result);
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
    }
    async function addMix(event) {
        preventEffect = true;
        event.preventDefault();
        // This means that the avatar has not been updated (in which case it would be a file)
        if (typeof $form.avatar == 'string') {
           delete $form.avatar
        }
        let formData = { ...$form };
        formData.ingredients = JSON.stringify(formData.ingredients); // Convert ingredients to JSON string

        // Send a put request with the modified form data if we are editing
        if (mix?.data){
            formData.put(`/mixes/${mix.data.id}`, mix.data.id);
        }
        //Else send the entire thing as a post request for a new row
        else{
            formData.post('/mixes')
        }
    }
</script>

<svelte:head>
    <title>Add a mix</title>
</svelte:head>
<AuthenticatedLayout>
    {#if mix?.data?.editable!=false}
    <div class="page">
        <!-- <h1>{mix?'Edit mix':'Add Mix'}</h1> -->

        <form onsubmit={addMix} class="flex flex-col gap-y-6">
            {mix?.data?.editable}
            {mix?.data?.user_id}
            
           <div class='flex gap-3 justify-start md:justify-between flex-row-reverse flex-wrap items-center'>
             <Button 
                    type="submit" 
                    class="w-fit h-auto text-nowrap !bg-primary-500 !text-white">
                    
                    <Icon icon='mdi:floppy' class='size-5 mb-1'/>
                    {mix?'Save mix':'Add Mix'}
                </Button>
                <Input
                    type="text"
                    bind:value={$form.name}
                    placeholder="Title"
                    class="!w-64 text-black !text-2xl !py-1 font-primary !font-bold border !border-uiGray-400"
                    wrapperClass="!justify-start !w-[300px]"
                    label={mix?null:'Title'}
                    
                    error={errors?.name}
                />
               
           </div>


            <div class="flex min-h-56 flex-wrap items-stretch gap-6 justify-stretch">
                <div class='md:h-auto h-fit flex flex-col justify-start w-full md:w-fit bg-uiDark-600 rounded-md items-center'>
                    <FileUpload class="h-auto w-96" onSelectedChange={handleImage}>
                        {#snippet children(fileUpload)}
                            <input accept="image/*" {...fileUpload.input} type="file" onchange={handleImage}  />
                            <div
                                {...fileUpload.dropzone}
                                class="relative flex h-[250px] w-[300px] max-w-full items-center justify-center rounded-md border border-dashed border-white bg-uiDark-500 p-4 text-center overflow-hidden"
                            >
                                {#if $form.avatar}
                                    <img
                                        bind:this={image}
                                        src={$form.avatar}
                                        alt=""
                                        class="-z-1 absolute left-0 top-0 h-full w-full border-none object-cover"
                                    />
                                {/if}
                                <div class="z-2 relative h-fit w-fit rounded-md p-4 backdrop-blur-md">
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
                <div class="flex flex-1 flex-col gap-4 w-[300px] max-w-full">
                    <div class="box h-full flex flex-col gap-4">
                        <h3 class="">Ingredients</h3>

                        <div use:autoAnimate class="grid grid-cols-1 lg:grid-cols-12 gap-2 w-full items-end">
                                    <div class="col-span-1 lg:col-span-2 hidden lg:block">Quantity</div>
                                    <div class="col-span-1 lg:col-span-3 hidden lg:block">Measure</div>
                                    <div class="col-span-1 lg:col-span-5 hidden lg:block">Name</div>
                                     <div class="col-span-1 lg:col-span-2 hidden lg:block"></div>
                            {#each $form.ingredients as ingredient, index}
 
                                    <Input
                                        label='Quantity'
                                        labelMobileOnly
                                        type="number"
                                        bind:value={ingredient.quantity}
                                        placeholder="Quantity"
                                        wrapperClass="col-span-1 lg:col-span-2"
                                        class=" text-black"
                                        min="0"
                                    />
                                    <Input
                                        label='Measure'
                                        labelMobileOnly
                                        options={measures.data}
                                        type="select"
                                        bind:value={ingredient.measure_id}
                                        placeholder="Measure"
                                        wrapperClass="col-span-1 lg:col-span-3"
                                        class=" text-black"
                                    />
                                    <Input
                                        label='Name'
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
                                        class="!bg-transparent !text-danger-100 col-span-1 lg:col-span-2 w-fit"
                                    >
                                        <Icon icon="mdi:trash" class="mb-[2px] size-3" />
                                        Remove
                                    </Button>
                            
                            {/each}
                            
                        </div>
                        <Button
                                type="button"
                                onclick={() => {
                                    $form.ingredients.push({ quantity: '', measure_id: '', name: '' }),
                                        ($form.ingredients = $form.ingredients);
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

            <div class='box'>
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

           <div class='box'>
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

            <Button type="submit" class="w-fit !bg-primary-500 !text-white">{mix?'Save mix':'Add Mix'}</Button>
        </form>
    </div>
      {:else}
           Nope, manually typing in that url does not work :) 
    {/if}
</AuthenticatedLayout>

<!-- <button onclick={deleteMix}>Delete Mix</button> -->
