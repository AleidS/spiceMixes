<script>
    import Icon from '@iconify/svelte';
    import { page, useForm, router } from '@inertiajs/svelte';

    let { children, class: className, mix, ...attrs } = $props();
    let mixFaved = $state(false);

    let button;

    const form = {
        user_id: $page.props?.auth?.user?.id ?? null,
        mix_id: mix.id
    };

    function fave(e) {
        e.preventDefault();
        if (mix.favorite) {
            mixFaved = false;
            animateButton();
            router.delete(`/favorite`, { data: form });
        } else {
            mixFaved = true;
            animateButton();
            router.post(`/favorite`, form);
        }
    }
    function animateButton() {
        button.animate([{ transform: 'translateY(-5px)' }], {
            duration: 200,
            direction: 'alternate',
            iterations: 2
        });
    }
</script>

{#if $page?.props?.auth?.user}
    <button bind:this={button} onclick={fave} class="w-fit hover:scale-110">
        <Icon
            class="text-4xl"
            icon={mixFaved || mix.favorite
                ? 'material-symbols-light:star-rounded'
                : 'material-symbols-light:star-outline-rounded'}
        />
    </button>
{/if}
