<template>
   <principal>
      <div>
         <div>
            <h2 class="text-light mt-5">{{tituloPagina}}</h2>
            <!-- <h5>Arraste o arquivo para o campo</h5> -->
            <hr class="text-light"/>
         </div>
      </div>
      <div align-h="center" class="text-light">
         <div>
            <form>
               <div class="row">
                  <div class="col-12 col-sm-12 col-md-8 col-lg-5 ml-2 mt-2 mr-2">
                     <label for="inline-form-custom-select-pref">Nome Completo:</label>
                     <input
                        class="form-control mt-1"
                        v-model="nome"
                        placeholder="Digite o nome aqui"  
                        maxlength = "100"  
                        />
                  </div>
                  <div class="col-12 col-sm-12 col-md-8 col-lg-5 ml-2 mt-2 mr-2">
                     <label for="inline-form-custom-select-pref"
                        >Idade:</label
                        >
                     <input
                        class="form-control mt-1"
                        v-model="idade"
                        placeholder="Digite sua idade aqui" 
                        maxlength="3" 
                        type="number"
                        />
                  </div>
                  <div class="col-12 col-sm-12 col-md-8 col-lg-5 ml-2 mt-2 mr-3">
                     <label 
                        >Sexo:</label
                        >
                     <input
                        class="form-control mt-1"
                        v-model="sexo"
                        type="text"
                        placeholder="Digite o seu sexo aqui"
                        maxlength="20"
                        />
                  </div>
                  <div class="col-12 col-sm-12 col-md-8 col-lg-5 mt-2 mr-5">
                     <label class="mr-sm-2" for="inline-form-custom-select-pref">Data de Nascimento:</label>
                     <input
                        class="form-control mt-1"
                        v-model="dataNascimento"
                        v-mask="'##-##-####'"
                        type="text"
                        placeholder="Digite sua data de nascimento aqui"
                        />
                  </div>
                  </div>
                  <div class="row">
                    <div class="col-12 col-sm-12 col-md-8 col-lg-5 mt-4 ml-2 mb-5">
                     <label class="mr-sm-2" for="inline-form-custom-select-pref"
                        >Digite seus Hobbies:</label
                        >
                     <input
                        class="form-control mt-1"
                        v-model="hobby"
                        type="text"
                        placeholder="Digite seus hobbies"
                        maxlength="100"
                        />
                  </div>
                </div>
               <div class="d-flex justify-content-end mr-5">
                  <button type="button" class="btnNovo botaoAzul mt-5" @click="direcionaForm()">
                  Enviar</button>
                </div>
            </form>
         </div>
      </div>
   </principal>
</template>
<script>
   import Principal from "@/templates/Principal";
   export default {
     name: "ConfigDesenvolvedor",
     components: {
       Principal,
     },
     data() {
       return {
         nome:"",
         idade:"",
         sexo:"",
         dataNascimento:"",
         hobby:"",
         tituloPagina:'Cadastrar Desenvolvedor'
       };
       
     },
     computed: {},
     created() {
       if (this.$route.params.id > 0) {
         this.tituloPagina = 'Alterar cadastro Desenvolvedor'
         this.buscarDesenvolvedor();
       }
     },
     methods: {
       buscarDesenvolvedor() {
         this.$http
           .post(this.$url+'/developer/buscarDesenvolvedor', {
                 filtro: "id",
                 valorFiltro: this.$route.params.id,
           })
           .then((response) => {
             if (response.data.status) {
               let desenvolvedorTemp = response.data.result[0];
               this.nome = desenvolvedorTemp.nome;
               this.sexo = desenvolvedorTemp.sexo;
               this.idade = desenvolvedorTemp.idade;
               this.hobby = desenvolvedorTemp.hobby;
               this.dataNascimento = desenvolvedorTemp.data_nascimento;
             } else {
               console.log(response.data);
             }
           })
           .catch((e) => {
             //console.log(response);
             console.log("nao tem conexão para login  " + e);
           });
       },
       cadastrarDesenvolvedor() {
         if(!this.nome || !this.idade || !this.sexo || !this.dataNascimento || !this.hobby){
           this.$bvToast.toast('Por favor preencha todos os campos.', {
                  title: "ERRO",
                  variant: "danger",
                  solid: true,
                });
           return;
         }
         this.$http
           .post(this.$url+'/developer/cadastrarDesenvolvedor', {
                 nome: this.nome,
                 idade: this.idade,
                 sexo: this.sexo,
                 dataNascimento: this.dataNascimento,
                 hobby: this.hobby,
           })
           .then((response) => {
             if (response.data.status) {
               this.$bvToast.toast(response.data.mensagem, {
                  title: "200",
                  variant: "success",
                  solid: true,
                });
                 setTimeout(() => {
                  sessionStorage.clear();
                  this.$router.push("/");
                 },1000);
               return;
             } else {
               this.$bvToast.toast("Não foi possível atualizar o cadastro", {
              title: "ERRO",
              variant: "danger",
              solid: true,
          });
               console.log(response.data);
             }
           })
           .catch((e) => {
             this.$bvToast.toast(' ' + e, {
              title: "404",
              variant: "danger",
              solid: true,
          });
             console.log(e);
           });
       },
       alterarDesenvolvedor() {
         if(!this.nome || !this.idade || !this.sexo || !this.dataNascimento || !this.hobby){
           this.$bvToast.toast('Por favor preencha todos os campos.', {
                  title: "ERRO",
                  variant: "danger",
                  solid: true,
                });
           return;
         }
         this.$http
           .put(this.$url+'/developer/alterarDesenvolvedor', { 
              id: this.$route.params.id,
              nome: this.nome,
              sexo: this.sexo,
              idade: this.idade,
              hobby: this.hobby,
              dataNascimento: this.dataNascimento,
           })
           .then((response) => {
             if (response.data.status) {
                 this.$bvToast.toast(response.data.mensagem, {
                  title: "200",
                  variant: "success",
                  solid: true,
                });
                 setTimeout(() => {
                  sessionStorage.clear();
                  this.$router.push("/");
                 },1000);
             } else {
                this.$bvToast.toast(response.data.mensagem, {
                title: "ERRO",
                variant: "danger",
                solid: true,
              });
               console.log(response.data);
             }
           })
           .catch((e) => {
             this.$bvToast.toast(' ' + e, {
                title: "404",
                variant: "danger",
                solid: true,
              });
             console.log(e);
           });
       },
       direcionaForm() {
         if (this.$route.params.id > 0) {
           this.alterarDesenvolvedor();
         }else{
           this.cadastrarDesenvolvedor();
         }    
        },
     },
   };
</script>
<style scoped>
</style>