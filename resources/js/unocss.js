import initUnocssRuntime from '@unocss/runtime'
import presetUno from "@unocss/preset-uno";
import presetTypography from "@unocss/preset-typography";
import {presetForms} from "@julr/unocss-preset-forms";
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
                fontFamily: { // https://github.com/system-fonts/modern-font-stacks
                    systemui:     ['system-ui', 'sans-serif'],
                    transitional: ['Charter', 'Bitstream Charter', 'Sitka Text', 'Cambria', 'serif'],
                    oldstyle:     ['Iowan Old Style', 'Palatino Linotype', 'URW Palladio L', 'P052', 'serif'],
                    humanist:     ['Seravek', 'Gill Sans Nova', 'Ubuntu', 'Calibri', 'DejaVu Sans', 'source-sans-pro', 'sans-serif'],
                    geohumanist:  ['Avenir', 'Montserrat', 'Corbel', 'URW Gothic', 'source-sans-pro', 'sans-serif'],
                    classhuman:   ['Optima', 'Candara', 'Noto Sans', 'source-sans-pro', 'sans-serif'],
                    neogrote:     ['Inter', 'Roboto', 'Helvetica Neue', 'Arial Nova', 'Nimbus Sans', 'Arial', 'sans-serif'],
                    monoslab:     ['Nimbus Mono PS', 'Courier New', 'monospace'],
                    monocode:     ['ui-monospace', 'Cascadia Code', 'Source Code Pro', 'Menlo', 'Consolas', 'DejaVu Sans Mono', 'monospace'],
                    industrial:   ['Bahnschrift', 'DIN Alternate', 'Franklin Gothic Medium', 'Nimbus Sans Narrow', 'sans-serif-condensed', 'sans-serif'],
                    roundsans:    ['ui-rounded', 'Hiragino Maru Gothic ProN', 'Quicksand', 'Comfortaa', 'Manjari', 'Arial Rounded MT', 'Arial Rounded MT Bold', 'Calibri', 'source-sans-pro', 'sans-serif'],
                    slabserif:    ['Rockwell', 'Rockwell Nova', 'Roboto Slab', 'DejaVu Serif', 'Sitka Small', 'serif'],
                    antique:      ['Superclarendon', 'Bookman Old Style', 'URW Bookman', 'URW Bookman L', 'Georgia Pro', 'Georgia', 'serif'],
                    didone:       ['Didot', 'Bodoni MT', 'Noto Serif Display', 'URW Palladio L', 'P052', 'Sylfaen', 'serif'],
                    handwritten:  ['Segoe Print', 'Bradley Hand', 'Chilanka', 'TSCu_Comic', 'casual', 'cursive'],
                    main: initOptions?.font?.main ?? 'systemui',
                    accent: initOptions?.font?.accent ?? 'slabserif',
                },
                colors: {
                    primary: {
                        50: initOptions?.colors?.primary?.[50] ?? 'rgb(var(--color-primary-50) / <alpha-value>)',
                        100: initOptions?.colors?.primary?.[100] ?? 'rgb(var(--color-primary-100) / <alpha-value>)',
                        200: initOptions?.colors?.primary?.[200] ?? 'rgb(var(--color-primary-200) / <alpha-value>)',
                        300: initOptions?.colors?.primary?.[300] ?? 'rgb(var(--color-primary-300) / <alpha-value>)',
                        400: initOptions?.colors?.primary?.[400] ?? 'rgb(var(--color-primary-400) / <alpha-value>)',
                        500: initOptions?.colors?.primary?.[500] ?? 'rgb(var(--color-primary-500) / <alpha-value>)',
                        600: initOptions?.colors?.primary?.[600] ?? 'rgb(var(--color-primary-600) / <alpha-value>)',
                        700: initOptions?.colors?.primary?.[700] ?? 'rgb(var(--color-primary-700) / <alpha-value>)',
                        800: initOptions?.colors?.primary?.[800] ?? 'rgb(var(--color-primary-800) / <alpha-value>)',
                        900: initOptions?.colors?.primary?.[900] ?? 'rgb(var(--color-primary-900) / <alpha-value>)',
                        950: initOptions?.colors?.primary?.[950] ?? 'rgb(var(--color-primary-950) / <alpha-value>)',
                    },
                    secondary: {
                        50: initOptions?.colors?.secondary?.[50] ?? initOptions?.colors?.primary?.[50] ?? 'rgb(var(--color-primary-50) / <alpha-value>)',
                        100: initOptions?.colors?.secondary?.[100] ?? initOptions?.colors?.primary?.[100] ?? 'rgb(var(--color-primary-100) / <alpha-value>)',
                        200: initOptions?.colors?.secondary?.[200] ?? initOptions?.colors?.primary?.[200] ?? 'rgb(var(--color-primary-200) / <alpha-value>)',
                        300: initOptions?.colors?.secondary?.[300] ?? initOptions?.colors?.primary?.[300] ?? 'rgb(var(--color-primary-300) / <alpha-value>)',
                        400: initOptions?.colors?.secondary?.[400] ?? initOptions?.colors?.primary?.[400] ?? 'rgb(var(--color-primary-400) / <alpha-value>)',
                        500: initOptions?.colors?.secondary?.[500] ?? initOptions?.colors?.primary?.[500] ?? 'rgb(var(--color-primary-500) / <alpha-value>)',
                        600: initOptions?.colors?.secondary?.[600] ?? initOptions?.colors?.primary?.[600] ?? 'rgb(var(--color-primary-600) / <alpha-value>)',
                        700: initOptions?.colors?.secondary?.[700] ?? initOptions?.colors?.primary?.[700] ?? 'rgb(var(--color-primary-700) / <alpha-value>)',
                        800: initOptions?.colors?.secondary?.[800] ?? initOptions?.colors?.primary?.[800] ?? 'rgb(var(--color-primary-800) / <alpha-value>)',
                        900: initOptions?.colors?.secondary?.[900] ?? initOptions?.colors?.primary?.[900] ?? 'rgb(var(--color-primary-900) / <alpha-value>)',
                        950: initOptions?.colors?.secondary?.[950] ?? initOptions?.colors?.primary?.[950] ?? 'rgb(var(--color-primary-950) / <alpha-value>)',
                    },
                    neutral: {
                        50: initOptions?.colors?.neutral?.[50] ?? 'rgb(var(--color-neutral-50) / <alpha-value>)',
                        100: initOptions?.colors?.neutral?.[100] ?? 'rgb(var(--color-neutral-100) / <alpha-value>)',
                        200: initOptions?.colors?.neutral?.[200] ?? 'rgb(var(--color-neutral-200) / <alpha-value>)',
                        300: initOptions?.colors?.neutral?.[300] ?? 'rgb(var(--color-neutral-300) / <alpha-value>)',
                        400: initOptions?.colors?.neutral?.[400] ?? 'rgb(var(--color-neutral-400) / <alpha-value>)',
                        500: initOptions?.colors?.neutral?.[500] ?? 'rgb(var(--color-neutral-500) / <alpha-value>)',
                        600: initOptions?.colors?.neutral?.[600] ?? 'rgb(var(--color-neutral-600) / <alpha-value>)',
                        700: initOptions?.colors?.neutral?.[700] ?? 'rgb(var(--color-neutral-700) / <alpha-value>)',
                        800: initOptions?.colors?.neutral?.[800] ?? 'rgb(var(--color-neutral-800) / <alpha-value>)',
                        900: initOptions?.colors?.neutral?.[900] ?? 'rgb(var(--color-neutral-900) / <alpha-value>)',
                        950: initOptions?.colors?.neutral?.[950] ?? 'rgb(var(--color-neutral-950) / <alpha-value>)',
                    },
                    success: {
                        50: initOptions?.colors?.success?.[50] ?? 'rgb(var(--color-success-50) / <alpha-value>)',
                        100: initOptions?.colors?.success?.[100] ?? 'rgb(var(--color-success-100) / <alpha-value>)',
                        200: initOptions?.colors?.success?.[200] ?? 'rgb(var(--color-success-200) / <alpha-value>)',
                        300: initOptions?.colors?.success?.[300] ?? 'rgb(var(--color-success-300) / <alpha-value>)',
                        400: initOptions?.colors?.success?.[400] ?? 'rgb(var(--color-success-400) / <alpha-value>)',
                        500: initOptions?.colors?.success?.[500] ?? 'rgb(var(--color-success-500) / <alpha-value>)',
                        600: initOptions?.colors?.success?.[600] ?? 'rgb(var(--color-success-600) / <alpha-value>)',
                        700: initOptions?.colors?.success?.[700] ?? 'rgb(var(--color-success-700) / <alpha-value>)',
                        800: initOptions?.colors?.success?.[800] ?? 'rgb(var(--color-success-800) / <alpha-value>)',
                        900: initOptions?.colors?.success?.[900] ?? 'rgb(var(--color-success-900) / <alpha-value>)',
                        950: initOptions?.colors?.success?.[950] ?? 'rgb(var(--color-success-950) / <alpha-value>)',
                    },
                    warning: {
                        50: initOptions?.colors?.warning?.[50] ?? 'rgb(var(--color-warning-50) / <alpha-value>)',
                        100: initOptions?.colors?.warning?.[100] ?? 'rgb(var(--color-warning-100) / <alpha-value>)',
                        200: initOptions?.colors?.warning?.[200] ?? 'rgb(var(--color-warning-200) / <alpha-value>)',
                        300: initOptions?.colors?.warning?.[300] ?? 'rgb(var(--color-warning-300) / <alpha-value>)',
                        400: initOptions?.colors?.warning?.[400] ?? 'rgb(var(--color-warning-400) / <alpha-value>)',
                        500: initOptions?.colors?.warning?.[500] ?? 'rgb(var(--color-warning-500) / <alpha-value>)',
                        600: initOptions?.colors?.warning?.[600] ?? 'rgb(var(--color-warning-600) / <alpha-value>)',
                        700: initOptions?.colors?.warning?.[700] ?? 'rgb(var(--color-warning-700) / <alpha-value>)',
                        800: initOptions?.colors?.warning?.[800] ?? 'rgb(var(--color-warning-800) / <alpha-value>)',
                        900: initOptions?.colors?.warning?.[900] ?? 'rgb(var(--color-warning-900) / <alpha-value>)',
                        950: initOptions?.colors?.warning?.[950] ?? 'rgb(var(--color-warning-950) / <alpha-value>)',
                    },
                    danger: {
                        50: initOptions?.colors?.danger?.[50] ?? 'rgb(var(--color-danger-50) / <alpha-value>)',
                        100: initOptions?.colors?.danger?.[100] ?? 'rgb(var(--color-danger-100) / <alpha-value>)',
                        200: initOptions?.colors?.danger?.[200] ?? 'rgb(var(--color-danger-200) / <alpha-value>)',
                        300: initOptions?.colors?.danger?.[300] ?? 'rgb(var(--color-danger-300) / <alpha-value>)',
                        400: initOptions?.colors?.danger?.[400] ?? 'rgb(var(--color-danger-400) / <alpha-value>)',
                        500: initOptions?.colors?.danger?.[500] ?? 'rgb(var(--color-danger-500) / <alpha-value>)',
                        600: initOptions?.colors?.danger?.[600] ?? 'rgb(var(--color-danger-600) / <alpha-value>)',
                        700: initOptions?.colors?.danger?.[700] ?? 'rgb(var(--color-danger-700) / <alpha-value>)',
                        800: initOptions?.colors?.danger?.[800] ?? 'rgb(var(--color-danger-800) / <alpha-value>)',
                        900: initOptions?.colors?.danger?.[900] ?? 'rgb(var(--color-danger-900) / <alpha-value>)',
                        950: initOptions?.colors?.danger?.[950] ?? 'rgb(var(--color-danger-950) / <alpha-value>)',
                    },
                },
            }
        },
        inject: (styleElement) => {
            document.head.appendChild(styleElement)
        }
    })
}
