    // Refer to docs; https://svelte.dev/docs/svelte/stores

    import { writable, get } from 'svelte/store';


    export function approximateFraction(decimal, maxDenominator) {
        let numerator = 1;
        let denominator = 1;
        let minError = Math.abs(decimal - numerator / denominator);

        for (let d = 2; d <= maxDenominator; d++) {
            const n = Math.round(decimal * d);
            const error = Math.abs(decimal - n / d);

            if (error < minError) {
                minError = error;
                numerator = n;
                denominator = d;
            }
        }

        return [numerator, denominator];
    }

    export function wholeAndFraction(float) {
        const integerPart = Math.floor(float);
        const decimalPart = float - integerPart;
        const [numerator, denominator] = approximateFraction(decimalPart, 10);
        const floatFraction = numerator !== 0 ? `${numerator}/${denominator}` : '';
        return `${integerPart >= 1 ? integerPart : ''}${floatFraction ? ' ' : ''}${floatFraction}`;
    }

    export const total = writable(0);
    export const cups = writable(0);
    export const tbsp = writable(0);
    export const ts = writable(0);
    export const multiplier = writable(1);
    export let totalStr = writable('');;

    export function double(mix, measures) {
        multiplier.update((value) => value * 2);
        console.log(get(multiplier))
        calculateTotals(mix, measures, get(multiplier));
    }

    export function half(mix, measures) {
        multiplier.update((value) => value / 2);
        console.log(get(multiplier))
        calculateTotals(mix, measures, get(multiplier));
    }

    export function original(mix, measures) {
        multiplier.set(1);
        console.log(get(multiplier))
        calculateTotals(mix, measures, get(multiplier));
    }


    export function calculateTotals(mix, measures) {
        let newTotal = 0;
        mix.data.ingredients.forEach((ingredient) => {
            const measure = measures.data.find((m) => m.id == ingredient.measure_id);
            if (!measure) return;

            if (measure.name === 'Ts') {
                newTotal += ingredient.quantity * 5;
            } else if (measure.name === 'Tbsp') {
                newTotal += ingredient.quantity * 15;
            } else if (measure.name === 'Cups') {
                newTotal += ingredient.quantity * 230;
            } else if (measure.name === 'dl') {
                newTotal += ingredient.quantity * 100;
            } else if (measure.name === 'l') {
                newTotal += ingredient.quantity * 1000;
            } else if (measure.name === 'ml') {
                newTotal += ingredient.quantity * 1;
            }
        });
        newTotal*=get(multiplier)
        total.set(newTotal);
        cups.set(newTotal / 230);
        tbsp.set(newTotal / 15);
        ts.set(newTotal / 5);

        if (newTotal > 150) {
            totalStr.set(`${wholeAndFraction(newTotal / 230)} cups`);
        } else if (newTotal > 15) {
            totalStr.set(`${wholeAndFraction(newTotal / 15)} tbsp`);
        } else if (newTotal > 1) {
            totalStr.set(`${wholeAndFraction(newTotal / 5)} ts`);
        } else {
            totalStr.set(`${newTotal} ml`);
        }
    }