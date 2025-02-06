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
            },
            colors: {
            "primary": {
                    "50": "#FBF4F9",
                    "100": "#F8EDF5",
                    "200": "#F0DBEC",
                    "300": "#E7C5E0",
                    "400": "#E0B3D7",
                    "500": "#D8A1CD",
                    "600": "#C26BB0",
                    "700": "#9F428C",
                    "800": "#6C2D60",
                    "900": "#361630"
                },
        }
        },
         
    },

    plugins: [forms],
};
