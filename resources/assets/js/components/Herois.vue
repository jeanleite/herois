<template>
  <div>
    <h1 v-show="!edit"> Adiciona Heroi</h1>
    <h1 v-show="edit"> Altera Heroi</h1>
    <form action="#" enctype = 'multipart/form-data' @submit.prevent="edit ? updateHeroi(heroi.id) : createHeroi()">
      <div class="form-group">
        <label>Nome</label>
        <input v-model="heroi.nome" type="text" name="nome" class="form-control">
      </div>
      <div class="form-group">
        <label>Classe</label>
        <select v-model="heroi.classe_id" class="form-control">
          <option v-for="classe in classes" v-bind:value="classe.id">
            {{ classe.nome }}
          </option>
        </select>
        <br>
        <span>Selecionado: {{ heroi.classe_id }}</span>
      </div>
      <div class="form-group">
        <label>Especialidades</label>
        <select v-model="heroi.especialidades" class="form-control" multiple>
          <option v-for="especialidade in especialidades" v-bind:value="especialidade.id">
            {{especialidade.nome}}
          </option>
        </select>
        <span>Selecionado:{{heroi.especialidades}}</span>
      </div>
      <div class="form-group">
        <label>Vida</label>
        <input v-model="heroi.vida" type="number" name="vida" class="form-control" min="0">
      </div>
      <div class="form-group">
        <label>Defesa</label>
        <input v-model="heroi.defesa" type="number" name="defesa" class="form-control" min="0">
      </div>
      <div class="form-group">
        <label>Dano</label>
        <input v-model="heroi.dano" type="number" name="dano" class="form-control" min="0">
      </div>
      <div class="form-group">
        <label>Velocidade de Ataque</label>
        <input v-model="heroi.velocidade_ataque" type="number" name="velocidade_ataque" class="form-control" min="0">
      </div>
      <div class="form-group">
        <label>Velocidade de Movimento</label>
        <input v-model="heroi.velocidade_movimento" type="number" name="velocidade_movimento" class="form-control" min = "0">
      </div>

      <div class ="form-group">
        <button v-show="!edit" type="submit" class="btn btn-primary">Nova Heroi</button>
        <button v-show="edit" type="submit" class="btn btn-primary">Altera Heroi</button>
      </div>
    </form>
    <h1>Herois</h1>
    <ul class = "list-group">
      <li class = "list-group-item" v-for="heroi in list">
        <strong>{{heroi.nome}}</strong><br>
        Classe:{{heroi.classe.nome}}<br>
        Especialidades:<span v-for="especialidade in heroi.especialidades">
                        {{especialidade.nome}},
                      </span><br>
        Vida:{{heroi.vida}} Defesa:{{heroi.defesa}} Dano:{{heroi.dano}}<br>
        Velocidade de Ataque: {{heroi.velocidade_ataque}}<br>
        Velocidade de Movimento: {{heroi.velocidade_movimento}}<br>
        <button @click="showHeroi(heroi.id)" class= "btn btn-default btn-xs">Alterar</button>
        <button @click="deleteHeroi(heroi.id)" class= "btn btn-danger btn-xs">Apagar</button>
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
        classes:[],
        especialidades:[],
        heroi:{
          id:'',
          nome:'',
          classe:[],
          classe_id:'',
          especialidades:[],
          vida:'',
          defesa:'',
          dano:'',
          velocidade_ataque:'',
          velocidade_movimento:''
        }
      }
    },
    mounted: function(){
        console.log("Componente herois carregado.");
        this.fetchHeroiList();
    },
    methods:{
      fetchClasseList: function(){
        axios.get('api/classes')
          .then((response)=>{
            this.classes =response.data;
          })
          .catch(function (error){
            console.log(error);
          });
      },
      fetchEspecialidadeList: function(){
        axios.get('api/especialidades')
          .then((response)=>{
            this.especialidades =response.data;
          })
          .catch(function (error){
            console.log(error);
          });
      },
      fetchHeroiList: function(){
        console.log('Carregando a lista');
        axios.get('api/herois')
          .then((response) => {
            this.list = response.data;
            console.log(this.list);
          })
          .catch(function(error) {
            console.log(error);
          });
          this.fetchEspecialidadeList();
          this.fetchClasseList();
      },
      clearForm: function(){
        this.heroi.nome = "";
        this.heroi.classe_id = "";
        this.heroi.classe=[];
        this.heroi.especialidades=[];
        this.heroi.vida="";
        this.heroi.defesa="";
        this.heroi.dano="";
        this.heroi.velocidade_ataque="";
        this.heroi.velocidade_movimento="";
      },
      createHeroi: function(){
        console.log('Criando um novo heroi');
        let self = this;
        let params = Object.assign({}, self.heroi);
        axios.post('api/herois', params)
          .then(function(response){
            this.clearForm();
            self.edit = false;
            self.fetchHeroiList();
          }).
          catch(function(error){
            console.log(error);
          });
      },
      showHeroi: function(id){
        let self = this;
        axios.get("api/herois/"+id)
          .then(function (response){
            self.heroi.id= response.data.id;
            self.heroi.nome= response.data.nome;
            self.heroi.classe_id= response.data.classe_id;
            self.heroi.classe = response.data.classe;
            self.heroi.especialidades= [];
            response.data.especialidades.forEach(function(item){
              self.heroi.especialidades.push(item.id);
            });
            self.heroi.vida = response.data.vida;
            self.heroi.defesa = response.data.defesa;
            self.heroi.dano = response.data.dano;
            self.heroi.velocidade_ataque = response.data.velocidade_ataque;
            self.heroi.velocidade_movimento = response.data.velocidade_movimento;
          });
        self.edit = true;

      },
      updateHeroi: function(id){
        let self = this;
        let params = Object.assign({}, self.heroi);
        axios.put('api/herois/'+id, params)
          .then(function(response){
            self.clearForm();
            self.edit = false;
            self.fetchHeroiList();
          })
          .catch(function(error){
            console.log(error);
          });
      },
      deleteHeroi: function(id){
        axios.delete('api/herois/'+id)
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
