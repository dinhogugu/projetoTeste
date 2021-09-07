<div align="center">
  <img src="https://user-images.githubusercontent.com/67711103/132377998-dbeec8de-5af7-4c4f-9870-eb95da44ed33.png"/>
</div>

# Visão Geral

<div>
  Projeto criado com intuito de mostrar o CRUD realizado pela API JSON REST usando os métodos GET, POST, PUT, DELETE e a dockerização do mesmo.
</div>

# Tecnologias utilizadas
<h3>Back-end</h3>
<ul>
  <li>Laravel</li>
</ul>

<h3>Ambiente Virtualização</h3>
<ul>
  <li>Docker</li>
</ul>

<h3>Front-end</h3>
<ul>
  <li>Vue.js</li>
  <li>HTML</li>
  <li>CSS</li>
  <li>Bootstrap</li>
</ul>

<h3>Banco de Dados</h3>
<ul>
  <li>MySQL</li>
</ul>

# Iniciando projeto com Docker
<h3>Pré-requisitos</h3>
<div>1- Para iniciar o projeto com Docker, primeiro é necessário fazer a instalação do mesmo, segue o link: https://www.docker.com/products/docker-desktop</div>

<h3>Criando imagem front-end</h3>
<div> Para criar a imagem do vue.js acesse a pasta frontEnd/app que é onde esta o arquivo "Dockerfile" e execute o comando: <strong>"docker build -t vue-ui &nbsp ."</strong>
  <h4>Observação</h4>
</div>O comando acima irá criar uma imagem, a flag "-t" significa tag, indica que estamos dando um nome a imagem, vai ajudar a identificar a imagem mais facilmente esse nome é totalmente escolhido por você, no caso esta sendo usado o nome "vue-ui".
<div>O ponto no final, significa que o contexto para gerar imagem vai ser da pasta que esta executando o comando no momento, como a imagem sendo construída na pasta atual.</div>
<div> Para poder verificar a imagem criada, digite <strong>"docker image ls"</strong>
<div>O arquivo Dockerfile citado, é um arquivo Docker, necessário para criar a imagem, nele são passados comandos para serem executados no momento da criação da imagem.</div>
  
<h3>Criando imagem back-end</h3>
<div>Para criar imagem do laravel acesse a pasta backEnd/projeto que é onde esta o "Dockerfile" e execute o comando <strong>"docker build -t my-laravel-image &nbsp ."</strong></div>
  
<h3>Criado imagem banco de dados MySQL</h3>
<div>Para criar a imagem do banco de dados, acesse a pasta db que é onde esta o arquivo "Dockerfile" do banco, após isso execute o comando <strong>"docker build -t mysql &nbsp ."</strong></div>
  
<h3>Criando container</h3>
<div>Nesse próximo passo, iremos precisar do arquivo <strong>"docker-compose.yml"</strong> que está na raiz do projeto, nele são unidas todas as informações das imagens e o nome do container que vai ser utilizado para cada imagem e executando todas de uma só vez. Para maior entendimento, segue configurações desse arquivo abaixo:</div>
 
<img src="https://user-images.githubusercontent.com/67711103/132384761-4158dfff-e0c5-4bef-b253-2348be9c731d.png"/>

<div>1 - Primeiramente foi definido a versão do compose.</div>
<div>2 - em seguida foi colocado a informação services, pois é onde vão estar as informações dos serviços que irá ser executado nesse container.</div>
<div>3 - Foi definido os serviços como db, frontend, backend esses nomes são totalmente de sua escolha, serve pra se orientar dentro do arquivo, neles são definidos as configurações, abaixo as explicações das configurações:</div>
  </br>
  <ul>
    <li>image: o nome da imagem que foi criada.</li>
    <li>container_name: nome do container de sua escolha.</li>
    <li>environment: configuracoes, ex: configurações do banco de dados.</li>
    <li>volumes: serve pra guardar as informações, quando um container é removido suas informações são perdidas, o volume serve para persistir as informações, ex: persistir as informações de um banco de dados.</li>
    <li>restart: esta sendo utilizado "always" caso aconteça algum problema, o docker sempre irá dar um "restart" no serviço.</li>
    <li>tty: entrada e saida de dados, terminal, está definido como true.</li>
    <li>ports: porta que o serviço irá utilizar.</li>
    <li>depends_on: é uma dependência expressa entre os serviços.</li>
  </ul>
