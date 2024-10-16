import { Editor } from '@tiptap/core'
import StarterKit from '@tiptap/starter-kit'
import {TextAlign} from "@tiptap/extension-text-align";

window.setupEditor = function (content) {
    let editor

    return {
        content: content,

        updatedAt: Date.now(), // force Alpine to rerender on selection change
        init(element) {
            editor = new Editor({
                element: element,
                extensions: [
                    StarterKit,
                    TextAlign.configure({
                        types: ['heading', 'paragraph'],
                        defaultAlignment: 'justify',
                    })
                ],
                content: this.content,
                onCreate: ({ editor }) => {
                    this.updatedAt = Date.now()
                },
                onUpdate: Alpine.debounce(({ editor }) => {
                    this.content = editor.getJSON()
                    console.log(editor.getJSON())
                    this.updatedAt = Date.now()
                }, 300),
                onSelectionUpdate: ({ editor }) => {
                    this.updatedAt = Date.now()
                }
            })

            editor.commands.focus()


            this.$watch('content', (content) => {
                // If the new content matches TipTap's then we just skip.
                if (content === editor.getJSON()) return

                /*
                  Otherwise, it means that a force external to TipTap
                  is modifying the data on this Alpine component,
                  which could be Livewire itself.
                  In this case, we just need to update TipTap's
                  content and we're good to do.
                  For more information on the `setContent()` method, see:
                    https://www.tiptap.dev/api/commands/set-content
                */
                editor.commands.setContent(content, false)
            })
        },
        isLoaded() {
            return editor
        },
        isActive(type, opts = {}) {
            return editor.isActive(type, opts)
        },
        toggleHeading(opts) {
            editor.chain().toggleHeading(opts).focus().run()
        },
        toggleBold() {
            editor.chain().toggleBold().focus().run()
        },
        toggleItalic() {
            editor.chain().toggleItalic().focus().run()
        },
        toggleStrike() {
            editor.chain().toggleStrike().focus().run()
        },
        toggleBulletList() {
            editor.chain().toggleBulletList().focus().run()
        },
        toggleOrderedList() {
            editor.chain().toggleOrderedList().focus().run()
        },
        toggleBlockquote() {
            editor.chain().toggleBlockquote().focus().run()
        },
        setHorizontalRule() {
            editor.chain().setHorizontalRule().focus().run()
        },
        setTextAlign(opts) {
            editor.chain().setTextAlign(opts).focus().run()
        },
    }
}
