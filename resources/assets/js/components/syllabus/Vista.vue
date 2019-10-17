<template>
	<div class="Vista">
        <table>
            <thead>
                <tr v-for="columna in columnas">
                    <th :width="columna"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="fila in items">
                    <div class="row">
                        <span v-if="fila['tipo'] == 'titulo1'">
                            <span v-for="item in fila.data">
                                <span :class="rowclass(item, fila.tipo)" :align="item.align" v-html="getTitulo(fila)"></span>
                            </span>    
                        </span>
                        <span v-else-if="fila['tipo'] == 'unidades'">
                            <span v-for="item in fila.data">
                                <span v-if="item['view']==true">
                                    <span :class="rowclass(item, fila.tipo)" :align="item.align" v-html="viewUnidad(item, fila)"></span>
                                </span>
                            </span>
                        </span>
                        <span v-else-if="fila['tipo'] == 'evaluaciones'">
                            <span v-for="item in fila.data">
                                <span :class="rowclass(item, fila.tipo)" :align="item.align" v-html="viewEvaluacion(item)"></span>
                            </span>                            
                        </span>
                        <span v-else-if="fila['tipo'] == 'bibliografias'">
                            <span v-for="item in fila.data">
                                <span :class="rowclass(item, fila.tipo)" :align="item.align" v-html="viewBibliografia(fila, item)"></span>
                            </span>
                        </span>
                        <span v-else>
                            <span v-for="item in fila.data">
                                <span :class="rowclass(item, fila.tipo)" :align="item.align" v-html="viewTexto(item)"></span>
                            </span>
                        </span>
                    </div>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    import { mapState } from 'vuex';

    export default {
        mounted() {
            console.log('Vista.vue mounted');
        },

        computed: {
            ...mapState({
                items: (state) => state.lineas,
                columnas: (state) => state.columnas,
                romanos: (state) => state.romanos,
            }),
        },

        methods: {
            getTitulo(linea){
                var titulo = this.romanos[linea.orden]+'. '+linea.data[0].texto; 
                return titulo;
            },

            rowclass(item, tipo){
                switch (tipo){
                    case 'unidades': {
                        return 'col-2 unidades col-xs-9 col-xs-offset-1 vista';
                    };
                    case 'bibliografias': {
                        switch (item.col){
                            case 1: {
                                return 'col-1 bibliografias col-xs-1 col-xs-offset-1 vista';
                            };
                            case 2: {
                                return 'col-2 bibliografias col-xs-6 col-xs-offset-1 vista';
                            };
                            default: {
                                return '';
                            };
                        }
                    };
                    default: {
                        return 'col-'+item.col+' '+tipo+' col-xs-' + item.cols + ' col-xs-offset-' + item.offset + ' vista';
                    };
                }
            },

            viewTexto(item){
                if(item.texto != null){
                    var newText = item.texto.toString().replace(/\n/g, '<br>');
                }else{
                    var newText = '';
                }
                return newText;
            },

            viewUnidad(item, linea){                         
                var newText = 'UNIDAD ' + this.romanos[linea.orden] + ': ' + item.texto + '<br>Logro: ' + item.logro;
                return newText;
            },

            viewEvaluacion(item){
                switch(item.type){
                    case 'texto': {
                        return item.texto;
                        break;
                    };
                    case 'porcentaje': {
                        return item.texto + ' %';
                        break;
                    };
                    case 'semana': {
                        var texto = 'semana ' + item.texto;
                        if(item.texto == 0){
                            texto = '';
                        }
                        return texto;
                        break;
                    };
                }
            },

            viewBibliografia(fila, item){

                switch(item.type){
                    case '': {
                        return '';
                        break;
                    };
                    case 'orden': {
                        return '</b>' + item.texto + '</b>';
                        break;
                    };
                    case 'autor': {
                        return '<b>Autor(es): </b>' + fila.data[1].texto + '<br>' + 
                            '<b>Título: </b>' + fila.data[2].texto + '<br>' + 
                            '<b>Editorial: </b>' + fila.data[3].texto + '<br>' + 
                            '<b>Año: </b>' + fila.data[4].texto + '<br>' + 
                            '<b>Ubicación: </b>' + fila.data[5].texto ;
                        break;
                    };
                    default: {
                        return '';
                        break;
                    };
                }
            },
        },
            
    }
</script>

<style>    
    #viewTexto {
        white-space: pre-wrap;
    }

    .titulo0.vista {
        font-size: 25px;
        font-weight: bold;
    }
    .titulo1.vista {
        font-size: 15px;
        font-weight: bold;
        margin-top: 20px;
    }
    .unidades.vista {
        border: 1px solid black;
    }

    .col-2.titulo3.vista, .col-3.titulo3.vista,  .col-4.titulo3.vista,  .col-6.titulo3.vista, 
    .col-2.contenidos.vista, .col-3.contenidos.vista, .col-4.contenidos.vista,  .col-6.contenidos.vista,
    .col-3.generales.vista,
    .col-2.bibliografias.vista, .col-3.bibliografias.vista, .col-4.bibliografias.vista, .col-5.bibliografias.vista, .col-6.bibliografias.vista
    {
        margin-left: 0px;
    }
    
    .col-2.unidades 
    {
        float: left;
    }

    .examenes.vista {
        border: 0.5px solid black;
    }

</style>