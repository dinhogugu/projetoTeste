<template>
   <principal>
      <div class="">
         <div>
            <h2 class="text-light mt-5">Desenvolvedores</h2>
            <hr class="text-light"/>
         </div>
      </div>
      <form class = "inputFiltro" @submit="direcionaForm()">
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
               Buscar</button>
            </div>
         </div>
      </form>
      <div class="">
         <b-table
            table-variant="light"
            id="table1"
            striped
            hover
            :per-page="perPage"
            :current-page="currentPage"
            :items="items"
            :fields="fields"
            responsive="sm"
            >
            <template v-slot:cell(id)="data">
               <button class="btnNovo botaoAzul">
                  <router-link :to="'/ConfigDesenvolvedor/' + data.value">
                     <i class="fa fa-pencil text-light m-1" aria-hidden="true"></i>
                  </router-link>
               </button>
               <button
                  class="btnNovo botaoAmarelo"
                  v-on:click="deletarDesenvolvedor(data)"
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
         :to="'/ConfigDesenvolvedor/' + developerTemp"
         class="flutuar corpo"
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
           { value: "id", text: "Id" },
           { value: "nome", text: "Nome" },
           { value: "sexo", text: "Sexo" },
           { value: "idade", text: "Idade" },
           { value: "data_nascimento", text: "Data de Nascimento"},
           { value: "hobby", text: "Hobby" }
         ],
         valorFilter: "",
         items: [],
         fields: [
           { key: "nome", label: "Nome" },
           { key: "sexo", label: "Sexo" },
           { key: "idade", label: "Idade" },
           { key: "data_nascimento", label: "Data de Nascimento" },
           { key: "hobby", label: "Hobby" },
           { key: "id", label: "" }
           
         ],
         perPage: 5,
         currentPage: 1,
         totalRows: 0,
         sortBy: "index",
         sortDesc: false,
         developerTemp: 0
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
      //  this.cargaTotal();
     },
     methods: {
       cargaTotal() {
         this.$http
           .get(this.$url + '/developer')
           .then((response) => {
             if (response.data.status) {
                this.$bvToast.toast(response.data.mensagem, {
                title: "200",
                variant: "success",
                solid: true,
              });
                this.items = response.data.result;
                this.totalRows = this.items.length;
             }else{
               this.$bvToast.toast(response.data.mensagem, {
                title: "ERRO",
                variant: "danger",
                solid: true,
              });
             }
           })
           .catch((e) => {
             this.$bvToast.toast(' ' + e, {
                title: "404",
                 variant: "danger",
                 solid: true,
              });
             //console.log(response);
             console.log("nao tem conexão para login  " + e);
           });
       },
        cargaVariaveisQueryString() {
         this.$http
           .get(this.$url +"/developer/queryParam/"+this.selectedFilter+'='+this.valorFilter)
           .then((response) => {
             if (response.data.status) {
                this.$bvToast.toast(response.data.mensagem, {
                  title: "200",
                  variant: "success",
                  solid: true,
              });
                this.items = response.data.result;
                this.totalRows = this.items.length;
             } else {
               console.log(response.data);
               this.$bvToast.toast(response.data.mensagem, {
                  title: "ERRO",
                  variant: "danger",
                  solid: true,
              });
             }
           })
           .catch((e) => {
              this.$bvToast.toast(' '+ e, {
                  title: "404",
                  variant: "danger",
                  solid: true,
              });
              console.log(response);
           });
       },
       cargaId() {
         this.$http
           .get(this.$url +"/developer/idParam/"+this.valorFilter)
           .then((response) => {
             if (response.data.status) {
                this.$bvToast.toast(response.data.mensagem, {
                  title: "200",
                  variant: "success",
                  solid: true,
              });
                this.items = response.data.result;
                this.totalRows = this.items.length;
             } else {
               this.$bvToast.toast(response.data.mensagem, {
                  title: "ERRO",
                  variant: "danger",
                  solid: true,
              });
             }
           })
           .catch((e) => {
              this.$bvToast.toast(' ' + e, {
                  title: "404",
                  variant: "danger",
                  solid: true,
              });
              console.log(response);
           });
       },
       direcionaForm(){
         if(this.selectedFilter == 'todos'){
            this.cargaTotal();
         }
         if(this.selectedFilter != 'todos' && this.selectedFilter != 'id'){
            this.cargaVariaveisQueryString();
         }
         if(this.selectedFilter == 'id'){
           this.cargaId();
         }
       },
       deletarDesenvolvedor(param) {
         let deletar = confirm("Tem certeza que deseja deletar o Desenvolvedor??");
         if (deletar == false) {
           return;
         }
         this.$http
           .delete(this.$url + '/developer/deletarDesenvolvedor/'+param.value)
           .then((response) => {
             if (response.data.status) {
               this.items.splice(param.index, 1);
               this.totalRows = this.items.length;
               this.$bvToast.toast(response.data.mensagem, {
                 title: "204",
                 variant: "success",
                 solid: true,
               });
               //alert(response.data.result);
             } else {
                this.$bvToast.toast('Erro ao excluir', {
                  title: "ERRO",
                  variant: "danger",
                  solid: true,
               });;
             }
           })
           .catch((e) => {
             console.log(e);
             this.$bvToast.toast(' ' + e, {
                  title: "404",
                  variant: "danger",
                  solid: true,
               });;
           });
       },
     },
   };
</script>
<style scoped>


</style>