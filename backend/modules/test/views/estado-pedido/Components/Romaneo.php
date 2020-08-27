<script id="romaneo-template" type="text/x-template">
<div>
    <table class="table table-striped table-inverse table-bordered items-table">
        <thead class="thead-inverse">
        <tr>
            <th class="d-none d-lg-table-cell">Item Data</th>
            <th class="d-none d-lg-table-cell">Codigo Articulo</th>
            <th>Descripción Tela</th>
            <th class="d-none d-lg-table-cell">Código Variante</th>
            <th>Nombre Variante</th>
            <th>Piezas pedidas</th>
            <th>Precio</th>
            <th>Imagen</th>
        </tr>
        </thead>
        <tbody>
        <template v-for="item,j in items">
            <tr>
                <td class="d-none d-lg-table-cell">
                    {{item.itemdata}}
                </td>
                <td class="d-none d-lg-table-cell">
                    {{item.articulo}}
                </td>
                <td>
                    {{item.art_desc}}
                </td>
                <td class="d-none d-lg-table-cell">
                    {{item.variante}}
                </td>
                <td class="">
                    {{item.var_desc}}
                </td>
                <td>
                    {{item.pza_ped}}
                </td>
                <td>
                    {{item.precio}}
                </td>
                <td>
                    <div>
                        <!--                                <img class="d-none d-md-block" ref="imagen">-->
                        <img  class="item-image" ref="imagen">
                    </div>
                </td>

                <!--                        <template v-for="value,label in item">-->
                <!--                            <td>-->
                <!--                                <div v-html="value"></div>-->
                <!---->
                <!--                            </td>-->
                <!--                        </template>-->
            </tr>
        </template>
        </tbody>
    </table>
</div>
</script>

<script>
    const Romaneo = {
        name: 'romaneo',
        template: '#romaneo-template',
        props: {
            items: Array,
        },
    }

</script>
