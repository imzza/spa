<template>
    <div class="custom-actions">
        <button class="btn btn-primary btn-sm" @click="itemAction('edit', rowData, rowIndex)">
            <i class="fa fa-pencil" />
        </button>
        <button class="btn btn-primary btn-sm" @click="itemAction('delete', rowData, rowIndex)">
            <i class="fa fa-trash" />
        </button>
    </div>
</template>
<script>
export default {
    props: {
        rowData: {
            type: Object,
            required: true,
        },
        rowIndex: {
            type: Number,
        },
    },
    methods: {
        itemAction(action, data, index) {
            if (action == 'edit') {
                this.$router.push({ path: '/admin/students_edit/' + data.id });
            } else if (action == 'delete') {
                Notify.confirm().then(resp => {
                    EventBus.$emit('DELETE_CONTACT', { id: data.id, index: index });
                });
            }
            console.log('custom-actions: ' + action, data, index);
        },
    },
};
</script>
<style></style>
