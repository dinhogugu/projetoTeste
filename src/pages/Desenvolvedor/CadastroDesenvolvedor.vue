<template>
   <principal>
      <div>
         <div>
            <h2 class="text-light mt-2">Cadastro de Usuário</h2>
            <!-- <h5>Arraste o arquivo para o campo</h5> -->
            <hr class="text-light"/>
         </div>
      </div>
      <div align-h="center" class="text-light">
         <div>
            <form>
               <div class="d-flex justify-content-start">
                  <div class="col-xs-3">
                     <label for="inline-form-custom-select-pref">Nome Completo:</label>
                     <input
                        class="form-control"
                        v-model="usuarioForm"
                        placeholder="Digite o nome aqui"    
                        />
                  </div>
                  <div class="ml-3">
                     <label for="inline-form-custom-select-pref"
                        >Departamento:</label
                        >
                     <b-form-select
                        v-model="selectedDepartamento"
                        :options="optionsDepartamento"
                        :disabled="statusEncarregadoForm === 'S'? true : false"
                        ></b-form-select>
                  </div>
                  <div class="ml-3">
                     <label for="inline-form-custom-select-pref"
                        >Email:</label
                        >
                     <input
                        class="form-control"
                        v-model="emailForm"
                        type="email"
                        placeholder="Digite o email aqui"
                        />
                  </div>
                  <div class="ml-3 mt-3">
                     <br/>
                     <b-form-checkbox
                        v-model="statusEmailForm"
                        name="checkbox-1"
                        value="S"
                        unchecked-value="N"
                        >
                        Deseja receber avisos por email?
                     </b-form-checkbox>
                  </div>
               </div>
               <div class="d-flex justify-content-start mt-4">
                  <div>
                     <label class="mr-sm-2" for="inline-form-custom-select-pref"
                        >Senha:</label
                        >
                     <input
                        class="form-control"
                        v-model="senha1Form"
                        type="password"
                        placeholder="Digite o senha aqui"
                        :required="acaoForm"
                        />
                  </div>
                  <div class="ml-3">
                     <label class="mr-sm-2" for="inline-form-custom-select-pref"
                        >Senha novamente:</label
                        >
                     <input
                        class="form-control"
                        v-model="senha2Form"
                        type="password"
                        placeholder="Digite o senha novamente aqui"
                        :required="acaoForm"
                        />
                  </div>
               </div>
               <b-form-checkbox
                  v-model="statusEncarregadoForm"
                  class="mt-4"
                  name="checkbox-1"
                  value="S"
                  unchecked-value="N"
                  @change="checkSupervisor(statusEncarregadoForm)"
                  >
                  Você é Supervisor?
                  <div class="interrogacao" style="">
                     ?
                     <div
                        >Esse usuário é um Supervisor de Manutenção que será atribuído nos atendimentos como responsável pela manutenção do veículo.</div>
                  </div>
               </b-form-checkbox>
               <div>
                  <div class="mt-3">
                     <input
                        class="form-control w-25 p-2 mb-4"
                        v-if="statusEncarregadoForm == 'S'"
                        v-model="encarregado"
                        type="text"
                        placeholder="Digite o apelido do encarregado"
                        :required="acaoForm"
                        />
                  </div>
               </div>
               <button type="button" class="btnNovo botaoAzul mt-4" @click="direcionaForm()">
               Enviar</button
                  >
            </form>
         </div>
      </div>
   </principal>
