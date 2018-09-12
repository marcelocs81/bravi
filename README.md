# Plugin MCS Bravi para Wordpress
------------------------

## Sobre o Plugin
Este plugin consiste em um sistema de consulta de filme usando a API Rest da OMDB.
Ele usa como base o Wordpress Framework 4.9.8 e MySql Database 5.7.

## Caracter�sticas
- Tela incial possui link para login ou registrar novo usu�rio
- Pesquisa de Filmes pelo titulo
- Possivel marcar um filme como favorito
- Possivel configurar dados de acesso a API OMDB (API URL and API KEY)

## Como instalar
Para isso voc� precisa:
- Fazer um clone do reposit�rio git
	- git clone https://github.com/marcelocs81/bravi.git
- Executar com Docker
	- docker-compose up -d
- Executar com servidor PHP
	- composer install (se utilizar este ser� necessario ter uma banco de dados MySql em execu��o)
	- acessar o diretorio wp via linha de comando e executar php -S localhost:8000
- Executar a instancia do Wordpress e executar sua instala��o seguindo os passos informado em tela
- Compacte o diretorio mcs-bravi no format .zip e importe no Wordpress
- Crie as p�ginas:
    - Home com a tag: [mcs-home]
	- Favoritos com a tag: [force-login][mcs-favorites]
- Voc� tamb�m pode criar as p�ginas opcionais:
	- Pesquisa de filmes com a tag: [force-login][mcs-movie]
	- Tela de inico com a tag: [mcs-banner]

## Acesso
Para poder acessar o Wordpress deve ser criada pelo menos uma conta.
- Sugest�o:
	### ADMIN
    - Email: admin@admin.com
    - Password: admin