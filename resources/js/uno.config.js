import { defineConfig } from '@unocss/runtime'
import presetUno from '@unocss/preset-uno'
import presetTypography from '@unocss/preset-typography'
import {presetForms} from "@julr/unocss-preset-forms";

export default defineConfig({
    presets: [presetUno(), presetTypography(), presetForms()],
})