</template>
<script>
   import Principal from "@/templates/Principal";
   export default {
     name: "CadastroDesenvolvedor",
     components: {
       Principal,
     },
     data() {
       return {
         selectedDepartamento: "Operador",
         optionsDepartamento: [],
         usuarioForm: "",
         usuarioLogado: "",
         usuarioEditado: [],
         emailForm: "",
         senha1Form: "",
         senha2Form: "",
         statusEmailForm: "N",
         statusEncarregadoForm: 'N',
         acaoForm: true,
         encarregado: ''
       };
       
     },
     computed: {},
     created() {
       //this.usuarioLogado = this.$store.getters.getUsuario;
       this.usuarioLogado = JSON.parse(atob(sessionStorage.getItem("usuario")));
       if (this.$route.params.id > 0) {
         this.buscarUsuario();
         this.acaoForm = false;
       }
       this.selectDepartamento();
     },
     methods: {
       buscarUsuario() {
         this.$http
           .post(this.$url, {
             buscarUsuarios: {
               autenticacao: {
                 email: this.usuarioLogado.email,
                 senha: this.usuarioLogado.senha,
               },
               dadosUsuarios: {
                 filtro: "Id",
                 valorFiltro: this.$route.params.id,
               },
             },
           })
           .then((response) => {
             if (response.data.status) {
               let usuarioTemp = response.data.result[0];
               this.selectedDepartamento = usuarioTemp.Departamento;
               this.usuarioForm = usuarioTemp.Usuario;
               this.emailForm = usuarioTemp.Email;
               this.statusEmailForm = usuarioTemp.EnviarEmail;
               if(usuarioTemp.Encarregado){
                 this.statusEncarregadoForm = "S";
                 this.encarregado = usuarioTemp.Encarregado;
                 this.checkSupervisor("S");
               }
             } else {
               console.log(response.data);
             }
           })
           .catch((e) => {
             //console.log(response);
             console.log("nao te conexão para login  " + e);
             this.show = false;
           });
       },
       cadastrarUsuario() {
         if(!this.usuarioForm || !this.senha1Form || !this.senha2Form || !this.emailForm){
           this.$bvToast.toast("Preencha todos os campos", {
              title: "Erro no cadastro",
              variant: "danger",
              solid: true,
          });
           return;
         }
         this.$http
           .post(this.$url, {
             cadastrarUsuario: {
               autenticacao: {
                 email: this.usuarioLogado.email,
                 senha: this.usuarioLogado.senha,
               },
               dadosUsuarios: {
                 usuario: this.usuarioForm,
                 email: this.emailForm,
                 departamento: this.selectedDepartamento,
                 senha: this.senha1Form,
                 enviarEmail: this.statusEmailForm,
                 encarregado: this.encarregado
               },
             },
           })
           .then((response) => {
             if (response.data.status) {
               this.$store.commit('setAviso',"Cadastro com sucesso");
               this.$router.push("/usuario");
             } else {
               this.$bvToast.toast("Não foi possível atualizar o cadastro", {
              title: "Erro no cadastro",
              variant: "danger",
              solid: true,
          });
               console.log(response.data);
             }
           })
           .catch((e) => {
             this.$bvToast.toast("Não foi possível atualizar o cadastro", {
              title: "Erro no cadastro",
              variant: "danger",
              solid: true,
          });
             console.log(e);
           });
       },
       alterarUsuario() {
         if(!this.usuarioForm || !this.emailForm){
           this.$bvToast.toast("Preencha todos os campos", {
              title: "Erro na alteração",
              variant: "danger",
              solid: true,
          });
           return;
         }
        if(this.senha1Form != this.senha2Form){
            this.$bvToast.toast("Campo Senha e Confirmar senha não correspondem", {
              title: "Erro na alteração",
              variant: "danger",
              solid: true,
          });
          return;
        }
         

         this.$http
           .post(this.$url, {
             alterarUsuario: {
               autenticacao: {
                 email: this.usuarioLogado.email,
                 senha: this.usuarioLogado.senha,
               },
               dadosUsuarios: {
                 idUsuario: this.$route.params.id,
                 usuario: this.usuarioForm,
                 email: this.emailForm,
                 departamento: this.selectedDepartamento,
                 senha: this.senha1Form,
                 enviarEmail: this.statusEmailForm,
                 encarregado: this.encarregado
               },
             },
           })
           .then((response) => {
             if (response.data.status) {
               if(this.$route.params.id == this.usuarioLogado.id){
                 this.$bvToast.toast("Por favor, faça o login novamente!", {
                  title: "Alteração com sucesso",
                  variant: "success",
                  solid: true,
                });
                 setTimeout(() => {
                  sessionStorage.clear();
                  this.$router.push("/");
                 },2000);
               }else{
                 this.$store.commit('setAviso',"Alteração realizada com sucesso");
                 this.$router.push("/usuario");
               }
             } else {
                this.$bvToast.toast(response.data.result, {
                title: "Erro na alteração",
                variant: "danger",
                solid: true,
              });
               console.log(response.data);
             }
           })
           .catch((e) => {
             alert("Nao foi possível atualizar o cadastro");
             console.log(e);
           });
       },
       direcionaForm() {
         if (this.$route.params.id > 0) {
           this.alterarUsuario();
         }else{
           this.cadastrarUsuario();
         }    
        },
       selectDepartamento(){
         if(this.usuarioLogado.departamento == "Gerente"){
           this.optionsDepartamento = [
             { value: "Operador", text: "Operador" },
             { value: "Visualizador", text: "Visualizador" },
             { value: "Gerente", text: "Gerente" }
           ]
         }else{
           this.optionsDepartamento = [
             { value: "Operador", text: "Operador" },
             { value: "Visualizador", text: "Visualizador" }
           ]
         }
       },
       checkSupervisor(paramCheck){
         if(paramCheck === "S"){
           this.selectedDepartamento = "Visualizador";
         }else{
           this.encarregado = "";
           this.selectDepartamento();
         }
       }
     },
     
   };
</script>
<style scoped>
</style>