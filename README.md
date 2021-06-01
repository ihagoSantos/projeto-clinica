## Projeto

### Modelo Entidade Relacionamento
https://drive.google.com/file/d/1hf49M7t5_me_trVD5Vptudx5gFaJImiZ/view?usp=sharing

### Executar Projeto

Após realizar o download do projeto, configure o arquivo .env com os dados necessários para conexão com o banco de dados Mysql.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=projeto-clinica
DB_USERNAME=username
DB_PASSWORD=password
```

Execute o comando ``` php artisan migrate --seed ``` para criar as tabelas do banco de dados e preencher com dados necessários para execução do exemplo.

Execute o comando ``` php artisan serve ``` para startar o servidor local.

Abra a url ``` http://127.0.0.1:8000 ``` para acessar a página do exemplo.
