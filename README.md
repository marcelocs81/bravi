# Plugin MCS Bravi para Wordpress
------------------------

## Sobre o Plugin
Este plugin consiste em um sistema de consulta de filme usando a API Rest da OMDB.
Ele usa como base o Wordpress Framework 4.9.8 e MySql Database 5.7.

## Características
- Tela incial possui link para login ou registrar novo usuário
- Pesquisa de Filmes pelo titulo
- Possivel marcar um filme como favorito
- Possivel configurar dados de acesso a API OMDB (API URL and API KEY)

## Como instalar
Para isso você precisa:
- Fazer um clone do repositório git
	- git clone https://github.com/marcelocs81/bravi.git
- Executar com Docker
	- docker-compose up -d
- Executar com servidor PHP
	- composer install (se utilizar este será necessario ter uma banco de dados MySql em execução)
	- acessar o diretorio wp via linha de comando e executar php -S localhost:8000
- Executar a instancia do Wordpress e executar sua instalação seguindo os passos informado em tela
- Compacte o diretorio mcs-bravi no format .zip e importe no Wordpress
- Crie as páginas:
    - Home com a tag: [mcs-home]
	- Favoritos com a tag: [force-login][mcs-favorites]
- Você também pode criar as páginas opcionais:
	- Pesquisa de filmes com a tag: [force-login][mcs-movie]
	- Tela de inico com a tag: [mcs-banner]

## Acesso
Para poder acessar o Wordpress deve ser criada pelo menos uma conta.
- Sugestão:
	### ADMIN
    - Email: admin@admin.com
    - Password: admin