import colors from "tailwindcss/colors.js";
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    './vendor/laravel/framework/Daugt/Illuminate/Pagination/resources/views/*.blade.php',
    './vendor/wire-elements/modal/resources/views/*.blade.php',
    './storage/framework/views/*.php',
  ],
  safelist: [
    {
      pattern: /max-w-(sm|md|lg|xl|2xl|3xl|4xl|5xl|6xl|7xl)/,
      variants: ['sm', 'md', 'lg', 'xl', '2xl']
    }
  ],
  theme: {
    extend: {
      colors: {
        'primary': colors.emerald,
        'danger': colors.red,
        'warning': colors.amber,
        'success': colors.green,
      },
      typography: (theme) => ({
        DEFAULT: {
          css: {
            maxWidth: '100%',
            p: {
              maxWidth: theme('maxWidth.3xl'),
              marginLeft: 'auto',
              marginRight: 'auto'
            },
            h1: {
              maxWidth: theme('maxWidth.3xl'),
              margin: 'auto',
            },
            h2: {
              maxWidth: theme('maxWidth.3xl'),
              margin: 'auto',
            },
            h3: {
              maxWidth: theme('maxWidth.3xl'),
              margin: 'auto',
            },
            h4: {
              maxWidth: theme('maxWidth.3xl'),
              margin: 'auto',
            },
            blockquote: {
              maxWidth: theme('maxWidth.3xl'),
              margin: 'auto',
            },
            a: {
              color: theme('colors.primary.500'),
              '&:hover': {
                color: theme('colors.primary.600'),
              },
            },
          }
        }
      }),
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
  plugins: [forms, typography],
}

