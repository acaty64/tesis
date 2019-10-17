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
                        <span class="notEditing col-1 col-xs-1 col-xs-offset-1 contenidos componente" align='center'><b>SEMANA</b></span>
                        <span class="notEditing col-2 col-xs-4 col-xs-offset-1 contenidos componente" align='center'><b>CONCEPTUAL</b></span>
                        <span class="notEditing col-4 col-xs-2 col-xs-offset-1 contenidos componente" align='center'><b>PROCEDIMENTAL</b></span>
                        <span class="notEditing col-6 col-xs-2 col-xs-offset-1 contenidos componente" align='center'><b>ACTIVIDAD DE APRENDIZAJE</b></span>
                    </div>                
                </tr>
                <tr>
                    <div class="row">
                        <span v-if="switchEdit && active_line == 'new'">
                            <span v-for="item in newItem.data">
                                <textarea name="newText" rows="6" wrap="hard" :class="rowClass(item, newItem)" :align="item.align" v-model="item.texto">"{{item.texto}}"</textarea>
                            </span>                            
                        </span>
                    </div>
                </tr>
                <tr v-for="linea in items">
                    <div class="row">
                        <span v-for="item in linea.data">                  
                            <span v-if="!switchEdit && active_line != linea.id && item.view && active_line != 'new'">
                                <!-- view -->
                                <!-- <span :class="rowClass(item, linea)" :align="item.align" v-html="viewTexto(item)"></span> -->
                                <span :class="rowClass(item, linea)" :align="item.align" v-html="item.texto"></span>
                            </span>
                            <span v-if="switchEdit && active_line == linea.id && linea.tipo == status">
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
                </tr>
            </tbody>
        </table>            
    </div>  
</template>
<script>
    import {mapState} from 'vuex';

    export default {
        mounted() {
            console.log('Contenidos.vue mounted');
            this.setTitulo('contenidos');
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
            items(){ return this.$store.getters.contenidos },
            newItem(){ return this.$store.getters.newItem },
        }),
        methods: {
            borrar(linea) {
                toastr.closeButton = false;
                toastr.debug = false;
                toastr.showDuration = 100;
                var check = this.$store.dispatch('BorrarContenido', linea);
                if(check) {
                    toastr.success('Contenido eliminado.');
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

                var check = linea.data[0].texto;
                if(!isNaN(check) && check > 0 && check < 17){ 
                    consistencia = consistencia + 1;
                }else{
                    mess = 'La SEMANA debe ser un número entero mayor que 0 y menor a 17.';
                }
                var check = linea.data[1].texto;
                if(check.trim().length > 0){
                    consistencia = consistencia + 1;
                }else{
                    mess = 'Inserte el texto CONCEPTUAL.';
                }
                var check = linea.data[2].texto;
                if(check.trim().length > 0){
                    consistencia = consistencia + 1;
                }else{
                    mess = 'Inserte el texto PROCEDIMENTAL.';
                }
                var check = linea.data[3].texto;
                if(check.trim().length > 0){
                    consistencia = consistencia + 1;
                }else{
                    mess = 'Inserte el texto ACTIVIDAD.';
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
                toastr.showDuration = 100;
                if(this.consistencia(linea)){                
                    if(linea.id == 'new'){
                        this.$store.dispatch('SaveNewLinea', linea);
                        toastr.success('Contenido grabado.');
                    }else{
                        linea.semana = linea.data[0].texto;
                        var linea = this.recalcRow(linea);
                        this.$store.dispatch('SaveLinea', linea);
                        toastr.success('Contenido grabado.');
                    }
                };



/*
                toastr.closeButton = false;
                toastr.debug = false;
                toastr.showDuration = 50;
                if(this.consistencia(linea)){                
                    if(linea.id == 'new'){
                        this.$store.dispatch('SaveNewLinea', this.newItem).then(function () {
                            toastr.success('Contenido grabado.');
                            this.$store.commit('newItem');
                        }).catch(function () {
                            toastr.error('El registro no ha sido grabado.');
                        });
                    }else{
                        linea.semana = linea.data[0].texto;
                        var linea = this.recalcRow(linea);
                        this.$store.dispatch('SaveLinea', linea).then(function() {
                                toastr.success('Contenido grabado.');
                        }).catch(function () {
                            toastr.error('El registro no ha sido grabado.');
                        });

                    }
                };
*/
            },
            recalcRow(oldLinea){
                var xsemana = oldLinea.semana;
                var titulo = this.lineas.filter((linea) => linea.tipo == 'titulo1' && linea.subtipo == this.status);
                var rowTitulo = titulo[0].row;
                var semanas = this.lineas.filter((linea) => linea.tipo == this.status && linea.subtipo == this.status && linea.semana == xsemana).length;
                var newRow =  rowTitulo + (xsemana * 100) + semanas;
                oldLinea.row = newRow;
                return oldLinea;
            },
            viewTexto(item){
                var newText = item.texto.toString().replace(/\n/g, '<br>');
                return newText;
            },
            rowClass(item, linea) {
                if(linea.tipo == 'contenidos'){
                    return 'id'+linea.id + ' col-'+item.col+' '+linea.tipo+' col-xs-' + item.cols + ' col-xs-offset-' + item.offset + ' componente';
                }else{
                    return 'col-1 titulo3 col-xs-11 col-xs-offset-1 componente';
                }
            },

            buttonClass(type, linea) {
                if(linea.tipo == 'contenidos'){
                    return 'btn'+ type + linea.id + ' btn btn-default';
                }else{
                    return 'hidden';
                }
            },

            setTitulo(subtipo) {
                this.$store.dispatch('SetTitulo', subtipo);
            },
        } 
    };
</script>
<style>
    .titulo3.componente,
    .contenidos.componente
    {
        margin-left: 0px;
    } 

    .titulo3.componente {
        border: 0.5px solid black;
    }

    #viewTexto {
        white-space: pre-wrap;
    }

    .idnew {
        background: yellow;
    }
</style>