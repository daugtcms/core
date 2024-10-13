import { Mark } from '@tiptap/core';

export const FontFamily = Mark.create({
    name: 'fontFamily',

    addAttributes() {
        return {
            font: {
                default: null,
                parseHTML: element => {
                    const classList = element.getAttribute('class') || '';

                    // Check for class starting with 'font-'
                    const classMatch = classList.match(/(^|\s)font-(\w+)(\s|$)/);
                    if (classMatch) {
                        return classMatch[2]; // Return the font name
                    }

                    return null;
                },
                renderHTML: attributes => {
                    if (!attributes.font) {
                        return {};
                    }

                    // Use class 'font-(font)'
                    return {
                        class: `font-${attributes.font}`,
                    };
                },
            },
        };
    },

    parseHTML() {
        return [
            {
                tag: 'span[class]',
                getAttrs: element => {
                    const classList = element.getAttribute('class') || '';
                    if (/(^|\s)font-\w+(\s|$)/.test(classList)) {
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
            setFontFamily: font => ({ commands }) => {
                if (!font) {
                    return false;
                }
                return commands.setMark(this.name, { font });
            },
            unsetFontFamily: () => ({ commands }) => {
                return commands.unsetMark(this.name);
            },
        };
    },
});