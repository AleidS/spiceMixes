<script>
    export let left = 100;
    export let top = 100;

    $: left = window.innerWidth / 2 - elementWidth / 2;
    $: top = window.innerHeight / 2 - elementHeight / 2;

    let element;

    $: {
        if (element) {
            const rect = element.getBoundingClientRect();
            elementWidth = rect.width;
            elementHeight = rect.height;
        }
    }

    let elementWidth = 100; // Default width of the draggable element
    let elementHeight = 100; // Default height of the draggable element

    let moving = false;

    function onMouseDown() {
        moving = true;
    }

    function onMouseMove(e) {
        if (moving) {
            left += e.movementX;
            top += e.movementY;
        }
    }

    function onMouseUp() {
        moving = false;
    }

    // 	$: console.log(moving);
</script>

<section
    on:touchstart={onMouseDown}
    on:mousedown={onMouseDown}
    style="left: {left}px; top: {top}px;"
    class="draggable"
    bind:this={element}
>
    <slot></slot>
</section>

<svelte:window
    on:touchend={onMouseUp}
    on:mouseup={onMouseUp}
    on:touchmove={onMouseMove}
    on:mousemove={onMouseMove}
/>

<style>
    .draggable {
        user-select: none;
        cursor: move;
        position: absolute;
    }
</style>
