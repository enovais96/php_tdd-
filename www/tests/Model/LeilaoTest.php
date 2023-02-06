<?php

namespace Alura\Leitao\Tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use PHPUnit\Framework\TestCase;

class LeilaoTest extends TestCase
{
    private $eduardo;
    private $maria;
    private $joao;
    private $ana;

    public function testNaoReceberLancesRepetidos(){
        $leilao = new Leilao('HB20');
        $this->criandoUsuarios();

        $leilao->recebeLance(new Lance($this->ana, 1000));
        $leilao->recebeLance(new Lance($this->ana, 1500));

        static::assertCount(1, $leilao->getLances());
        static::assertEquals(1000, $leilao->getLances()[0]->getValor());
    }

    /**
     * @dataProvider geraLances
     */
    public function testRecebeLances(int $qtdLances, Leilao $leilao, array $valores){
        static::assertCount($qtdLances, $leilao->getLances());

        foreach($valores as $i => $v){
            static::assertEquals($v, $leilao->getLances()[$i]->getValor());
        }
    }

    public function testMaximoLancesPorPessoa(){
        $leilao = new Leilao('HB20');
        $this->criandoUsuarios();

        $leilao->recebeLance(new Lance($this->eduardo, 1000));
        $leilao->recebeLance(new Lance($this->maria, 1500));
        $leilao->recebeLance(new Lance($this->eduardo, 2000));
        $leilao->recebeLance(new Lance($this->maria, 2500));
        $leilao->recebeLance(new Lance($this->eduardo, 3000));
        $leilao->recebeLance(new Lance($this->maria, 3500));
        $leilao->recebeLance(new Lance($this->eduardo, 4000));
        $leilao->recebeLance(new Lance($this->maria, 4500));
        $leilao->recebeLance(new Lance($this->eduardo, 5000));
        $leilao->recebeLance(new Lance($this->maria, 5500));

        $leilao->recebeLance(new Lance($this->eduardo, 6000));

        static::assertCount(10, $leilao->getLances());
        static::assertEquals(5500, $leilao->getLances()[array_key_last($leilao->getLances())]->getValor());
    }

    public function geraLances(){
        $leilaoCom3Lances = new Leilao('HB20');
        $this->criandoUsuarios();

        $leilaoCom3Lances->recebeLance(new Lance($this->eduardo, 1000));
        $leilaoCom3Lances->recebeLance(new Lance($this->maria, 2000));
        $leilaoCom3Lances->recebeLance(new Lance($this->joao, 3000));

        $leilaoCom1Lance = new Leilao('Cruze');
        $leilaoCom1Lance->recebeLance(new Lance($this->ana, 4000));

        return [
            '2-lances' => [3, $leilaoCom3Lances, [1000, 2000, 3000]],
            '1-lance' => [1, $leilaoCom1Lance, [4000]]
        ];
    }

    protected function criandoUsuarios(){
        $this->eduardo = new Usuario('Eduardo');
        $this->maria = new Usuario('Maria');
        $this->joao = new Usuario('João');
        $this->ana = new Usuario('Ana');
    }
}