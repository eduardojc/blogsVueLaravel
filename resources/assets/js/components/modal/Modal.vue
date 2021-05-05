<template>
    <div :id="nome" class="modal fade" tabindex="-1" role="dialog" :aria-labelledby="nome" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" style="display: inline-block; float: left">{{ titulo }}</h3>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="close" @click="fecharModal()"> X </button>
                </div>
                <div class="modal-body">
                    <slot></slot>
                </div>
                <div class="modal-footer">
                    <slot name="botoes"></slot>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="fecharModal()">Close</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['nome','titulo'],
        methods: {
            fecharModal: function() {
                $('#' + this.nome).modal('hide');
            }
        }
    }
</script>
