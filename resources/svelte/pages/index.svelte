<script>
    import { scale } from 'svelte/transition';

    import PageTitle from "../components/page-title.svelte";
    import Layout from "../components/layout.svelte";
    import Icon from "../components/icon.svelte";
</script>

<PageTitle />

<Layout>
    <div class="flex justify-center items-center h-full">
        <div class="flex flex-col justify-between items-center" in:scale={{ duration: 500, opacity: 0.5, start: 0.7 }}>
            <Icon name="folder-list" sizeClass="w-20 h-20" className="mb-4 opacity-50"/>
            <p class="text-center">برای مشاهده یا افزودن تسک، یکی از لیست ها را انتخاب کنید.</p>
        </div>
    </div>
</Layout>
