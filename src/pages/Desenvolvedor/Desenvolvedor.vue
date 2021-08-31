<template>
   <principal>
      <div>
         <div class="mt-5">
            <h2 class="text-light mt-2">Desenvolvedores</h2>
            <!-- <h5>Arraste o arquivo para o campo</h5> -->
            <hr class="text-light"/>
         </div>
      </div>
      <form class = "inputFiltro" @submit="cargaInicial">
         <div class="d-flex justify-content-end mb-4">
            <b-form-select
               class="mr-2 w-25"
               v-model="selectedFilter"
               :options="optionsFilter"
               ></b-form-select>
            <input type="text" class="form-control mr-3 w-25" id="valor" 
               autocomplete="off"
               v-model="valorFilter" 
               placeholder="Digite o filtro aqui"
               :disabled="disableFilter"
               required  
               aria-label="Server"/>
            <div>
               <button class="btnNovo botaoAzul">
               Filtrar</button>
            </div>
         </div>
      </form>
      <div class="overflow-auto">
         <b-table
            table-variant="dark"
            id="table1"
            striped
            hover
            :per-page="perPage"
            :current-page="currentPage"
            :items="items"
            :fields="fields"
            responsive="sm"
            >
            <template v-slot:cell(Id)="data">
               <button v-if="usuarioLogado.departamento == 'Visualizador' ? false : true" class="btnNovo botaoAzul">
                  <router-link :to="'/cadastro_usuario/' + data.value">
                     <i class="fa fa-pencil text-light m-1" aria-hidden="true"></i>
                  </router-link>
               </button>
               <button
                  class="btnNovo botaoAmarelo"
                  v-on:click="deletarUsuario(data)"
                  :hidden="usuarioLogado.departamento == 'Gerente' ? false : true"
                  >
               <i class="fa fa-trash-o text-light m-1" aria-hidden="true"></i>
               </button>
            </template>
         </b-table>
         <b-pagination
            v-model="currentPage"
            :total-rows="totalRows"
            :per-page="perPage"
            aria-controls="table1"
            hide-ellipsis
            ></b-pagination>
      </div>
      <router-link
         :to="'/CadastroDesenvolvedor/' + usuarioTemp"
         class="flutuar corpo botaoVermelho"
         :hidden="usuarioLogado.departamento == 'Visualizador' ? true : false"
         >
         <b-icon icon="plus" font-scale="3" class="my-float"></b-icon>
      </router-link>
   </principal>
</template>
<script>
   import Principal from "@/templates/Principal";
   export default {
     name: "Desenvolvedor",
     components: {
       Principal,
     },
     data() {
       return {
         selectedFilter: "todos",
         optionsFilter: [
           { value: "todos", text: "Todos" },
           { value: "nome", text: "Nome" },
           { value: "sexo", text: "Sexo" },
           { value: "idade", text: "Idade" },
           { value: "dataNascimento", text: "Data de Nascimento" },
           { value: "hobby", text: "Hobby" }
         ],
         valorFilter: "",
         items: [],
         fields: [
           { key: "nome", label: "Nome" },
           { key: "Email", label: "Email" },
           { key: "sexo", label: "Sexo" },
           { key: "idade", label: "Idade" },
           { key: "dataNascimento", label: "Data de Nascimento" },
           { key: "hobby", label: "Hobby" },
           { key: "Id", label: "" },
         ],
         perPage: 10,
         currentPage: 1,
         totalRows: 0,
         sortBy: "index",
         sortDesc: false,
         usuarioTemp: 0,
         usuarioLogado: "",
       };
     },
     computed: {
       disableFilter() {
         let valor = this.selectedFilter;
         if (valor === "todos") {
           this.valorFilter = "";
           return true;
         } else {
           return false;
         }
       },
     },
     created() {
       this.cargaInicial();
       if (this.$store.getters.getAviso) {
         this.$bvToast.toast(this.$store.getters.getAviso, {
           title: "",
           variant: "success",
           solid: true,
         });
         this.$store.commit('setAviso',"");
       }
     },
     methods: {
       cargaInicial() {
         this.$http
           .post(this.$url, {
             buscarUsuarios: {
               autenticacao: {
                 email: this.usuarioLogado.email,
                 senha: this.usuarioLogado.senha,
               },
               dadosUsuarios: {
                 filtro: this.selectedFilter,
                 valorFiltro: this.valorFilter,
               },
             },
           })
           .then((response) => {
             if (response.data.status) {
               this.items = response.data.result;
               this.totalRows = this.items.length;
             } else {
               console.log(response.data);
             }
           })
           .catch((e) => {
             //console.log(response);
             console.log("nao te conexão para login  " + e);
           });
       },
       deletarUsuario(param) {
         let r = confirm("Tem certeza que deseja deletar o usuario?");
         if (r == false) {
           return;
         }
         this.$http
           .post(this.$url, {
             deletarUsuario: {
               autenticacao: {
                 email: this.usuarioLogado.email,
                 senha: this.usuarioLogado.senha,
               },
               dadosUsuarios: {
                 idUsuario: param.value,
               },
             },
           })
           .then((response) => {
             if (response.data.status) {
               this.items.splice(param.index, 1);
               this.totalRows = this.items.length;
               this.$bvToast.toast(response.data.result, {
                 title: "",
                 variant: "danger",
                 solid: true,
               });
               //alert(response.data.result);
             } else {
               alert(response.data.result);
             }
           })
           .catch((e) => {
             console.log("nao te conexão para login  " + e);
           });
       },
     },
   };
</script>
<style scoped>

/* ---------BOTAO CADASTRAR DESENVOLVEDOR----------- */
   .corpo {
  font-family: Verdana, Geneva, sans-serif;
  font-size: 18px;
  background-color: #ccc;
  }
  .flutuar {
  position: fixed;
  width: 60px;
  height: 60px;
  bottom: 20px;
  right: 40px;
  background-color: red;
  color: #fff;
  border-radius: 50px;
  text-align: center;
  box-shadow: 2px 2px 3px #999;
  }
  .my-float {
  margin-top: 5px;
  }
</style>