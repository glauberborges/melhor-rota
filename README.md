![Capa](capa.png)

<p align="center">
  
  <a href="https://github.com/glauberborges/ApiMovie/issues" style="text-decoration: none">
    <img alt="Issues" src="https://img.shields.io/github/issues/glauberborges/ApiMovie?color=34CB79" />
  </a>
  <a href="#" style="text-decoration: none">
    <img alt="GitHub top language" src="https://img.shields.io/github/languages/top/glauberborges/melhor-rota?color=34CB79" />
  </a>
</p>

<p align="center">
  <a href="#" target="_blank">
    <img alt="by Glauber Borges" src="https://img.shields.io/badge/%20by-Glauber_Borges-informational?color=34CB79">
  </a>
  <a href="https://github.com/glauberborges" target="_blank" >
    <img alt="Github - Glauber Borges" src="https://img.shields.io/badge/Github--%23F8952D?style=social&logo=github">
  </a>
  <a href="https://github.com/glauberborges" target="_blank" >
    <img alt="Linkedin - Glauber Borges" src="https://img.shields.io/badge/Linkedin--%23F8952D?style=social&logo=linkedin">
  </a>
  <a href="mailto:glauber.borges1@gmail.com" target="_blank" >
    <img alt="Email - Glauber Borges" src="https://img.shields.io/badge/Email--%23F8952D?style=social&logo=gmail">
  </a>
  <a href="https://api.whatsapp.com/send?phone=15996121224" target="_blank" >
    <img alt="Fale comigo no whatsapp - Glauber Borges" src="https://img.shields.io/badge/Whatsapp--%23F8952D?style=social&logo=whatsapp">
  </a>
</p>



[ 💻 Projeto](#-projeto) |
[ 🗂 Banco de Dados](#-banco-de-dados) |
[ 🚀 Tecnologias](#-tecnologias) |
[ 🛠 Ferramentas](#-ferramentas) |
[ ⚙ Instalação](#%EF%B8%8F-instalacao) |
[ 📝 Como usar](#-como-usar) 

## 💻 Projeto

Aplicação desenvolvida com Laravel + BootStrap 4, consumindo a API da Google para busca da melhor rota para entrega, a partir do envio de um arquivo CSV com as rodas e um ponto de partida.
Apenas para teste não tem nenhuma aplicação comercial.

## 🗂 Banco de Dados

Existe apenas uma tabela ``customers`` você pode encontrar o DUMP dela aqui [customers.sql](customers.sql) ou Laravel Migrations [Database: Migrations](https://laravel.com/docs/7.x/migrations).

## 🚀 Tecnologias
Para esse projeto foi usado as seguintes tecnologias:

- [Laravel](https://laravel.com)
- [Mysql](https://github.com/laravel/passport)
- [Google Maps](https://cloud.google.com/maps-platform)
- [Jquery](https://jquery.com/)
- [BootStrap 4](https://getbootstrap.com.br/)

## 🛠 Ferramentas
- [PhpStorm](https://www.jetbrains.com/pt-br/phpstorm/)
- [Sequel Pro](http://sequelpro.com/)

## ⚙️ Instalacao

##### Clone o repositório
```bash
  $ git clone https://github.com/glauberborges/melhor-rota.git
```

#### Instale as dependências
```bash
  $ composer install
```


#### Configurando o .env
```bash
  Renomeie/Copia o .env.example para .env e configure o banco de dados
  
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE={DATABASE}
  DB_USERNAME={USER}
  DB_PASSWORD={SENHA}
  
```
```bash
Insira sua chave de API da Google
  
KEY_GEOCODING={KEY}
```  
Não sabe como conseguir a sua Key? veja esse link [get api key](https://developers.google.com/maps/documentation/geocoding/get-api-key)

#### Gerar a key
```bash
  $ php artisan key:generate 
```

#### Migration (Opcional)
```bash
  $ php artisan migrate
```

#### Servidor (Opcional)
> Se usa um servidor de sua preferência pule essa etapa
Você pode usar seu servidor preferido ou então usar o [Laradock](https://laradock.io/)

##### Laradock (Opcional)
Para usar o Laradock você precisa ter o Docker em sua máquina [Docker](https://www.docker.com/)
entre na pasta do Laradock
```bash
  $ cd laradock
```
```bash
  Renomeie/Copia o .env.example para .env e configure o banco de dados e o Nginx do laradock 
  
  DB_DATABASE={DATABASE}
  DB_USERNAME={USER}
  DB_PASSWORD={SENHA}
  
```
```bash
  $ docker-compose up -d nginx mysql
```
#### Front-end
Instale as dependências
```bash
  $ npm install
```

Quer fazer alguma mudança no Front? use o [Laravel Mix](https://laravel.com/docs/7.x/mix)
```bash
  $ npm run watch-poll
```

## 📝 Como usar

Pasta fazer a istalação e envia o CSV com as rotas, ao abrir a aplicação você poderá baixar o arquivo modelo para testar.


> Achou algum erro? Envie um pull request =D 

> Fique à vontade para baixar e contribuir =D

---
