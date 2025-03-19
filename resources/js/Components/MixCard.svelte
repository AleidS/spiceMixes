<script>
    let { children, class: className, mix, ...attrs } = $props();
</script>
 <div
    class="group relative col-span-1 overflow-hidden rounded-lg border-[1px] border-uiGray-500 bg-uiDark-700 transition duration-200 ease-out hover:brightness-105 md:p-4"
>
    <div
        class="absolute bottom-0 z-20 left-0 w-full bg-primary-900 bg-opacity-10 p-4 text-center font-secondary text-3xl font-light text-white backdrop-blur-md backdrop-brightness-50"
    >
        {mix.name}
    </div>

    <div class="h-[300px] md:h-[180px] lg:h-[220px] overflow-hidden object-cover !z-0">
        <img
            src={mix.avatar}
            alt="{mix.name}"
            class="group-hover:scale-x-105 group-hover:scale-y-105 duration-100 transition-all !z-0 max-h-full min-h-full min-w-full max-w-full rounded-md object-cover object-center"
        />
    </div>
</div>