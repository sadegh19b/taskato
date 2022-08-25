<script>
    export let title;
</script>

<svelte:head>
    <title>{title ? `${title} | Taskato` : 'Taskato'}</title>
</svelte:head>