<div>4- execute o container com o comando: <strong>"docker-compose up -d"</strong>(a flag -d indica executar em background, deixando o terminal livre pra executar novos comandos).</div>
<div>As as aplicações já estão rondando nas portas especificadas, por último será necessário criar o banco de dados e a tabela, para isso, acesse a pasta "db" la dentro tem um arquivo chamado "script.sql" nele está os comandos para criação do banco e tabela, abra o terminal e execute o comando:<strong>"docker exec -i mysql-container mysql -uroot -pprojeto_gazin <span>< db/script.sql</span>" </strong>(o comando "exec" significa que ira ser executado comandos dentro de um container que está rodando, a flag "-i" significa que estamos executando um comando no modo interativo, no caso permite que o processo leia todo script.sql e que o mesmo não vai ser finalizado até que seja concluido).</div>
</br>
</br>
  
# Aplicação
  <h3>GET</h3>
  <div> A aplicação foi montada em uma tela com dois inputs um sendo o campo do registro e a outra o registro que ira ser passado, a ideia é mandar uma requisição via GET para o back-end (<strong>http://127.0.0.1:8000/api/developer</strong>) para o mesmo devolver todos os registros que tem no banco de dados, no caso se o usuário colocar "todos" ele irá buscar todos os registros do banco de dados como na imagem abaixo:
</br>
    <img src="https://user-images.githubusercontent.com/67711103/131956124-4eb17bbe-aca1-4267-aeb6-d95fa5a7e451.png"/>
</br>
<div>Estrutura codigo para melhor entendimento:</div>
</br>
<div>No arquivo do vue em src/main.js tem uma variavel global chamada $url = "https://127.0.0.1:8000/api"(url para enviar dados para o backend) na imagem abaixo podemos verificar a estrutura:</div>
</br>
<img src="https://user-images.githubusercontent.com/67711103/132397061-bced1b6c-2026-4ed2-8a49-e9cbce3a6683.png"/>
<div> Essa variavel é chamada no metodo em src/pages/Desenvolvedor:</div>

   <h3>GET</h3>
  <div> A segunda demonstração do GET é passar o termo via querystring ou seja, passar os parametros que desejamos via URL para que o banco de dados nos retorne se houver os dados, o exemplo abaixo, foi passado via URL da seguinte maneira :  <strong>(http://127.0.0.1:8000/api/developer/queryParam/Nome=Amy)</strong> e me retornou:</div>
 <img src="https://user-images.githubusercontent.com/67711103/131956956-e1a55384-c580-47d3-93a6-e6237583ec65.png"/>
    
<h3>GET</h3>
<div> Outro exemplo de GET é passando o ID desejado para URL com isso, se sucesso, devolver o resultado daquele ID <strong>(http://127.0.0.1:8000/api/developer/idParam/3)</strong></div>
<img src="https://user-images.githubusercontent.com/67711103/131957969-f43e43aa-31c4-4ea4-9f10-f61d710e4c76.png"/>
  
<h3>POST</h3>
<div> Nesse exemplo, o método post foi usado para cadastrar um novo registro, no caso Desenvolvedor, para isso, foi criado uma tela de cadastro de Desenvolvedores onde irá ser inputado os dados e o mesmo enviara um json com os dados para o back-end, para isso, basta clicar no botão de "+" no canto inferior direito! Todos os campos estão como obrigatório. Segue imagem tela de cadastro.</div>
<img src="https://user-images.githubusercontent.com/67711103/131959366-d8da727a-b75e-4925-baed-282977e06dc5.png"/>
  
<h3>PUT</h3>
<div> O método PUT foi utilizado para atualizar os dados dos registros, ao clicar no icone : <img src="https://user-images.githubusercontent.com/67711103/131959614-e7ef06b0-0ccd-4ceb-b1a8-39d703fc1c73.png"/> o usuário será enviado para tela de alteração dos dados, onde os dados do registro selecionado já irão vir preenchidos bastando somente fazer a alteração e salvar.Segue imagem abaixo:</div>
 <img src="https://user-images.githubusercontent.com/67711103/131959861-77c9bf44-2811-437b-8fe1-3d55e0df50f5.png"/>
  
  <h3>DELETE</h3>
  <div> O método DELETE como o próprio nome diz, permite deletar o registro selecionado, é enviado o ID do registro via URL <strong>(http://127.0.0.1:8000/developer/deletarDesenvolvedor/3)</strong> e se encontrado no banco, o registro é excluido basta clicar no icone <img src="https://user-images.githubusercontent.com/67711103/131996156-86440b72-4e35-46f1-aaf4-37b7a3538dc1.png"/></div>

  <h4>OBS: Todas os processos explicados acima estão validados e trás notificações em caso de sucesso ou erro.</h4>
  

 


