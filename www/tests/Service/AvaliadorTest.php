<?php

namespace Alura\Leitao\Tests\Service;

use PHPUnit\Framework\TestCase;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Model\Lance;
use Alura\Leilao\Service\Avaliador;



class AvaliadorTest extends TestCase
{

    public function testMaiorValorCrescente(){

        //Preparação do teste
        //Arrange or Given
        $leilao = new Leilao('HB20 2015');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');

        $leilao->recebeLance(new Lance($joao, 2200));
        $leilao->recebeLance(new Lance($joao, 2500));

        $leiloeiro = new Avaliador();

        //Executa o código testado
        //Act or When
        $leiloeiro->avalia($leilao);

        $maiorValor = $leiloeiro->getMaiorValor();

        //Validação se a saída é a esperada
        //Assert or Then
        self::assertEquals(2500,$maiorValor);

    }

    public function testMaiorValorDecrescente(){

        //Preparação do teste
        //Arrange or Given
        $leilao = new Leilao('HB20 2015');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');

        $leilao->recebeLance(new Lance($joao, 2500));
        $leilao->recebeLance(new Lance($joao, 2200));

        $leiloeiro = new Avaliador();

        //Executa o código testado
        //Act or When
        $leiloeiro->avalia($leilao);

        $maiorValor = $leiloeiro->getMaiorValor();

        //Validação se a saída é a esperada
        //Assert or Then
        self::assertEquals(2500,$maiorValor);

    }

}