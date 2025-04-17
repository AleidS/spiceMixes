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

    export function wholeAndFraction(float,maxDenominator=4) {
        let integerPart = Math.floor(float);
        const decimalPart = float - integerPart;
        const [numerator, denominator] = approximateFraction(decimalPart, maxDenominator);
        const floatFraction = (numerator !== 0 && numerator!=denominator) ? `${numerator}/${denominator}` : '';
        if (numerator==denominator) {
            integerPart+=1
        }
        return `${integerPart >= 1 ? integerPart : ''}${floatFraction ? ' ' : ''}${floatFraction}`;
    }

    export const useOriginals = writable(false);

    export function switchOriginals(){
        useOriginals.update((value) =>! value);
        // To trigger the quantities to update.. workaround
         multiplier.update((value) => value+1);
         multiplier.update((value) => value-1);
    }


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

    export function toMl(quantity, unit){
        if (unit === 'Ts') {
                return quantity * 5;
            } else if (unit === 'Tbsp') {
               return quantity * 15;
            } else if (unit === 'Cups') {
                return  quantity * 240;
            } 
            else if (unit==='pinches'){
                return quantity *0.315
            }
            else if (unit === 'dl') {
                return  quantity * 100;
            } else if (unit === 'l') {
                return quantity * 1000;
            }
           
            else if (unit === 'ml') {
                return quantity * 1;
            }
    }
    export function mlStandardized(ml, of=true){
        if (ml > 
            10000){
            return(`a truckload ${of?'of':''}`);
        }
        if (ml > 150) {
           return(`${wholeAndFraction(ml / 240,4)} Cups`);
        } else if (ml > 10) {
            return(`${wholeAndFraction(ml / 15,4)} Tbsp`);
        } else if (ml > 1.2) {
           return(`${wholeAndFraction(ml / 5,4)} Ts`);
        } else if (ml>=0.05){
            return(`${wholeAndFraction(ml / 0.315,4)} Pinches`)
        }else{
           return(`no${of?'':'t'} detectable`);
        }
    }

    //To ensure this is updated when multiplier changes, the multiplier is in the ingredient view
    export function transformIngredient(quantity,unit){
        //if user wants to use original units or unit is not a volume measure;
        if (get(useOriginals) || !(['Tbsp','Ts','Cups','dl','l','ml']).includes(unit)){
            return(`${wholeAndFraction(quantity)} ${unit}`);
        }
        else {
            let ml = toMl(quantity, unit)
            let totalMl = ml;
            return(mlStandardized(totalMl));
        }
    }

    export function calculateTotals(mix, measures) {
        let newTotal = 0;
        mix.data.ingredients.forEach((ingredient) => {
            const measure = measures.data.find((m) => m.id == ingredient.measure_id);
            if (!measure) return;
            newTotal += toMl(ingredient.quantity, measure.name)??0;
        });
        newTotal*=get(multiplier)
        console.log(newTotal)
        totalStr.set(mlStandardized(newTotal,false))
    }