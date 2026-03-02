import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#f4faec',
                    100: '#e5f4d4',
                    200: '#cceaa8',
                    300: '#aadd74',
                    400: '#8bcb45',
                    500: '#73b500',
                    600: '#20a306',
                    700: '#1b8a05',
                    800: '#176f04',
                    900: '#135c05',
                },
            },
        },
    },

    plugins: [forms],
};
