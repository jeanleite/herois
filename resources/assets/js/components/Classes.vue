<template>
  <div>
    <h1 v-show="!edit"> Adiciona Classe</h1>
    <h1 v-show="edit"> Altera Classe</h1>
    <form action="#" enctype = 'multipart/form-data' @submit.prevent="edit ? updateClasse(classe.id) : createClasse()">
      <div class="form-group">
        <label>Nome</label>
        <input v-model="classe.nome" type="text" name="nome" class="form-control">
      </div>
      <div class ="form-group">
        <button v-show="!edit" type="submit" class="btn btn-primary">Nova Classe</button>
        <button v-show="edit" type="submit" class="btn btn-primary">Altera Classe</button>
      </div>
    </form>
    <h1>classes</h1>
    <ul class = "list-group">
      <li class = "list-group-item" v-for="classe in list">
        <strong>{{classe.nome}}</strong>
        <button @click="showClasse(classe.id)" class= "btn btn-default btn-xs">Alterar</button>
        <button @click="deleteClasse(classe.id)" class= "btn btn-danger btn-xs">Apagar</button>
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
        classe:{
          id:'',
          nome:''
        }
      }
    },
    mounted: function(){
        console.log("Componente classes carregado.");
        this.fetchClasseList();
    },
    methods:{
      fetchClasseList: function(){
        console.log('Carregando a lista');
        axios.get('api/classes')
          .then((response) => {
            this.list = response.data;
            console.log(this.list);
          })
          .catch(function(error) {
            console.log(error);
          });
      },
      createClasse: function(){
        console.log('Criando uma nova classe');
        let self = this;
        let params = Object.assign({}, self.classe);
        axios.post('api/classes', params)
          .then(function(response){
            self.classe.nome = "";
            self.edit = false;
            self.fetchClasseList();
          }).
          catch(function(error){
            console.log(error);
          });
      },
      showClasse: function(id){
        let self = this;
        axios.get("api/classes/"+id)
          .then(function (response){
            self.classe.id= response.data.id;
            self.classe.nome= response.data.nome;
          });
        self.edit = true;

      },
      updateClasse: function(id){
        let self = this;
        let params = Object.assign({}, self.classe);
        axios.put('api/classes/'+id, params)
          .then(function(response){
            self.classe.nome = "";
            self.edit = false;
            self.fetchClasseList();
        })
        .catch(function(error){
          console.log(error);
        });
      },
      deleteClasse: function(id){
        axios.delete('api/classes/'+id)
          .then(function(response){
            self.fetchClasseList();
          })
          .catch(function(error){
            console.log(error);
          });
      }
    }
  }
</script>
