<template>
    <aside class="right-aside">
        <section class="content">
            <slot />
        </section>
    </aside>
</template>
<script>
export default {
    name: 'right-side',
    methods: {},
};
</script>
<style lang="scss" scoped>
.right-aside {
    padding: 44px 56px;
    width: 100%;
    max-width: 100%;
    background: #e5eaed;
    color: #2e2e2e;
    flex: auto;
    min-height: 0;
    overflow: auto;
}
</style>
