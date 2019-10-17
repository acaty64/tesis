<template>
    <div>
        <h1>{{ titulo }}
            <span v-if="!switchEdit && active_line == 0">
                <!-- boton Nuevo Registro -->
                <button name="newButton" type="submit" :class="buttonClass(newItem.button, newItem)" @click="editar(newItem)">Nuevo Registro</button>
            </span>
            <span v-if="switchEdit && active_line == 'new'">
                <!-- boton Grabar Nuevo Registro -->
                <button name="newButton" type="submit" :class="buttonClass(newItem.button, newItem)" @click="grabar(newItem, true)">{{ newItem.button }}</button>
            </span>
        </h1>
        <table>
            <thead>
                <tr v-for="columna in columnas">
                    <th :width="columna"></th>
                </tr>
            </thead>
            <tbody>
                <tr>                    
                    <div class="row">                
                        <span class="notEditing col-1 col-xs-2 col-xs-offset-1 bibliografias componente" align='center'><b>Autor(es)</b></span>
                        <span class="notEditing col-2 col-xs-2 col-xs-offset-1 bibliografias componente" align='center'><b>Título</b></span>
                        <span class="notEditing col-3 col-xs-2 col-xs-offset-1 bibliografias componente" align='center'><b>Editorial</b></span>
                        <span class="notEditing col-4 col-xs-1 col-xs-offset-1 bibliografias componente" align='center'><b>Año</b></span>
                        <span class="notEditing col-5 col-xs-2 col-xs-offset-1 bibliografias componente" align='center'><b>Código UCSS</b></span>
                        <span class="notEditing col-6 col-xs-1 col-xs-offset-1 bibliografias componente" align='center'></span>
                    </div>                
                </tr>
                <tr>
                    <div class="row">
                        <span v-if="switchEdit && active_line == 'new'">
                            <span v-for="item in newItem.data">
                                <span v-if='item.view'>
                                    <textarea name="newText" rows="6" wrap="hard" :class="rowClass(item, newItem)" :align="item.align" v-model="item.texto">"{{item.texto}}"</textarea>
                                </span>
                            </span>                            
                        </span>
                    </div>
                </tr>
                <tr v-for="linea in items">
                    <div class="row">
                        <span v-for="item in linea.data">                  
                            <!-- view -->
                            <span v-if="!switchEdit && active_line != linea.id && active_line != 'new' && item.view">
                                <span :class="rowClass(item, linea)" :align="item.align" v-html="viewTexto(item)"></span>
                            </span>
                            <span v-if="switchEdit && active_line == linea.id && linea.tipo == status && item.view">
                                <!-- edit -->
                                <textarea rows="6" wrap="hard" :class="rowClass(item, linea)" :align="item.align" v-model="item.texto">{{item.texto}}</textarea>
                            </span>
                        </span>
                        <span v-if="!switchEdit && active_line == 0">
                            <!-- boton eliminar -->
                            <button type="submit" :class="buttonClass('Erase', linea)" @click='borrar(linea)'>Eliminar</button>
                            <!-- boton editar -->
                            <button type="submit" :class="buttonClass('Edit', linea)" @click='editar(linea)'>Editar</button>
                        </span>              
                        <span v-if="switchEdit && active_line == linea.id && linea.tipo == status">
                            <!-- boton grabar registro editado -->
                            <button type="submit" :class="buttonClass('Save', linea)" @click='grabar(linea, false)'>Grabar</button>
                        </span>
                    </div>
                    <br>
                </tr>
            </tbody>
        </table>            
    </div>  
