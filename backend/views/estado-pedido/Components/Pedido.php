<script id="pedido-template" type="text/x-template">
    <div>
        <div class="d-flex flex-wrap">
            <template v-for="item in labels">
                <div class="col-md-6 border border-info pt-1 pb-1">
                    <span class="">{{item.label}}: {{pedido[item.field]}}</span>
                </div>
            </template>
        </div>
    </div>
</script>

<script>
    const Pedido = {
        name: 'pedido',
        template: '#pedido-template',
        props: {
            pedido: Object,
            labels: Array,
        },
    }

</script>
