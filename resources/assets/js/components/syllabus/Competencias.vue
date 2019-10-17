<template>
    <div>
        <h1>{{ titulo }}</h1>
        <table>
            <thead>
                <tr v-for="columna in columnas">
                    <th :width="columna"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="linea in items">
                    <div class="row">
                        <span v-if="linea.editing">
                            <span v-for="item in linea.data">                            
                                <textarea rows="6" wrap="hard" :class="rowclass(item, linea)" :align="item.align" v-model="item.texto">{{item.texto}}</textarea>
                            </span>
                            <button type="submit" :class="buttonclass('Save', linea)" @click='grabar(linea)'>Grabar</button>
                        </span>
                        <span v-else>
                            <span v-for="item in linea.data">    
                                <span v-if="item.view">
                                    <span :class="rowclass(item, linea)" :align="item.align" v-html="viewTexto(item)"></span>
                                </span>                        
                            </span>
                            <span v-if="linea.tipo == 'competencias'">
                                <span v-if="(acceso.competencias_generales && linea.item == '1')
                                        || (acceso.competencias_especificas && linea.item == '2')">
                                    <button type="submit" :class="buttonclass('Edit', linea)" @click='editar(linea)'>Editar</button>
                                </span>                            
                            </span>
                        </span>
                    </div>
                </tr>
            </tbody>
        </table>            
    </div>  
</template>
<script>
    import {mapState} from 'vuex';

    export default {
        mounted() {
            console.log('Competencias.vue mounted');
            this.setTitulo('competencias');
        },
        computed: mapState({
            ...mapState({
                lineas: (state) => state.lineas,
                columnas: (state) => state.columnas,
                titulo: (state) => state.titulo,
                acceso: (state) => state.acceso,
            }),
            items(){ return this.$store.getters.competencias },
        }),
        methods: {
            editar(linea) {
                this.$store.dispatch('EditarContenido', linea);
            },            
            grabar(linea) {
                toastr.closeButton = false;
                toastr.debug = false;
                toastr.showDuration = 50;
                var mess = '';
                var consistencia = 0;

                var check = linea.data[0].texto;
                if(check.trim().length > 0){
                    consistencia = consistencia + 1;
                }else{
                    mess = 'Inserte el texto.';
                }

                if(consistencia == 1){
                    var check = this.$store.dispatch('GrabarContenido', linea);
                    if(check){
                        toastr.success('Competencia grabada.');
                    }else{
                        toastr.error('El registro no ha sido grabado.');
                    }
                }else{
                    toastr.error(mess);
                }
            },
            viewTexto(item){
                var newText = item.texto.toString().replace(/\n/g, '<br>');
                return newText;
            },
            rowclass(item, linea) {
                if(linea.tipo == 'competencias'){
                    return 'id'+linea.id + ' col-'+item.col+' '+linea.tipo+' col-xs-' + item.cols + ' col-xs-offset-' + item.offset;
                }else{
                    return 'col-1 unidades col-xs-8 col-xs-offset-1';
                }
            },

            buttonclass(type, linea) {
                if(linea.tipo == 'competencias'){
                    return 'btn'+ type + linea.id + ' btn btn-default';
                }else{
                    return 'hidden';
                }
            },

            setTitulo(subtipo) {
                this.$store.dispatch('SetTitulo', subtipo);
            },
        } 
    }
</script>
<style>
    .col-2.titulo3, .col-3.titulo3,  .col-4.titulo3,  .col-6.titulo3, 
    .col-2.contenidos,  .col-3.contenidos,  .col-4.contenidos,  .col-6.contenidos,
    .col-3.generales 
    {
        margin-left: 0px;
    } 

</style>