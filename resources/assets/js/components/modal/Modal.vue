<template>
    <div :id="nome" class="modal fade" tabindex="-1" role="dialog" :aria-labelledby="nome" 
    aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <slot></slot>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['nome']
    }
</script>
