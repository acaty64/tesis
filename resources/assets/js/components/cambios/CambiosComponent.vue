<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            <span v-if="consistencia">
              <button @click="saveData()">Ejecutar Cambio</button>
            </span>
          </div>
          <div class="panel-body">
            <div class="col-md-3">
              <label for="">Tipo de cambio</label><br>
              <input type="radio" id="codigo" value="codigo" v-model="type_data" /><label for="codigo">Codigo</label><br>
              <input type="radio" id="descripcion" value="descripcion" v-model="type_data" /><label for="descripcion">Descripcion</label><br>
            </div>
            <div class="col-md-4">
              <label for="search">Buscar curso: </label>

              <input type="text" id="search" v-model="search" @change="buscar(search.toUpperCase())" />
                <select dusk="sel_curso" id="sel_curso" v-model="item" class="form-control" v-on:change="selectCurso">
                  <option v-for="item in items" :value="item">
                    {{ item.cod_curso }} {{ item.wcurso }}
                  </option>
                </select>
            </div>
            <div class="col-md-4">
              <label for="new_data">Nuevo Valor: </label>
              <input type="text" id="new_data" v-model="new_data" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        mounted() {
            console.log('CambiosComponent mounted.');
            this.getData();
            toastr.closeButton = false;
            toastr.debug = false;
            toastr.showDuration = 100;
        },
        data(){
          return {          
            cursos: [],
            old_data: [],
            new_data: '',
            type_data: '',
            item:[],
            items:[],
            search:'',
            URLdomain: window.location.host,
            protocol: window.location.protocol,
          }
        },
        computed: {
          consistencia: function () {
            switch(this.type_data){
              case 'codigo':
                if(this.new_data.length != 6){
                  return false;
                }
                break;
              case 'descripcion':
                this.new_data = this.new_data.toUpperCase();
                this.new_data = this.new_data.trim();
                if(this.new_data.length == 0){
                  return false;
                }
                break;
              default:
                return false;
            }
            if(this.item.length == 0){
              return false
            }
            return true;
          },
        },
        methods: {
          saveData(){
            if(this.consistencia){
              // alert('Grabar informacion. EN CONSTRUCCION');
              var request = {
                  'sw_change': this.type_data,
                  'cod_curso': this.item.cod_curso,
                  'new_data': this.new_data
                };
              var url = this.protocol+'//'+this.URLdomain+'/api/cambios/change';
              axios.post(url, request).then(response=>{
console.log(response.data);
                toastr.success('Cambio de ' + request.sw_change + ' en codigo '+request.cod_curso+' a: '+request.new_data);
                this.new_data = '';
                this.search = '';
                this.getData();
              }).catch(function (error) {
                  console.log('error getData: ', error);
              });

            };
          },
          getData(){
            var url = this.protocol+'//'+this.URLdomain+'/api/cambios/upload';
            axios.get(url).then(response=>{
                this.cursos = response.data.data.cursos;
                this.items = this.cursos;
            }).catch(function (error) {
                console.log('error getData: ', error);
            });
          },
          selectCurso(){
            this.old_data = this.item; 
          },
          buscar(search){
            this.search = search;
            this.items = this.cursos.filter(function (item) {
                return item.wcurso.indexOf(search) > -1;
            });
          },
        },
    }
</script>
