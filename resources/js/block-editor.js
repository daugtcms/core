import {Alpine} from '../../vendor/livewire/livewire/dist/livewire.esm'
import { Editor } from '@tiptap/core'
import StarterKit from '@tiptap/starter-kit'

document.addEventListener('alpine:init', () => {
    Alpine.data('blockEditor', (content) => {
        return {
            sidebarOpen: true,
            init() {
            },
        }
    })
})
