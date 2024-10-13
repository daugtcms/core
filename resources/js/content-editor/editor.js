import { Editor } from '@tiptap/core'
import StarterKit from '@tiptap/starter-kit'
import FloatingMenu from '@tiptap/extension-floating-menu'
import {Block} from "./block.js";
import {Link} from "@tiptap/extension-link";
import {TextAlign} from "@tiptap/extension-text-align";
import {Color} from "./color.js";
import {FontFamily} from "./font-family.js";

Livewire.on('insertBlock', (event) => {
    console.log(event);
    setTimeout(() => {
        const proxyEvent = new CustomEvent('insert-block', { bubble: true, detail: event})
        window.dispatchEvent(proxyEvent);
    })
})

Livewire.on('updateBlock', (event) => {
    setTimeout(() => {
        const proxyEvent = new CustomEvent('update-block', { bubble: true, detail: event })
        window.dispatchEvent(proxyEvent);
    })
})

window.setupContentEditor = function (content) {
    let editor
    return {
        content: content,
        disabled: false,
        updatedAt: Date.now(), // force Alpine to rerender on selection change
        init(element) {
            editor = new Editor({
                element: element,
                extensions: [
                    StarterKit.configure(),
                    FloatingMenu.configure({
                        element: this.$refs.floatingMenuBlocks
                    }),
                    Link.configure({
                        openOnClick: false,
                        autolink: true,
                    }),
                    TextAlign.configure({
                        types: ['heading', 'paragraph'],
                        defaultAlignment: 'justify',
                    }),
                    Color,
                    FontFamily,
                    // custom block element for daugt
                    Block
                ],
                content: this.content,
                onCreate: ({ editor }) => {
                    this.updatedAt = Date.now()
                },
                onUpdate: Alpine.debounce(({ editor }) => {
                    this.content = editor.getJSON()
                    this.updatedAt = Date.now()
                }, 300),
                onSelectionUpdate: ({ editor }) => {
                    this.updatedAt = Date.now()
                }
            })

            editor.commands.focus()


            this.$watch('content', (content) => {
                // If the new content matches TipTap's then we just skip.
                if (JSON.stringify(content) === JSON.stringify(editor.getJSON())) return
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
        setColor(opts) {
            editor.chain().setColor(opts).focus().run()
        },
        setFontFamily(opts) {
            editor.chain().setFontFamily(opts).focus().run()
        },
        toggleLink() {
            const previousUrl = editor.getAttributes('link').href
            const url = window.prompt('Set URL of this link. Leave empty to delete this link.', previousUrl)
            // cancelled
            if (url === null) {
                return
            }

            // empty
            if (url === '') {
                editor.chain().focus().extendMarkRange('link').unsetLink()
                    .run()

                return
            }

            // update link
            editor.chain().focus().extendMarkRange('link').setLink({ href: url })
                .run()
        },
        insertBlock(event) {
            editor.commands.insertBlock({
                label: event.detail.label,
                uuid: event.detail.uuid,
                preview: event.detail.preview,
                scriptsAndStyles: event.detail.scriptsAndStyles,
                block: event.detail.block,
                coordinates: event.detail.coordinates,
                data: event.detail.data
            });

            if (! editor.isFocused) {
                editor.commands.focus();
            }
        },
        updateBlock(event) {
            editor.commands.updateBlock({
                label: event.detail.label,
                uuid: event.detail.uuid,
                preview: event.detail.preview,
                scriptsAndStyles: event.detail.scriptsAndStyles,
                block: event.detail.block,
                coordinates: event.detail.coordinates,
                data: event.detail.data
            });

            if (! editor.isFocused) {
                editor.commands.focus();
            }
        },
        deleteBlock() {
            editor.commands.removeBlock();
        },
        openBlockSettings(event) {
            this.$wire.openBlockSettings(event.detail.uuid, event.detail.coordinates);
        },
    }
}
