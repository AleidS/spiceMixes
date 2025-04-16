<script>
    import { fly } from 'svelte/transition';
    import Keypad from './Keypad.svelte';
    import Icon from '@iconify/svelte';

    let numberInput = '';
    let total = 0;

    // private function
    function addToEquation(value) {
        numberInput += value;
    }
    function removeFromEquation() {
        console.log(numberInput.length);
        if (numberInput.length > 0) {
            numberInput = numberInput.slice(0, -1);
        }
    }

    const clear = () => {
        total = 0;
        numberInput = '';
    };

    function calculate() {
        if (numberInput !== '') {
            numberInput = result().toString();
        }
    }

    function replaceAll(string, search, replace) {
        return string.split(search).join(replace);
    }

    function formatString(value) {
        return replaceAll(replaceAll(value, '*', 'x'), '/', '÷');
    }

    // computed
    let result = () => {
        if (!isNaN(numberInput.slice(-1))) {
            return eval(numberInput);
        }
        return eval(numberInput.slice(0, -1));
    };

    // reactive values
    $: if (numberInput !== '' && !isNaN(numberInput.slice(-1)) && numberInput != result()) {
        total = result().toString();
    }
</script>

<section class="app">
    <div class="results">
        <div class="calculations">{numberInput}</div>

        <input type="text" class="total" value={total !== 0 ? total : ''} />
    </div>

    <div class="input-pad">
        <Keypad expand="3" type="clear" clicked={clear} />

        <Keypad
            type="operator"
            clicked={(event) => {
                event.stopPropagation();
                addToEquation('/');
            }}>÷</Keypad
        >

        <Keypad
            clicked={(event) => {
                event.stopPropagation();
                addToEquation(9);
            }}>9</Keypad
        >
        <Keypad
            clicked={(event) => {
                event.stopPropagation();
                addToEquation(8);
            }}>8</Keypad
        >
        <Keypad
            clicked={(event) => {
                event.stopPropagation();
                addToEquation(7);
            }}>7</Keypad
        >

        <Keypad
            type="operator"
            clicked={(event) => {
                event.stopPropagation();
                addToEquation('*');
            }}>x</Keypad
        >
        <Keypad
            clicked={(event) => {
                event.stopPropagation();
                addToEquation(6);
            }}>6</Keypad
        >
        <Keypad
            clicked={(event) => {
                event.stopPropagation();
                addToEquation(5);
            }}>5</Keypad
        >
        <Keypad
            clicked={(event) => {
                event.stopPropagation();
                addToEquation(4);
            }}>4</Keypad
        >

        <Keypad
            type="operator"
            clicked={(event) => {
                event.stopPropagation();
                addToEquation('-');
            }}>-</Keypad
        >
        <Keypad
            clicked={(event) => {
                event.stopPropagation();
                addToEquation(3);
            }}>3</Keypad
        >
        <Keypad
            clicked={(event) => {
                event.stopPropagation();
                addToEquation(2);
            }}>2</Keypad
        >
        <Keypad
            clicked={(event) => {
                event.stopPropagation();
                addToEquation(1);
            }}>1</Keypad
        >

        <Keypad
            type="operator"
            clicked={(event) => {
                event.stopPropagation();
                addToEquation('+');
            }}>+</Keypad
        >
        <Keypad
            type="operator"
            expand="1"
            clicked={(event) => {
                event.stopPropagation();
                addToEquation('.');
            }}>.</Keypad
        >

        <Keypad
            expand="1"
            clicked={(event) => {
                event.stopPropagation();
                addToEquation(0);
            }}>0</Keypad
        >
        <Keypad
            type="operator"
            expand="1"
            class="!flex !items-center !justify-center !text-center"
            clicked={(event) => {
                event.stopPropagation();
                removeFromEquation();
            }}><Icon icon="mdi:backspace" class="inline" /></Keypad
        >

        <Keypad
            type="equal"
            clicked={(event) => {
                event.stopPropagation();
                calculate();
            }}>=</Keypad
        >
    </div>
</section>

<style>
    .app {
        max-width: 220px;
        @apply h-fit rounded-lg bg-uiDark-400 p-1;
    }

    .input-pad {
        display: grid;
        grid-template-columns: repeat(4, 24%);
        grid-template-rows: repeat(5, 19%);
        grid-column-gap: 4px;
        grid-row-gap: 4px;
        @apply overflow-hidden rounded-md p-2;
    }

    .results {
        display: flex;
        flex-direction: column;
        text-align: right;
        @apply h-fit min-h-28 w-full rounded-md !bg-uiDark-600 bg-black p-2 text-base text-white;
    }

    .calculations {
        color: #828282;

        @apply h-fit min-h-10 w-full rounded-sm !bg-uiDark-600 p-2 text-white;
    }

    .total {
        text-align: right;
        padding: 10px;
        font-size: 18px;
        margin: 0;
        border: none;
        @apply h-fit w-full bg-uiDark-800 text-white;
    }
</style>
