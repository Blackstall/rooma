import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import animate from 'tailwindcss-animate';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans], // Use Inter font
            },
            colors: {
                primary: {
                    DEFAULT: '#FF6B35', // Main orange
                    50: '#FFF5F2', // Lightest
                    100: '#FFE5DE',
                    200: '#FFC5B5',
                    300: '#FFA58C',
                    400: '#FF855C',
                    500: '#FF6B35', // Default
                    600: '#E65A2B',
                    700: '#CC4A22', // Darkest
                },
                secondary: {
                    DEFAULT: '#3D405B', // Dark blue for accents
                    50: '#F4F4F6',
                    100: '#E8E9ED',
                    200: '#C6C8D5',
                    300: '#A3A7BD',
                    400: '#616784',
                    500: '#3D405B', // Default
                    600: '#373A53',
                    700: '#2E3145',
                },
                accent: {
                    DEFAULT: '#F4F1DE', // Light beige for backgrounds
                    100: '#FDFCF8',
                    200: '#FAF8F1',
                    300: '#F7F5EA',
                    400: '#F4F1DE', // Default
                    500: '#E8E5D2',
                    600: '#DCD9C6',
                    700: '#D0CDBA',
                },
            },
            boxShadow: {
                'primary': '0 4px 14px 0 rgba(255, 107, 53, 0.2)', // Orange shadow
                'secondary': '0 4px 14px 0 rgba(61, 64, 91, 0.2)', // Dark blue shadow
            },
            animation: {
                'fade-in': 'fadeIn 0.3s ease-in-out',
                'slide-up': 'slideUp 0.3s ease-in-out',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideUp: {
                    '0%': { transform: 'translateY(20px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' },
                },
            },
        },
    },

    plugins: [
        forms, // Form plugin for Tailwind
        typography, // Typography plugin for rich text
        animate, // Animation plugin
    ],
};