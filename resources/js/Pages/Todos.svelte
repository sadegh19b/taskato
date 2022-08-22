<script>
    import { fly } from 'svelte/transition';
    import { page } from '@inertiajs/inertia-svelte';
    import { todoDetail } from "../Stores/todo-detail-stores";

    import PageTitle from "../Shared/Layout/PageTitle.svelte";
    import Layout from "../Shared/Layout/Layout.svelte";
    import TodoCard from "../Shared/Todos/TodoCard.svelte";
    import TodoDetailCard from "../Shared/Todos/TodoDetailCard.svelte";

    const route = window.route;

    $: mylist = $page.props.list;
    $: todos = $page.props.todos;
    $: todos_done = $page.props.todos_done;

    $: if ($todoDetail.showCard && mylist !== undefined && ($todoDetail.todo.category_id !== mylist.id)) { todoDetail.reset(); }

    function handleKeydown(event) {
        // 27 : Esc
        if (event.keyCode === 27 && $todoDetail.showCard) {
            todoDetail.reset();
        }
    }
</script>

{#if mylist}
    <PageTitle title={mylist.title} />
{/if}

<svelte:window on:keydown={handleKeydown}/>

<Layout>
    {#if mylist}
        <div class="flex justify-center" transition:fly={{ y: -200 }}>
            <div class="2xl:w-3/5 w-full p-8">
                <TodoCard list={mylist} {todos} {todos_done} />
            </div>
            <!--Todo: optimize and use better animation to show todo details for better ux-->
            {#if $todoDetail.showCard}
                <div class="2xl:w-1/3 w-full p-8" transition:fly={{ x: -200 }}>
                    <TodoDetailCard todo={$todoDetail.todo} />
                </div>
            {/if}
        </div>
    {/if}
</Layout>
