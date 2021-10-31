<?php 

// Rotas das páginas
$this->get('/', 'PagesController@home');
$this->get('/sobre', 'PagesController@sobre');

// Rotas das páginas produtos
$this->get('/produtos', 'ProdutoController@index');
$this->get('/cadastro-produto', 'ProdutoController@cadastrar');
$this->post('/insert-produto', 'ProdutoController@insert');
$this->get('/editar-produto', 'ProdutoController@editar');
$this->post('/update-produto', 'ProdutoController@update');
$this->post('/delete-produto', 'ProdutoController@delete');