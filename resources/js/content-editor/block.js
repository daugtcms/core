import {mergeAttributes, Node} from "@tiptap/core"

export const Block = Node.create({
    name: 'Block',
    group: 'block',
    atom: true,
    defining: true,
    draggable: true,
    selectable: true,
    isolating: true,
    allowGapCursor: true,
    inline: false,
    addAttributes() {
        return {
            preview: {
                default: null,
                parseHTML: element => {
                    return element.getAttribute('data-preview')
                },
                renderHTML: attributes => {
                    if (! attributes.preview) {
                        return null
                    }
                    return {
                        'data-preview': attributes.preview
                    }
                }
            },
            scriptsAndStyles: {
                default: null,
                /*parseHTML: element => {
                    return null
                },
                renderHTML: attributes => {
                    return null
                }*/
                parseHTML: element => {
                    return element.getAttribute('data-scripts-and-styles')
                },
                renderHTML: attributes => {
                    if (! attributes.scriptsAndStyles) {
                        return null
                    }

                    return {
                        'data-scripts-and-styles': attributes.scriptsAndStyles
                    }
                }
            },
            block: {
                default: null,
                parseHTML: element => {
                    return element.getAttribute('data-block')
                },
                renderHTML: attributes => {
                    if (! attributes.block) {
                        return null
                    }

                    return {
                        'data-block': attributes.block
                    }
                }
            },
            uuid: {
                default: null,
                parseHTML: element => {
                    return element.getAttribute('data-uuid')
                },
                renderHTML: attributes => {
                    if (! attributes.uuid) {
                        return null
                    }

                    return {
                        'data-uuid': attributes.uuid
                    }
                }
            },
            label: {
                default: null,
                parseHTML: element => {
                    return element.getAttribute('data-label')
                },
                renderHTML: attributes => {
                    if (! attributes.label) {
                        return null
                    }

                    return {
                        'data-label': attributes.label
                    }
                }
            },
            data: {
                default: null,
                parseHTML: element => {
                    return element.getAttribute('data-data')
                },
                renderHTML: attributes => {
                    if (! attributes.data) {
                        return null
                    }

                    return {
                        'data-data': JSON.stringify(attributes.data)
                    }
                }
            },
        }
    },
    parseHTML() {
        return [
            {
                tag: 'tiptap-block',
            }
        ]
    },
    renderHTML({ HTMLAttributes }) {
        return ['tiptap-block', mergeAttributes(HTMLAttributes)]
    },
    addNodeView() {
        return ({node, getPos}) => {
            const dom = document.createElement('div')
            dom.contentEditable = 'false'
            dom.classList.add('tiptap-block-wrapper');

            let data = typeof node.attrs.data === 'object'
                ? JSON.stringify(node.attrs.data)
                : node.attrs.data

            let preview = node.attrs.scriptsAndStyles

            // replace all new lines
            preview += node.attrs.preview.replace(/(\r\n|\n|\r)/gm, "");

            // url encode the preview
            preview = encodeURIComponent(preview);

            dom.innerHTML = `
                <div
                    x-data="{
                        showOptionsButton: ${data === '[]' ? 'false' : 'true'},
                        intervalId: null,
                        openSettings() {
                            this.$dispatch('open-block-settings', {
                                block: \`${node.attrs.block}\`,
                                uuid: \`${node.attrs.uuid}\`,
                                coordinates: ${getPos()}
                            })
                        },
                        deleteBlock() {
                            this.$dispatch('delete-block')
                        },
                        init() {
                            let preview = \`${preview}\`
                            // Decode the preview
                            preview = decodeURIComponent(preview);
                        
                            const iframeDocument = $refs.iframe.contentWindow.document;
                            iframeDocument.open(); // Open the iframe document for writing
                            iframeDocument.write(preview); // Write the decoded preview content
                            iframeDocument.close(); // Close to complete the content write
                        
                            // Function to add classes after the body is available
                            const addClassesToIframe = () => {
                                if (iframeDocument.readyState === 'complete' || iframeDocument.body) {
                                    // Add 'font-main' class to <html> tag
                                    iframeDocument.documentElement.classList.add('font-main');
                                    // Add 'font-main' class to <body> tag
                                    iframeDocument.body.classList.add('font-main');
                            
                                    const resizeIframe = () => {
                                        const iframeBody = iframeDocument.body;
                                        if (iframeBody) {
                                            this.$refs.iframe.style.height = iframeBody.scrollHeight + 'px';
                                        }
                                    };
                            
                                    this.intervalId = setInterval(resizeIframe, 500);
                                    resizeIframe();
                                } else {
                                    // Wait and try again after a brief delay
                                    setTimeout(addClassesToIframe, 0);
                                }
                            };
                            
                            // Start the function
                            addClassesToIframe();
                        },
                        destroy() {
                            clearInterval(this.intervalId)
                        }
                    }"
                    class="relative w-full"
                >
                    <div class="flex items-center bg-white border-neutral-200 gap-x-0.5 border-2 bg-opacity-75 backdrop-blur-md absolute top-0 left-0 not-prose rounded-md m-1.5">
                        <div x-show="! disabled" class="flex gap-x-0.5 px-1">
                            <button x-show="showOptionsButton" type="button" x-on:click="openSettings" class="rounded p-0.5 hover:bg-neutral-300 bg-opacity-50">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cog"><path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"/><path d="M12 14a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/><path d="M12 2v2"/><path d="M12 22v-2"/><path d="m17 20.66-1-1.73"/><path d="M11 10.27 7 3.34"/><path d="m20.66 17-1.73-1"/><path d="m3.34 7 1.73 1"/><path d="M14 12h8"/><path d="M2 12h2"/><path d="m20.66 7-1.73 1"/><path d="m3.34 17 1.73-1"/><path d="m17 3.34-1 1.73"/><path d="m11 13.73-4 6.93"/></svg>
                            </button>
                            <button type="button" x-on:click="deleteBlock()"  class="rounded hover:bg-danger-200 p-0.5 hover:text-danger-500 bg-opacity-50">
                               <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                            </button>
                        </div>
                        <p class="font-medium text-gray-800 pr-1.5">${node.attrs.label}</p>
                    </div>
                    <iframe x-ref="iframe" class="w-full">
                    </iframe>
                </div>
            `;

            return {
                dom,
            }
        }
    },
    addCommands() {
        return {
            insertBlock: (attributes) => ({ chain, state }) => {
                const currentChain = chain()

                if (! [null, undefined].includes(attributes.coordinates?.pos)) {
                    currentChain.insertContentAt({ from: attributes.coordinates.pos, to: attributes.coordinates.pos }, { type: this.name, attrs: attributes })
                    return currentChain.setTextSelection(attributes.coordinates.pos)
                }

                const { selection } = state
                const { $from, $to } = selection

                const range = $from.blockRange($to)
                console.log(attributes, range, $from, $to);

                if (!range) {
                    if ($to.parentOffset === 0) {
                        currentChain
                            .insertContentAt(Math.max($to.pos - 1, 0), { type: 'paragraph' })
                            .insertContentAt({ from: $from.pos, to: $to.pos }, { type: this.name, attrs: attributes })
                    } else {
                        currentChain
                            .setNode({ type: 'paragraph' })
                            .insertContentAt({ from: $from.pos, to: $to.pos }, { type: this.name, attrs: attributes })
                    }

                    return currentChain.setTextSelection($to.pos + 1)
                } else {
                    if ($to.parentOffset === 0) {
                        currentChain.insertContentAt(Math.max($to.pos - 1, 0), { type: this.name, attrs: attributes })
                    } else {
                        currentChain.insertContentAt({ from: range.start, to: range.end }, { type: this.name, attrs: attributes })
                    }

                    return currentChain.setTextSelection(range.end)
                }
            },
            updateBlock: (attributes) => ({ state, commands }) => {
                const { selection } = state;
                const { $from } = selection;

                // HINT: Code generated by GPT o1-preview <3
                // maybe needs some revision but works for now

                // Check if the selection is a node selection and the selected node is our Block node
                if (selection.node && selection.node.type.name === this.name) {
                    // Update the attributes of the selected node directly
                    return commands.updateAttributes(this.name, attributes);
                } else {
                    // Try to find the Block node at the current cursor position
                    let pos = $from.pos;
                    let node = state.doc.nodeAt(pos);

                    // If not found, check the node before the current position
                    if (!node || node.type.name !== this.name) {
                        pos = $from.before();
                        node = state.doc.nodeAt(pos);
                    }

                    if (node && node.type.name === this.name) {
                        // Update attributes at the found position
                        return commands.command(({ tr }) => {
                            tr.setNodeMarkup(pos, undefined, {
                                ...node.attrs,
                                ...attributes,
                            });
                            return true;
                        });
                    } else if (attributes.coordinates !== undefined) {
                        // If a specific position is provided, use it
                        const nodePos = attributes.coordinates;
                        const nodeAtPos = state.doc.nodeAt(nodePos);

                        if (nodeAtPos && nodeAtPos.type.name === this.name) {
                            return commands.command(({ tr }) => {
                                tr.setNodeMarkup(nodePos, undefined, {
                                    ...nodeAtPos.attrs,
                                    ...attributes,
                                });
                                return true;
                            });
                        }
                    }

                    // Could not find the Block node to update
                    return false;
                }
            },
            removeBlock: () => ({ commands }) => {
                return commands.deleteSelection()
            }
        }
    },
})