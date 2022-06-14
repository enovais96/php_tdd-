<?php

use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Model\Lance;
use Alura\Leilao\Service\Avaliador;

require 'vendor/autoload.php';

//Preparação do teste
//Arrange or Given
$leilao = new Leilao('HB20 2015');

$maria = new Usuario('Maria');
$joao = new Usuario('João');

$leilao->recebeLance(new Lance($joao, 40000));
$leilao->recebeLance(new Lance($joao, 40500));

$leiloeiro = new Avaliador();

//Executa o código testado
//Act or When
$leiloeiro->avalia($leilao);

$maiorValor = $leiloeiro->getMaiorValor();

//Validação se a saída é a esperada
//Assert or Then
$valorEsperado = 40500;

if ($maiorValor == $valorEsperado){
    echo 'Teste Ok';
}else {
    echo 'Teste falhou';
}
