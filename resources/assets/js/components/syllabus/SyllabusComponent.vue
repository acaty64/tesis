<template>
    <main class="SyllabusComponent">
        <!--img src="/images/if_Loading_throbber_103105.png" v-if="loading" /-->
        <img src="/images/loading.gif" v-if="loading" />
        <span v-if="!loading">
            <span v-if="edit">            
                <button type="button" name="vista" class="btn btn-default" @click='view("vista")'>Vista</button>
                <span v-if="acceso.generales">            
                    <button type="button" name="generales" class="btn btn-default" @click='view("generales")'>Generalidades</button>
                </span>
                <span v-if="acceso.sumillas">            
                    <button type="button" name="sumillas" class="btn btn-default" @click='view("sumillas")'>Sumillas</button>
                </span>
                <span v-if="acceso.competencias">            
                    <button type="button" name="competencias" class="btn btn-default" @click='view("competencias")'>Competencias</button>
                </span>
                <span v-if="acceso.unidades">            
                    <button type="button" name="unidades" class="btn btn-default" @click='view("unidades")'>Unidades</button>
                </span>
                <span v-if="acceso.contenidos">            
                    <button type="button" name="contenidos" class="btn btn-default" @click='view("contenidos")'>Contenidos</button>
                </span>
                <span v-if="acceso.estrategias">            
                    <button type="button" name="estrategias" class="btn btn-default" @click='view("estrategias")'>Estrategias</button>
                </span>
                <span v-if="acceso.evaluaciones">            
                    <button type="button" name="evaluaciones" class="btn btn-default" @click='view("evaluaciones")'>Evaluaciones</button>
                </span>
                <span v-if="acceso.bibliografias">            
                    <button type="button" name="bibliografias" class="btn btn-default" @click='view("bibliografias")'>Bibliografias</button>
                </span>
            </span>        
        </span>
        <span v-if="status == 'vista'">
            <vista></vista>
        </span>
        <span v-if="status == 'generales'">
            <generales></generales>
        </span>
        <span v-if="status == 'sumillas'">
            <sumillas></sumillas>
        </span>
        <span v-if="status == 'unidades'">
            <unidades></unidades>
        </span>
        <span v-if="status == 'competencias'">
            <competencias></competencias>
        </span>
        <span v-if="status == 'contenidos'">
            <contenidos></contenidos>
        </span>
        <span v-if="status == 'estrategias'">
            <estrategias></estrategias>
        </span>
        <span v-if="status == 'evaluaciones'">
            <evaluaciones></evaluaciones>
        </span>
        <span v-if="status == 'bibliografias'">
            <bibliografias></bibliografias>
        </span>
    </main>
</template>
<script>
    import vista from './Vista';
	import generales from './Generales';
    import sumillas from './Sumillas';
    import unidades from './Unidades';
    import competencias from './Competencias';
    import contenidos from './Contenidos';
    import estrategias from './Estrategias';
    import evaluaciones from './Evaluaciones';
    import bibliografias from './Bibliografias';
    import {mapState} from 'vuex';
    import axios from 'axios'

    export default {
        props:['semestre', 'cod_curso', 'edit', 'user_id'],
//        props:['especialidad', 'semestre', 'cod_curso'],
        mounted() {
            console.log('SyllabusComponent.vue mounted.');
            this.setData();
            this.getData();
        },
        components: {
            vista, generales, sumillas, competencias, unidades, contenidos, estrategias, evaluaciones, bibliografias
        },
        computed: mapState(['status', 'loading', 'acceso']),
        methods:{
            view(tipo){
                this.$store.commit('view', tipo);
            },
            setData() {
//console.log('setData: ', this.especialidad);
//                this.$store.commit('setEspecialidad', this.especialidad);
                this.$store.commit('setSemestre', this.semestre);
                this.$store.commit('setCod_curso', this.cod_curso);
                this.$store.commit('setEdit', this.edit);
            },
            getData: function() {
                var request = {
                      'cod_curso': this.cod_curso,
                      'semestre' : this.semestre,
                      'user_id': this.user_id,
                  };
//console.log('request: ',request);
                var URLdomain = window.location.host;
                var protocol = window.location.protocol;
                var url = protocol+'//'+URLdomain+'/api/index/';
                axios.post(url, request).then(response=>{
//console.log('response.data.acceso: ',response.data.acceso);
                    //this.lineas = response.data.data;
                    this.$store.commit('setLineas', response.data.data);
                    this.$store.commit('sortLineasRow');
                    this.$store.commit('setAcceso', response.data.acceso);
                    this.$store.commit('loaded');
                }).catch(function (error) {
                    console.log(error);
                    this.$store.commit('loaded');
                });
            },
        },
    };
</script>


<!--

                    <a href="{{ route('PDF', [env('SEMESTRE'), $cod_curso, 'screen']) }}" class="btn btn-success" data-toggle="tooltip" title="PDF view" name = "{{'PDF_view'.$cod_curso}}"><span class="glyphicon glyphicon-fullscreen" aria-hidden='true'></span></a>
                <a href="{{ route('PDF', [env('SEMESTRE'), $cod_curso, 'download']) }}" class="btn btn-success" data-toggle="tooltip" title="PDF download" name = "{{'PDF_dwnl'.$cod_curso}}"><span class="glyphicon glyphicon-download-alt" aria-hidden='true'></span></a>
-->