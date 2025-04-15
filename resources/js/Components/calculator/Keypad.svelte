<script>
    // props
    export let expand = 1;
    export let type = 'normal';
    export let clicked = (event) => {
        console.log('I am being clicked.');
    };

    // internal state
    const typeToColor = {
        clear: '#FAD5D0',
        equal: '#000000',
        operator: '#000000',
        normal: '#FFF'
    };

    let bgColor = typeToColor[type];
</script>

<button
    class="key-pad {type == 'clear' ? '!bg-uiGray-500' : ''} {type == 'normal'
        ? '!bg-uiDark-600'
        : ''} {type == 'operator' ? '!bg-uiDark-500' : ''} 
    {type == 'equal' ? '!bg-primary-600' : ''}"
    style="grid-column: span {expand}; "
    on:click={clicked}
>
    <slot>C</slot>
</button>

<style>
    .key-pad {
        border: 1px solid #f0f0f0;
        margin: 0;
        font-size: 16px;
        @apply rounded-full border-uiGray-300 p-1;
    }
    .key-pad:active {
        @apply !bg-uiDark-400;
    }
</style>
