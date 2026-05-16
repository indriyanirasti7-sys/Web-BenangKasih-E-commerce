// tailwind.config.js
import defaultTheme from 'tailwindcss/defaultTheme';

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
                sans:  ['DM Sans',         ...defaultTheme.fontFamily.sans],
                serif: ['Playfair Display', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                cream:     { DEFAULT: '#F5F0E8', dark: '#EDE6D6' },
                sage:      { DEFAULT: '#8A9E7A', dark: '#6B7F5C' },
                terra:     { DEFAULT: '#C4704F', dark: '#A85A3A' },
                mocha:     '#8B6355',
                charcoal:  '#3D3530',
                'warm-white': '#FDFAF5',
            },
            borderRadius: {
                '4xl': '2rem',
            },
        },
    },
    plugins: [
        require('@tailwindcss/line-clamp'),
    ],
};