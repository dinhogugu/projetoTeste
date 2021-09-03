<div align="center">
  <img src="https://user-images.githubusercontent.com/67711103/131952420-72220054-5b71-413d-9080-16c073eb5490.png"/>
</div>

# Visão Geral

<div>
  Projeto criado com intuito de mostrar o CRUD realizado pela API JSON REST usando os métodos GET,POST,PUT,DELETE
</div>

# Tecnologias utilizadas
<h3>Back-end</h3>
<ul>
  <li>Laravel</li>
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

# Iniciando Vue.js

<h3>Pré-requisitos</h3>
<div>1- Para iniciar o projeto em Vue, é necessário instalar o npm https://nodejs.org/en/download/ que é o gerenciador de pacotes do JavaScript.</div>

<h3>Instalar o Vue.js</h3>
<div>1-Abra uma linha de comando (ou seja, prompt de comando do Windows ou PowerShell).</div>

<div>2-Crie uma pasta de projeto, ex: mkdir ProjetoVue, e insira este diretório: cd ProjetoVue.</div>

<div>3-Instale o Vue.js usando o npm: "npm install vue" </div>


# Iniciando Laravel

<h3>Pré-requisitos</h3>
<div>1- Para iniciar o projeto em Laravel, é necessário instalar o composer, segue o link: https://www.hostinger.com.br/tutoriais/como-instalar-e-usar-o-composer</div>

<div>2 -Também, é necessário possuir o PHP configurado em seu computador.</div>
  
<h3>Instalando o Laravel</h3>
<div>1-Após ter o Composer instalado, iremos executar o seguinte comando: "composer global require laravel/installer"</div>

<div>2-Para criar um projeto em laravel digite: laravel new "nome-do-projeto".</div>

<div>3-Para iniciar o projeto: "php artisan serve" </div>

<hr>
  
# Aplicação
  <h3>GET</h3>
  <div> A aplicação foi montada em uma tela com dois inputs um sendo o campo do registro e a outra o registro que ira ser passado, a ideia é mandar uma requisição via GET para o back-end (<strong>http://127.0.0.1:8000/api/developers</strong>) para o mesmo devolver todos os registros que tem no banco de dados, no caso o parametro passado chama-se "todos" como na imagem abaixo:
    
    <img src="https://user-images.githubusercontent.com/67711103/131956124-4eb17bbe-aca1-4267-aeb6-d95fa5a7e451.png"/>
    <h3>
   <h3>GET>
  <div> A segunda demonstração do GET é passar o termo via querystring ou seja, passar os parametros que desejamos via URL para que o banco de dados nos retorne se houver os dados, o exemplo abaixo, foi passado via URL da seguinte maneira :  <strong>http://127.0.0.1:8000/api/Nome=Hudson</strong>
 <img src="https://user-images.githubusercontent.com/67711103/131956956-e1a55384-c580-47d3-93a6-e6237583ec65.png"/>
    


