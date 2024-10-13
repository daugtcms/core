import { Mark } from '@tiptap/core';

export const Color = Mark.create({
    name: 'color',

    addAttributes() {
        return {
            color: {
                default: null,
                parseHTML: element => {
                    const style = element.getAttribute('style') || '';
                    const classList = element.getAttribute('class') || '';

                    // Check for inline color style (hex code)
                    const colorMatch = style.match(/color:\s*(#[0-9a-fA-F]{3,6});?/);
                    if (colorMatch) {
                        return colorMatch[1]; // Return the hex color code
                    }

                    // Check for class starting with 'text-'
                    const classMatch = classList.match(/(^|\s)text-([^\s]+)/);
                    if (classMatch) {
                        return classMatch[2]; // Return the color value
                    }

                    return null;
                },
                renderHTML: attributes => {
                    if (!attributes.color) {
                        return {};
                    }

                    if (/^#[0-9a-fA-F]{3,6}$/.test(attributes.color)) {
                        // Custom hex color, use inline style
                        return {
                            style: `color: ${attributes.color}`,
                        };
                    } else {
                        // Use class 'text-(color)'
                        return {
                            class: `text-${attributes.color}`,
                        };
                    }
                },
            },
        };
    },

    parseHTML() {
        return [
            {
                tag: 'span',
                getAttrs: element => {
                    const style = element.getAttribute('style') || '';
                    const classList = element.getAttribute('class') || '';

                    const hasStyle = /color:\s*#[0-9a-fA-F]{3,6};?/.test(style);
                    const hasClass = /(^|\s)text-[^\s]+(\s|$)/.test(classList);

                    if (hasStyle || hasClass) {
                        return {};
                    }
                    return false;
                },
            },
        ];
    },

    renderHTML({ HTMLAttributes }) {
        return ['span', HTMLAttributes, 0];
    },

    addCommands() {
        return {
            setColor: color => ({ commands }) => {
                if (!color) {
                    return false;
                }
                return commands.setMark(this.name, { color });
            },
            unsetColor: () => ({ commands }) => {
                return commands.unsetMark(this.name);
            },
        };
    },
});
