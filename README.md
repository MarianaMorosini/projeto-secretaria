# Projeto Secretaria

## 🚀 Tecnologias utilizadas

- HTML5
- CSS
- Tailwind
- PHP
- MySQL

## Antes de começar você precisa ter instalado:
- Git: https://git-scm.com/downloads
- MySql: https://www.mysql.com/downloads/
- Um editor de texto de sua preferência (ex: VS Code)


## Instalando o PHP e o servidor

- Utilizei a ferramenta Herd na opção free, com o PHP-8.3 e o NGINX como servidor: https://herd.laravel.com/windows
- Basta instalar a ferramenta e iniciar os serviços.

## Fazendo o clone do projeto

Com o terminal aberto, execute os comandos abaixo para inicializar o repositório local e clonar o projeto:
```bash
git clone https://github.com/MarianaMorosini/projeto-secretaria.git
```
## Configurando o banco de dados

- Com o projeto baixado em sua máquina, abra 'secretaria-fiap' no editor de texto
- No arquivo config.php, atualize a senha do banco de dados de acordo com sua configuração local.
- No arquivo dump.sql, estão as instruções de criação de banco, das tabelas e alguns dados de exemplo. Execute esse script no seu banco de dados MySQL, você pode utilizar o MySQL Workbench para isto ou outra ferramenta.

## Iniciando o servidor

Com o terminal aberto dentro da pasta 'secretaria-fiap' utilize o seguinte comando para iniciar o servidor:
```bash
php -S localhost:8888
```
Acesse a url: http://localhost:8888/ 
