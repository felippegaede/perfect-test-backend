# Instruções de uso:

Primeiramente ao clonar o projeto, instale as dependências via composer, executando o comando na raiz projeto:

```
composer install
```

Crie a base de dados no banco Mysql, conforme os prâmetros abaixo, ou informe os dados de acesso no arquivo `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Execute as migrações do projeto:

```
php artisan migrate
```

E em seguida já execute seu built-in server:

```
php artisan serve
```

