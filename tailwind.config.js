import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.svelte',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                'primary': ['Josefin Sans', 'sans-serif'],
                'secondary': ['Zilla Slab', 'serif'],
            },
            // https://tailcolor.com/ to easily get color palette!
            // https://www.tints.dev/purple/D08152 to generate
            colors: {
                "primary": { 
                    50: "#FDF3EC", 
                    100: "#FAE3D6", 
                    200: "#F3CBB4", 
                    300: "#EAB18F", 
                    400: "#E09971", 
                    500: "#D08152", 
                    600: "#C1612A", 
                    700: "#92471B", 
                    800: "#662F10", 
                    900: "#321606", 
                    950: "#1C0C02" 
                },
                'secondary':{
                    "50": "#ecf4f3",
                    "100": "#d9e8e7",
                    "200": "#b3d1d0",
                    "300": "#8cbab8",
                    "400": "#66a3a1",
                    "500": "#408c89",
                    "600": "#33706e",
                    "700": "#265452",
                    "800": "#1a3837",
                    "900": "#0d1c1b"    
                },
                 'uiGray':{
                    50: "#F0F0EF",
                    100: "#E2E0DF",
                    200: "#C7C4C1",
                    300: "#AAA5A1",
                    400: "#908884",
                    500: "#716A66",
                    600: "#534E4B",
                    700: "#33302E",
                    800: "#23211F",
                    900: "#100F0F",
                    950: "#080807"
                    },
                'uiDark':{
                   50: "#D2B8A7",
                    100: "#C3A998",
                    200: "#A78A77",
                    300: "#7F6A5C",
                    400: "#594D45",
                    500: "#33302E",
                    600: "#2B2522",
                    700: "#211B18",
                    800: "#191410",
                    900: "#0D0A08",
                    950: "#070503"
                },
                'uiGray2':{
                    50: "#F3F2F2",
                    100: "#E7E5E4",
                    200: "#CFCBC9",
                    300: "#B6B2AF",
                    400: "#9E9894",
                    500: "#837C76",
                    600: "#69625E",
                    700: "#4E4946",
                    800: "#33302E",
                    900: "#1B1918",
                    950: "#0D0D0C"
            }

                
        }
        },
         
    },

    plugins: [forms],
};
