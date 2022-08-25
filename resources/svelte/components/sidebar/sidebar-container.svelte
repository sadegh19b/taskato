<script>
    import { fly } from 'svelte/transition';
    import { Inertia } from '@inertiajs/inertia';
    import { inertia, page } from '@inertiajs/inertia-svelte';
    import { SortableList } from '@jhubbardsf/svelte-sortablejs';

    import SidebarListItem from "~component/sidebar/sidebar-list-item";
    import TextInput from "~component/text-input";
    import Icon from "~component/icon";

    const route = window.route;

    $: categories = $page.props.categories;
    //$: isActiveDashboard = $page.url === '/';

    let isActiveDashboard = false;
    let addListInputEnable = false;
    let addGroupInputEnable = false;

    const sortList = (event) => {
        const items = event.detail ? event.detail.from.children : event.from.children;
        let keys = Object.keys(items);

        for (let i = 0; i < keys.length; i++) {
            keys[i] = items[i].dataset.id;
        }

        Inertia.post(route('categories.reorder'), {reorder: keys});
    };

    const saveListOrGroup = (event) => {
        let sort = Object.keys(categories);
        sort = categories.length ? parseInt(sort[categories.length - 1]) + 1 : 0;

        const formData = {
            title: event.detail.input,
            is_group: addGroupInputEnable,
            //is_group: event.detail.is_group,
            sort: sort
        };

        Inertia.post(route('categories.store'), formData);
        cancel();
    }

    function handleAddList() {
        addGroupInputEnable = false;
        addListInputEnable = true;
    }

    function handleAddGroup() {
        addListInputEnable = false;
        addGroupInputEnable = true;
    }

    function cancel() {
        addListInputEnable = false;
        addGroupInputEnable = false;
    }
</script>

<div class="py-8 overflow-y-auto overflow-x-hidden w-80 bg-base-300 font-medium">
    <ul class="menu text-base-content text-lg">
        <li>
            <button use:inertia="{{ href: route('home') }}" class="w-full" class:active={isActiveDashboard} in:fly="{{ x: 200 }}">
                <Icon name="home"/>
                <span>داشبورد</span>
            </button>
        </li>
        <SortableList animation="500" onSort={sortList}>
            {#each categories as item (item.id)}
                <li data-id="{item.id}">
                    <SidebarListItem {item} on:subSort={sortList} />
                </li>
            {/each}
        </SortableList>
        {#if addListInputEnable}
            <li>
                <TextInput type="list" on:save={saveListOrGroup} on:cancel={cancel} />
            </li>
        {/if}
        {#if addGroupInputEnable}
            <li>
                <TextInput type="group" on:save={saveListOrGroup} on:cancel={cancel} />
            </li>
        {/if}
    </ul>
    <div class="flex justify-between" in:fly="{{ x: 200 }}">
        <button class="add-new-btn p-4 align-middle w-full" on:click={handleAddList}>
            <Icon name="plus" className="ml-2"/>
            <span>افزودن لیست</span>
        </button>
        <div class="tooltip tooltip-left" data-tip="افزودن گروه">
            <button class="add-new-btn p-4" on:click={handleAddGroup}>
                <Icon name="folder-add"/>
            </button>
        </div>
    </div>
</div>

