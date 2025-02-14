import prettier from 'eslint-config-prettier';
import js from '@eslint/js';
import svelte from 'eslint-plugin-svelte';
import php from '@eslint/php'
import globals from 'globals';

/** @type {import('eslint').Linter.Config[]} */
export default [
	js.configs.recommended,
	...svelte.configs['flat/recommended'],
	prettier,
	...svelte.configs['flat/prettier'],
	{
		languageOptions: {
			globals: {
				...globals.browser,
				...globals.node
			}
		}
	},
	{
		ignores: ['bootstrap', 'public', 'vendor']
	},
    {
        rules: {
            'no-undef': 'off'
        }
    },
	
    {
        files: ['*.svelte'],
        processor: 'svelte3/svelte3',
        plugins: ['svelte3'],
        rules: {
            // Add Svelte-specific rules here
        }
    }
];