</template>
<script>
    import {mapState} from 'vuex';

    export default {
        mounted() {
            console.log('Bibliografias.vue mounted');
            this.setTitulo('bibliografias');
            this.setDefault();
        },
        computed: mapState({
            ...mapState({
                lineas: (state) => state.lineas,
                columnas: (state) => state.columnas,
                titulo: (state) => state.titulo,
                acceso: (state) => state.acceso,
                nuevo: (state) => state.nuevo,
                active_line: (state) => state.active_line,
                switchEdit: (state) => state.switchEdit,
                status: (state) => state.status,
            }),

            items(){ 
                var lineas = this.$store.getters.bibliografias;
                /* Modifica col y cols del texto */ 
                for(var linea in lineas){
                    lineas[linea]['data'][0].col = 1;
                    lineas[linea]['data'][0].cols = 1;
                    lineas[linea]['data'][0].offset = 1;
                    lineas[linea]['data'][0].align = 'center';

                    lineas[linea]['data'][1].col = 2;
                    lineas[linea]['data'][1].cols = 2;
                    lineas[linea]['data'][1].offset = 1;
                    lineas[linea]['data'][1].align = 'left';

                    lineas[linea]['data'][2].col = 3;
                    lineas[linea]['data'][2].cols = 2;
                    lineas[linea]['data'][2].offset = 1;
                    lineas[linea]['data'][2].align = 'left';

                    lineas[linea]['data'][3].col = 4;
                    lineas[linea]['data'][3].cols = 2;
                    lineas[linea]['data'][3].offset = 1;
                    lineas[linea]['data'][3].align = 'left';

                    lineas[linea]['data'][4].col = 5;
                    lineas[linea]['data'][4].cols = 1;
                    lineas[linea]['data'][4].offset = 1;
                    lineas[linea]['data'][4].align = 'center';

                    lineas[linea]['data'][5].col = 6;
                    lineas[linea]['data'][5].cols = 2;
                    lineas[linea]['data'][5].offset = 1;
                    lineas[linea]['data'][5].align = 'left';
                }
                return lineas; 
            },

            //items(){ return this.$store.getters.bibliografias },
            newItem(){ return this.$store.getters.newItem },
        }),
        methods: {
            borrar(linea) {
                toastr.closeButton = false;
                toastr.debug = false;
                toastr.showDuration = 100;
                var check = this.$store.dispatch('BorrarContenido', linea);
                if(check) {
                    toastr.success('Bibliografía eliminada.');
                }
            },
            setDefault(){
                this.$store.commit('setDefault');
            },
            editar(linea) {
                if(linea.id == 'new'){
                    this.$store.dispatch('SetNewItemValue', ['button', 'Grabar']);
                }else{
                    this.$store.dispatch('EditarContenido', linea);
                }
            },
            consistencia(linea){
                toastr.closeButton = false;
                toastr.debug = false;
                toastr.showDuration = 50;
                var mess = '';
                var consistencia = 0;
                var check = linea.data[5].texto;
                if(check.trim().length > 0){
                    consistencia = consistencia + 1;
                }else{
                    mess = 'Inserte el código de biblioteca UCSS o * para indicar que está pendiente de adquirir.';
                }
                var check = linea.data[4].texto;
                if(!isNaN(check) && check > 1900){
                    consistencia = consistencia + 1;
                }else{
                    mess = 'El AÑO debe ser un número entero mayor a 1900.';
                }
                var check = linea.data[3].texto;
                if(check.trim().length > 0){
                    consistencia = consistencia + 1;
                }else{
                    mess = 'Inserte el texto EDITORIAL.';
                }
                var check = linea.data[2].texto;
                if(check.trim().length > 0){
                    consistencia = consistencia + 1;
                }else{
                    mess = 'Inserte el texto TÍTULO.';
                }
                var check = linea.data[1].texto;
                if(check.trim().length > 0){
                    consistencia = consistencia + 1;
                }else{
                    mess = 'Inserte el texto AUTOR(ES).';
                }

                if(consistencia == 4){                
                    return true;
                }else{
                    toastr.error(mess);
                    return false;
                }
            },            
            grabar(linea) {
                toastr.closeButton = false;
                toastr.debug = false;
                toastr.showDuration = 50;
                if(this.consistencia(linea)){                
                    if(linea.id == 'new'){
                        this.$store.dispatch('SaveNewLinea', this.newItem).then(function () {
                            toastr.success('Bibliografía grabada.');
                        }).catch(function () {
                            toastr.error('El registro no ha sido grabado.');
                        });
                    }else{
                        this.$store.dispatch('SaveLinea', linea).then(function() {
                            toastr.success('Bibliografía grabada.');
                        }).catch(function () {
                            toastr.error('El registro no ha sido grabado.');
                        });

                    }
//                    this.$store.dispatch('OrdenarPorAutor');
                };
                
            },

            viewTexto(item){
                var newText = item.texto.toString().replace(/\n/g, '<br>');
                return newText;
            },

            rowClass(item, linea) {
                if(linea.tipo == 'bibliografias'){
                    return 'id'+linea.id + ' col-'+(parseInt(item.col)-1)+' '+linea.tipo+' col-xs-' + item.cols + ' col-xs-offset-' + item.offset + ' componente';
                }else{
                    return 'col-1 unidades col-xs-8 col-xs-offset-1 componente';
                }
            },

            buttonClass(type, linea) {
                if(linea.tipo == 'bibliografias'){
                    return 'col-7 btn'+ type + linea.id + ' btn btn-default';
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
    .col-1.bibliografias.componente,
    .col-2.bibliografias.componente,
    .col-3.bibliografias.componente,
    .col-4.bibliografias.componente,
    .col-5.bibliografias.componente,
    .col-6.bibliografias.componente,
    .col-7
    {
        margin-left: 0px;
    } 

    #viewTexto {
        white-space: pre-wrap;
    }

    .idnew {
        background: yellow;
    }
</style>