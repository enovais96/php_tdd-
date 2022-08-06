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

    public function testMenorValorCrescente(){

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

        $menorValor = $leiloeiro->getMenorValor();

        //Validação se a saída é a esperada
        //Assert or Then
        self::assertEquals(2200,$menorValor);

    }
    
    public function testMenorValorDecrescente(){

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

        $menorValor = $leiloeiro->getMenorValor();

        //Validação se a saída é a esperada
        //Assert or Then
        self::assertEquals(2200,$menorValor);

    }

    public function testTresMaioresValores(){
        $leilao = new Leilao('HB20');

        $eduardo = new Usuario('Eduardo');
        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        $ana = new Usuario('ana');

        $leilao->recebeLance(new Lance($maria, 1500));
        $leilao->recebeLance(new Lance($joao, 1200));
        $leilao->recebeLance(new Lance($ana, 1800));
        $leilao->recebeLance(new Lance($eduardo, 2000));

        $avaliador = new Avaliador();
        $avaliador->avalia($leilao);

        $maiores = $avaliador->getMaioresLances();

        static::assertCount(3, $maiores);
        static::assertEquals(2000, $maiores[0]->getValor());
        static::assertEquals(1800, $maiores[1]->getValor());
        static::assertEquals(1500, $maiores[2]->getValor());
    }
}
