<template>
    <div>
        <h1>{{ titulo }}
            <span v-if="!switchEdit && active_line == 0 && nuevo.sumillas ">
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
                        <span v-if="switchEdit && active_line == 'new'">
                            <span v-for="item in newItem.data">
                                <textarea name="newText" rows="6" wrap="hard" :class="rowClass(item, newItem)" :align="align(item)" v-model="item.texto">"{{item.texto}}"</textarea>
                            </span>                            
                        </span>
                    </div>
                </tr>
                <tr v-for="linea in items">
                    <div class="row">
                        <span v-for="item in linea.data">                  
                            <span v-if="!switchEdit && active_line != linea.id && active_line != 'new'">
                                <!-- view -->
                                <span :class="rowClass(item, linea)" :align="align(item)" v-html="viewTexto(item)"></span>
                            </span>
                            <span v-if="switchEdit && active_line == linea.id && linea.tipo == status">
                                <!-- edit -->
                                <textarea rows="6" wrap="hard" :class="rowClass(item, linea)" :align="align(item)" v-model="item.texto">{{item.texto}}</textarea>
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
            console.log('Sumillas.vue mounted');
            this.setTitulo('sumillas');
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
            items(){ return this.$store.getters.sumillas },
            newItem(){ return this.$store.getters.newItem },
        }),
        methods: {
            align(item){
                return 'justify';
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
            borrar(linea) {
                toastr.closeButton = false;
                toastr.debug = false;
                toastr.showDuration = 100;
                var check = this.$store.dispatch('BorrarContenido', linea);
                if(check) {
                    toastr.success('Sumilla eliminada.');
                }
            },
            consistencia(linea){
                toastr.closeButton = false;
                toastr.debug = false;
                toastr.showDuration = 100;
                var mess = '';
                var consistencia = 0;

                var check = linea.data[0].texto;
                if(check.trim().length > 0){
                    consistencia = consistencia + 1;
                }else{
                    mess = 'Inserte el texto SUMILLA.';
                }
                if(consistencia == 1){
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
                        toastr.success('Sumilla grabada.');
                    }else{
                        linea.semana = linea.data[0].texto;
                        var linea = this.recalcRow(linea);
                        this.$store.dispatch('SaveLinea', linea);
                        toastr.success('Sumilla grabada.');
                    }
                };
            },
            recalcRow(oldLinea){
                var xsemana = oldLinea.semana;
                var titulo = this.lineas.filter((linea) => linea.tipo == 'titulo1' && linea.subtipo == 'sumillas');
                var rowTitulo = titulo[0].row;
                var newRow =  rowTitulo + (xsemana * 100);
                var newLinea = oldLinea;
                newLinea.row = newRow;
                return newLinea;
            },
            viewTexto(item){
                var newText = item.texto.toString().replace(/\n/g, '<br>');
                return newText;
            },
            rowClass(item, linea) {
                if(linea.tipo == 'sumillas'){
                    return 'id'+linea.id + ' col-'+item.col+' '+linea.tipo+' col-xs-' + item.cols + ' col-xs-offset-' + item.offset + ' componente';
                }else{
                    return 'col-1 sumillas col-xs-8 col-xs-offset-1';
                }
            },

            buttonClass(type, linea) {
                if(linea.tipo == 'sumillas'){
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
    .col-1.sumillas.componente, 
    .col-2.sumillas.componente,
    .col-3.sumillas.componente, 
    .col-4.sumillas.componente, 
    .col-6.sumillas
    {
        margin-left: 0px;
    } 

    .sumillas.componente {
        border: 0px solid black;
    }

    #viewTexto {
        white-space: pre-wrap;
    }

    .idnew {
        background: yellow;
    }
</style>