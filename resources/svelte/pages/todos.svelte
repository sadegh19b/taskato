<script>
    import { fly } from 'svelte/transition';
    import { page } from '@inertiajs/inertia-svelte';
    import { todoDetail } from "../stores/todo-detail-store";

    import PageTitle from "../components/page-title.svelte";
    import Layout from "../components/layout.svelte";
    import TodoCard from "../components/todos/todo-card.svelte";
    import TodoDetailCard from "../components/todos/todo-detail-card.svelte";

    $: category = $page.props.list;
    $: todos = $page.props.todos;
    $: todosDone = $page.props.todos_done;

    $: if ($todoDetail.showCard && category !== undefined && ($todoDetail.todo.category_id !== category.id)) { todoDetail.reset(); }

    function handleKeydown(event) {
        // 27 : Esc
        if (event.keyCode === 27 && $todoDetail.showCard) {
            todoDetail.reset();
        }
    }
</script>

{#if category}
    <PageTitle title={category.title} />
{/if}

<svelte:window on:keydown={handleKeydown}/>

<Layout>
    {#if category}
        <div class="flex justify-center" transition:fly={{ y: -200 }}>
            <div class="2xl:w-3/5 w-full p-8">
                <TodoCard list={category} {todos} {todosDone} />
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
