<?php

namespace Alura\Leitao\Tests\Service;

use PHPUnit\Framework\TestCase;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Model\Lance;
use Alura\Leilao\Service\Avaliador;



class AvaliadorTest extends TestCase
{
    private $leiloeiro;

    protected function setUp() : void {
        $this->leiloeiro = new Avaliador();
    }
    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testMaiorValor(Leilao $leilao){

        $this->leiloeiro->avalia($leilao);

        $maiorValor = $this->leiloeiro->getMaiorValor();

        self::assertEquals(2000,$maiorValor);
    }
    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testMenorValor(Leilao $leilao){

        $this->leiloeiro->avalia($leilao);

        $menorValor = $this->leiloeiro->getMenorValor();

        self::assertEquals(1200,$menorValor);

    }
    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testTresMaioresValores(Leilao $leilao){

        $this->leiloeiro->avalia($leilao);

        $maiores = $this->leiloeiro->getMaioresLances();

        static::assertCount(3, $maiores);
        static::assertEquals(2000, $maiores[0]->getValor());
        static::assertEquals(1800, $maiores[1]->getValor());
        static::assertEquals(1500, $maiores[2]->getValor());
    }

    public function leilaoEmOrdemCrescente(){
        $leilao = new Leilao('HB20');

        $eduardo = new Usuario('Eduardo');
        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        $ana = new Usuario('Ana');

        $leilao->recebeLance(new Lance($joao, 1200));
        $leilao->recebeLance(new Lance($maria, 1500));
        $leilao->recebeLance(new Lance($ana, 1800));
        $leilao->recebeLance(new Lance($eduardo, 2000));

        return [[$leilao]];
    }

    public function leilaoEmOrdemDecrescente(){
        $leilao = new Leilao('HB20');

        $eduardo = new Usuario('Eduardo');
        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        $ana = new Usuario('Ana');

        $leilao->recebeLance(new Lance($eduardo, 2000));
        $leilao->recebeLance(new Lance($ana, 1800));
        $leilao->recebeLance(new Lance($maria, 1500));
        $leilao->recebeLance(new Lance($joao, 1200));

        return [[$leilao]];
    }

    public function leilaoEmOrdemAleatoria(){
        $leilao = new Leilao('HB20');

        $eduardo = new Usuario('Eduardo');
        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        $ana = new Usuario('Ana');

        $leilao->recebeLance(new Lance($maria, 1500));
        $leilao->recebeLance(new Lance($eduardo, 2000));
        $leilao->recebeLance(new Lance($joao, 1200));
        $leilao->recebeLance(new Lance($ana, 1800));

        return [[$leilao]];
    }
}
