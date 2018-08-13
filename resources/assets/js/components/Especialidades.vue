<template>
  <div>
    <h1 v-show="!edit"> Adiciona Especialidade</h1>
    <h1 v-show="edit"> Altera Especialidade</h1>
    <form action="#" enctype = 'multipart/form-data' @submit.prevent="edit ? updateEspecialidade(especialidade.id) : createEspecialidade()">
      <div class="form-group">
        <label>Nome</label>
        <input v-model="especialidade.nome" type="text" name="nome" class="form-control">
      </div>
      <div class ="form-group">
        <button v-show="!edit" type="submit" class="btn btn-primary">Nova Especialidade</button>
        <button v-show="edit" type="submit" class="btn btn-primary">Altera Especialidade</button>
      </div>
    </form>
    <h1>Especialidades</h1>
    <ul class = "list-group">
      <li class = "list-group-item" v-for="especialidade in list">
        <strong>{{especialidade.nome}}</strong>
        <button @click="showEspecialidade(especialidade.id)" class= "btn btn-default btn-xs">Alterar</button>
        <button @click="deleteEspecialidade(especialidade.id)" class= "btn btn-danger btn-xs">Apagar</button>
      </li>
    </ul>
  </div>
</template>

<script>
  export default {
    data: function(){
      return {
        edit:false,
        list:[],
        especialidade:{
          id:'',
          nome:''
        }
      }
    },
    mounted: function(){
        console.log("Componente especialidades carregado.");
        this.fetchEspecialidadeList();
    },
    methods:{
      fetchEspecialidadeList: function(){
        console.log('Carregando a lista');
        axios.get('api/especialidades')
          .then((response) => {
            this.list = response.data;
          })
          .catch(function(error) {
            console.log(error);
          });

          console.log("aqui");
      },
      createEspecialidade: function(){
        console.log('Criando uma nova especialidade');
        let self = this;
        let params = Object.assign({}, self.especialidade);
        axios.post('api/especialidades', params)
          .then(function(response){
            self.especialidade.nome = "";
            self.edit = false;
            self.fetchEspecialidadeList();
          }).
          catch(function(error){
            console.log(error);
          });
      },
      showEspecialidade: function(id){
        let self = this;
        axios.get("api/especialidades/"+id)
          .then(function (response){
            self.especialidade.id= response.data.id;
            self.especialidade.nome= response.data.nome;
          });
        self.edit = true;

      },
      updateEspecialidade: function(id){
        let self = this;
        let params = Object.assign({}, self.especialidade);
        axios.put("api/especialidades/"+id, params)
          .then(function(response) {
            console.log('Aqui 2')
            self.especialidade.nome = "";
            self.edit = false;
            self.fetchEspecialidadeList();
          })
          .catch(function(error){
            console.log(error);
          });
      },
      deleteEspecialidade: function(id){
        axios.delete("api/especialidades/"+id)
          .then(function(response){
            self.fetchEspecialidadeList();
          })
          .catch(function(error){
            console.log(error);
          });
      }
    }
  }
</script>
