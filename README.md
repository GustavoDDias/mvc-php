
# 💻 Projeto
* Mini-framework construído em PHP com a arquitetura MVC para a execução das 4 operações: Cadastrar, Editar, Ler e Excluir. 

* Front-end: Bootstrap 5.

* Twig template engine.

# 🚀 Como Executar

#### Iniciando o projeto
``` 
cd mvc-php
composer install 
```

#### Criar base de dados no phpmyadmin
``` 
create database `mvc-php`
```

Importar na base de dados mvc-php o arquivo "mvc-php.sql" que se encontra na pasta database.

#### Pasta database
``` 
cd mvc-php/docs/database
```

#### Configurar arquivo de conexão
``` 
cd mvc-php/app/config/config.php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'mvc-php');
```

#### Tudo pronto! :checkered_flag:
