import initUnocssRuntime from '@unocss/runtime'
import presetUno from "@unocss/preset-uno";
import presetTypography from "@unocss/preset-typography";
import {presetForms} from "@julr/unocss-preset-forms";
import presetWebFonts from "@unocss/preset-web-fonts";
import {presetIcons} from "@unocss/preset-icons/browser";

window.initializeUnoCSS = (initOptions) => {
    initUnocssRuntime({
        defaults: {
            presets: [
                presetUno(),
                presetTypography({
                    cssExtend: {
                        'p, h1, h2, h3, h4, blockquote': {
                            'max-width': '768px', // equivalent to 'maxWidth.3xl' in Tailwind
                            'margin-left': 'auto',
                            'margin-right': 'auto',
                        },
                        'a': {
                            'color': 'var(--primary-500)', // equivalent to theme('colors.primary.500')
                            '&:hover': {
                                'color': 'var(--primary-600)', // equivalent to theme('colors.primary.600')
                            },
                        },
                    },
                }),
                presetForms(),
                presetWebFonts({
                    provider: 'bunny',
                    fonts: {
                        main: initOptions?.font?.main ?? 'Inter',
                        accent: initOptions?.font?.accent ?? 'Josefin Sans',
                    }
                }),
                presetIcons({
                    collections: {
                        lucide: () => import('@iconify-json/lucide/icons.json').then(i => i.default),
                    }
                })
            ],
            theme: {
                container: {
                    center: true,
                    padding: '1rem',
                    maxWidth: {
                        sm: '600px',
                        md: '728px',
                        lg: '984px',
                        xl: '1240px',
                    },
                },
                colors: {
                    primary: {
                        50: 'rgb(var(--color-primary-50) / <alpha-value>)',
                        100: 'rgb(var(--color-primary-100) / <alpha-value>)',
                        200: 'rgb(var(--color-primary-200) / <alpha-value>)',
                        300: 'rgb(var(--color-primary-300) / <alpha-value>)',
                        400: 'rgb(var(--color-primary-400) / <alpha-value>)',
                        500: 'rgb(var(--color-primary-500) / <alpha-value>)',
                        600: 'rgb(var(--color-primary-600) / <alpha-value>)',
                        700: 'rgb(var(--color-primary-700) / <alpha-value>)',
                        800: 'rgb(var(--color-primary-800) / <alpha-value>)',
                        900: 'rgb(var(--color-primary-900) / <alpha-value>)',
                        950: 'rgb(var(--color-primary-950) / <alpha-value>)',
                    },
                    neutral: {
                        50: 'rgb(var(--color-neutral-50) / <alpha-value>)',
                        100: 'rgb(var(--color-neutral-100) / <alpha-value>)',
                        200: 'rgb(var(--color-neutral-200) / <alpha-value>)',
                        300: 'rgb(var(--color-neutral-300) / <alpha-value>)',
                        400: 'rgb(var(--color-neutral-400) / <alpha-value>)',
                        500: 'rgb(var(--color-neutral-500) / <alpha-value>)',
                        600: 'rgb(var(--color-neutral-600) / <alpha-value>)',
                        700: 'rgb(var(--color-neutral-700) / <alpha-value>)',
                        800: 'rgb(var(--color-neutral-800) / <alpha-value>)',
                        900: 'rgb(var(--color-neutral-900) / <alpha-value>)',
                        950: 'rgb(var(--color-neutral-950) / <alpha-value>)',
                    },
                    success: {
                        50: 'rgb(var(--color-success-50) / <alpha-value>)',
                        100: 'rgb(var(--color-success-100) / <alpha-value>)',
                        200: 'rgb(var(--color-success-200) / <alpha-value>)',
                        300: 'rgb(var(--color-success-300) / <alpha-value>)',
                        400: 'rgb(var(--color-success-400) / <alpha-value>)',
                        500: 'rgb(var(--color-success-500) / <alpha-value>)',
                        600: 'rgb(var(--color-success-600) / <alpha-value>)',
                        700: 'rgb(var(--color-success-700) / <alpha-value>)',
                        800: 'rgb(var(--color-success-800) / <alpha-value>)',
                        900: 'rgb(var(--color-success-900) / <alpha-value>)',
                        950: 'rgb(var(--color-success-950) / <alpha-value>)',
                    },
                    warning: {
                        50: 'rgb(var(--color-warning-50) / <alpha-value>)',
                        100: 'rgb(var(--color-warning-100) / <alpha-value>)',
                        200: 'rgb(var(--color-warning-200) / <alpha-value>)',
                        300: 'rgb(var(--color-warning-300) / <alpha-value>)',
                        400: 'rgb(var(--color-warning-400) / <alpha-value>)',
                        500: 'rgb(var(--color-warning-500) / <alpha-value>)',
                        600: 'rgb(var(--color-warning-600) / <alpha-value>)',
                        700: 'rgb(var(--color-warning-700) / <alpha-value>)',
                        800: 'rgb(var(--color-warning-800) / <alpha-value>)',
                        900: 'rgb(var(--color-warning-900) / <alpha-value>)',
                        950: 'rgb(var(--color-warning-950) / <alpha-value>)',
                    },
                    danger: {
                        50: 'rgb(var(--color-danger-50) / <alpha-value>)',
                        100: 'rgb(var(--color-danger-100) / <alpha-value>)',
                        200: 'rgb(var(--color-danger-200) / <alpha-value>)',
                        300: 'rgb(var(--color-danger-300) / <alpha-value>)',
                        400: 'rgb(var(--color-danger-400) / <alpha-value>)',
                        500: 'rgb(var(--color-danger-500) / <alpha-value>)',
                        600: 'rgb(var(--color-danger-600) / <alpha-value>)',
                        700: 'rgb(var(--color-danger-700) / <alpha-value>)',
                        800: 'rgb(var(--color-danger-800) / <alpha-value>)',
                        900: 'rgb(var(--color-danger-900) / <alpha-value>)',
                        950: 'rgb(var(--color-danger-950) / <alpha-value>)',
                    }
                }
            }
        },
        inject: (styleElement) => {
            document.head.appendChild(styleElement)
        }
    })
}
