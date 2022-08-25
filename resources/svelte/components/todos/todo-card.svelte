<script>
    import { afterUpdate } from "svelte";
    import { Inertia } from "@inertiajs/inertia";
    import { SortableList } from '@jhubbardsf/svelte-sortablejs';
    import { todoDetail } from "~store/todo-detail-store";

    import TodoItem from "~component/todos/todo-item";
    import TodoCardActions from "~component/todos/todo-card-actions";
    import AddTodoInput from "~component/todos/add-todo-input";
    import TextInput from "~component/text-input";
    import Icon from "~component/icon";
    import audioUrl from "~/sounds/ding.mp3";

    const route = window.route;

    export let list;
    export let todos;
    export let todosDone;

    let showCompletedTodos = false;
    let editTitleInputEnable = false;

    const sortList = (event) => {
        const items = event.detail ? event.detail.from.children : event.from.children;
        let keys = Object.keys(items);

        for (let i=0; i < keys.length; i++)
        {
            keys[i] = items[i].dataset.id;
        }

        Inertia.post(route('todos.reorder'), {reorder: keys});
    };

    const saveTodo = (event) => {
        let sort = Object.keys(todos);
        sort = todos.length ? parseInt(sort[todos.length - 1]) + 1 : 0;

        const formData = {
            title: event.detail.input,
            sort: sort,
        };

        Inertia.post(route('todos.store', list.id), formData);
    }

    const updateListTitle = (event) => {
        const formData = {
            title: event.detail.input,
        };

        list.title = formData.title;

        Inertia.put(route('categories.update', list.id), formData);
        editTitleInputEnable = false;
    }

    afterUpdate(() => {
        document.getElementById('completeTodoSound').src = audioUrl;
        document.querySelector('#completeTodoSound source').src = audioUrl;
    });
</script>

<div class="card bg-base-200 shadow-xl">
    <div class="card-body min-h-[90vh] max-h-[90vh] pb-28 relative">
        <div class="flex justify-between items-center">
            <h2 class="card-title">
                <Icon name="list" sizeClass="w-7 h-7" />
                {#if editTitleInputEnable}
                    <TextInput inputValue={list.title} on:save={updateListTitle} on:cancel={() => editTitleInputEnable = false} />
                {:else}
                    <span>{list.title}</span>
                {/if}
            </h2>
            <TodoCardActions isListInGroup={list.parent_id} canDeleteCompleteTodos={todosDone.length > 0} on:editListTitle={() => editTitleInputEnable = true} />
        </div>
        <div class="divider"></div>
        {#if !todos.length && !todosDone.length}
            <div class="flex flex-col justify-between items-center">
                <Icon name="list" sizeClass="w-16 h-16" className="mb-3 opacity-50"/>
                <p class="text-center">لیست خالی است!</p>
                <p class="text-center">تسک جدیدی به لیست خود اضافه کنید.</p>
            </div>
        {:else}
            <div class="overflow-y-auto">
                <ul>
                    <!--Todo: need to check problem with wrong sorting after reorder list and add new todo-->
                    <SortableList animation="500" onSort={sortList}>
                        {#each todos as item (item.id)}
                            <li data-id="{item.id}">
                                <TodoItem todo={item} active={$todoDetail.showCard && (item.id === $todoDetail.todo.id)} />
                            </li>
                        {/each}
                    </SortableList>
                </ul>
                {#if todosDone.length}
                    <button class="btn btn-primary my-4" on:click={() => showCompletedTodos = !showCompletedTodos}>
                        <span class="ml-6">تکمیل شده ها</span>
                        <Icon name="arrow-left" className="transition duration-200{showCompletedTodos ? ' transform -rotate-90' : ''}" />
                    </button>
                {/if}
                {#if showCompletedTodos}
                    <ul>
                        <SortableList animation="500" onSort={sortList}>
                            {#each todosDone as item (item.id)}
                                <li data-id="{item.id}">
                                    <TodoItem todo={item} active={$todoDetail.showCard && (item.id === $todoDetail.todo.id)} />
                                </li>
                            {/each}
                        </SortableList>
                    </ul>
                {/if}
            </div>
        {/if}
        <AddTodoInput on:save={saveTodo} />
        <audio class="hidden" id="completeTodoSound">
            <source type="audio/mpeg">
        </audio>
    </div>
</div>

<style>
    ul li {
        @apply mb-2;
    }
</style>
