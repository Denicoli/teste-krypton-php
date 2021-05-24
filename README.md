# Teste Técnico - Krypton Tech

## API Laravel desenvolvida para executar duas tarefas diferentes de acordo com o método da requisição, que seriam: listagem, insersão e exclusão de dados de uma API e a listagem ordenada e paginada de dados presentes em um arquivo JSON.

### Features

- [x] Listagem, incremento e exclusão de dados da API da Krypton por meio do método GET
- [x] Listagem ordenada e paginada de dados fornecidos via arquivo JSON

## Instalando a API

### API

A API foi desenvolvida utilizando a framework [Laravel](https://laravel.com/) na versão 7.0.

* Para baixar o projeto siga as instruções abaixo:

```
1. git clone https://gitlab.com/Denicoli/teste-krypton-php.git
2. cd teste-krypton-php

```
* A API necessita que o [Composer](https://getcomposer.org/) esteja instalado na máquina.

Execute o comando abaixo para configurar o arquivo `.env`.

```
composer definir-env

```

* Observação:

As atividades que serão listadas encontram-se no local /storage/app/public/json.

## Iniciando a API

* Basta executar o comando:

```
php artisan serve

```

Pronto! A aplicação já está rodando e já podem ser feitas as requisições.

## Requisições

### POST

Utilizando um aplicativo para realizar requisições, como o Insomnia, basta acessar a URL fornecida ao se executar o comando na etapa anterior seguido de '/api/atividades/'. (Exemplo: http://127.0.0.1:8000/api/atividades/).

O arquivo JSON enviado para a requisição não é obrigatório, mas é necessário caso o desenvolvedor opte por mudar de página. É também um arquivo simples, contendo um atributo chamado 'pagina' com o valor referente a página que será consultada (Ex.: 2).

![](/screenshots/post.png?raw=true "Atividades - Rota Post")

### GET

Pelo navegador, basta acessar a URL fornecida pelo comando 'php artisan serve'. A interface lista os dados existentes resgatados da API, e também permite a exclusão e a insersão de novos dados.

![](/screenshots/get.png?raw=true "Carros e Motores - Rota Get")

## Autor

|  [Tiago Denicoli](https://github.com/Denicoli/)   |