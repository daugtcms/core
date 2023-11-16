import colors from "tailwindcss/colors.js";
import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    './vendor/wire-elements/pro/config/wire-elements-pro.php',
    './vendor/wire-elements/pro/**/*.blade.php',
  ],
  theme: {
    extend: {
      colors: {
        'primary': colors.amber,
        'danger': colors.red,
      },
    },
    container: {
      // you can configure the container to be centered
      center: true,

      // or have default horizontal padding
      padding: '1rem',

      // default breakpoints but with 40px removed
      screens: {
        sm: '600px',
        md: '728px',
        lg: '984px',
        xl: '1240px',
      },
    },
  },
  plugins: [forms],
}

