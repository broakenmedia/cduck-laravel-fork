const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'java-bean': {
                    '50': '#f9f6ed',
                    '100': '#f0e7d1',
                    '200': '#e2cfa6',
                    '300': '#d1af73',
                    '400': '#c3934c',
                    '500': '#b4803e',
                    '600': '#9b6433',
                    '700': '#824f2e',
                    '800': '#683f2b',
                    '900': '#5a3629',
                    '950': '#341c14',
                },
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
