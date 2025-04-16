<script>
    import { onMount, onDestroy } from 'svelte';
    import { Editor } from '@tiptap/core';
    import StarterKit from '@tiptap/starter-kit';
    import BubbleMenu from '@tiptap/extension-bubble-menu';
    import { Color } from '@tiptap/extension-color';
    import { TextStyle } from '@tiptap/extension-text-style';
    import Text from '@tiptap/extension-text';
    import ListItem from '@tiptap/extension-list-item';
    import BulletList from '@tiptap/extension-bullet-list';
    import Paragraph from '@tiptap/extension-paragraph';
    import Document from '@tiptap/extension-document';
    import Icon from '@iconify/svelte';

    let bubbleMenu;
    let element;
    let editor;
    export let value;

    onMount(() => {
        editor = new Editor({
            element: element,
            extensions: [
                StarterKit,
                BubbleMenu.configure({
                    element: bubbleMenu
                }),
                Color,
                TextStyle,
                Document,
                Paragraph,
                Text,
                BulletList,
                ListItem
            ],
            content: value,
            onTransaction: () => {
                // force re-render so `editor.isActive` works as expected
                editor = editor;
            },
            onUpdate: ({ editor }) => {
                // Update the description prop whenever the editor content changes
                value = editor.getHTML();
            },
            editable: true,
            autofocus: true,
            injectCSS: true
        });
    });

    onDestroy(() => {
        if (editor) {
            editor.destroy();
        }
    });
</script>

{#if editor}
    <div class="m-2 flex items-center gap-2">
        <button
            type="button"
            onclick={() => editor.chain().focus().toggleHeading({ level: 1 }).run()}
            class:active={editor.isActive('heading', { level: 1 })}
        >
            <Icon icon="material-symbols:format-h1-rounded" />
        </button>
        <button
            type="button"
            onclick={() => editor.chain().focus().toggleHeading({ level: 2 }).run()}
            class:active={editor.isActive('heading', { level: 2 })}
        >
            <Icon icon="material-symbols:format-h2-rounded" />
        </button>
        <button
            type="button"
            onclick={() => editor.chain().focus().setParagraph().run()}
            class:active={editor.isActive('paragraph')}
        >
            <Icon icon="material-symbols:format-paragraph-rounded" />
        </button>

        <button
            type="button"
            onclick={() => editor.chain().focus().toggleBold().run()}
            class:active={editor.isActive('bold')}
        >
            <Icon icon="material-symbols:format-bold-rounded" />
        </button>
        <button
            type="button"
            onclick={() => editor.chain().focus().toggleItalic().run()}
            class:active={editor.isActive('italic')}
        >
            <Icon icon="material-symbols:format-italic-rounded" />
        </button>
        <button
            type="button"
            onclick={() => editor.chain().focus().toggleStrike().run()}
            class:active={editor.isActive('strike')}
        >
            <Icon icon="material-symbols:format-strikethrough-rounded" />
        </button>
        <input
            type="color"
            oninput={(event) => {
                editor.chain().focus().setColor(event.target.value).run();
            }}
            value={editor.getAttributes('textStyle').color || '#000000'}
        />
        <!-- <button
            type="button"
            onClick={() => editor.chain().focus().toggleBulletList().run()}
            class:active={editor.isActive('bulletList')}
        >
            Toggle bullet list
        </button>
        <button
            type="button"
            onClick={() => editor.chain().focus().splitListItem('listItem').run()}
            disabled={!editor.can().splitListItem('listItem')}
        >
            Split list item
        </button>
        <button
            type="button"
            onClick={() => editor.chain().focus().sinkListItem('listItem').run()}
            disabled={!editor.can().sinkListItem('listItem')}
        >
            Sink list item
        </button>
        <button
            type="button"
            onClick={() => editor.chain().focus().liftListItem('listItem').run()}
            disabled={!editor.can().liftListItem('listItem')}
        >
            Lift list item
        </button> -->
    </div>
{/if}
<div
    class="inputClass items-top !block min-h-40 !w-full !text-base !font-medium"
    bind:this={element}
></div>

<style>
    button {
        @apply rounded-full bg-uiDark-500 px-2 py-1 !font-light;
    }
    button.active {
        background: black;
        color: white;
    }
</style>
