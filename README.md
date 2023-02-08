# Projeto TDD com PHP
O intuito deste projeto foi aplicar TDD e aprofundar em testes unitários utilizando PHP unit, curso realizado pela Alura.

# Programas necessários
	- Docker
	- Docker compose
	- Composer

# Passo a passo para rodar
	1 - Dentro da pasta www rodar o comando "composer install"
	2 - Na raiz do projeto rodar "docker-compose build"
	3 - Na raiz do projeto rodar "docker-compose up -d"
	
# Validação
Ao final dos passos acima o projeto é para estar funcional, para validar você pode dar um "docker ps" e validar se o container "projeto-teste-unitario" esta em execução.

# Rodando os testes
Para testar os testes basta rodar o comando: docker exec -it projeto-teste-unitario vendor/bin/phpunit