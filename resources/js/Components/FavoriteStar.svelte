<script>
    import Icon from '@iconify/svelte';
    import { page, useForm, router } from '@inertiajs/svelte';

    let { children, class: className, mix, ...attrs } = $props();
    let mixFaved = $state(false);

    const form = {
        user_id: $page.props?.auth?.user?.id ?? null,
        mix_id: mix.id
    };

    function fave(e) {
        e.preventDefault();
        if (mix.favorite) {
            router.delete(`/favorite`, { data: form });
            mixFaved = false;
        } else {
            router.post(`/favorite`, form);
            mixFaved = true;
        }
    }
</script>

{#if $page?.props?.auth?.user}
    <button onclick={fave} class="absolute left-8 my-auto hover:scale-110">
        <Icon icon={mixFaved || mix.favorite ? 'mdi:star' : 'mdi-light:star'} />
    </button>
{/if}
