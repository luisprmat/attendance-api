const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    safelist: [
        {
            pattern: /bg-(gray|indigo)-(100|700|800|900)/,
            variants: ['hover', 'active']
        },
        {
            pattern: /border-(gray|indigo)-(300|900)/,
            variants: ['hover', 'focus']
        },
        {
            pattern: /ring-(gray|indigo)-300/,
            variants: ['focus']
        },
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
