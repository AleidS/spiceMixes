import { writable } from 'svelte/store';
import { router,page } from '@inertiajs/svelte';


const url = new URL($page.url, window.location.origin); // Create a URL object
let cuisine_id = url.searchParams.get('cuisine_id') || null;
let is_own = url.searchParams.get('is_own') === true;
let search = url.searchParams.get('filter[name]') || '';
let pageNumber = parseInt(url.searchParams.get('page')) || 1;
    
function applyFilter() {
    router.get(
        '/',
        { page: pageNumber, cuisine_id: cuisine_id, is_own: is_own, filter: { name: search } },
        { preserveState: true, preserveScroll: true }
    );
}

// Define a writable store for filters
export {cuisine_id,is_own,search,page,applyFilter}

