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

    /**
     * @dataProvider geraLances
     */
    public function testRecebeLances(int $qtdLances, Leilao $leilao, array $valores){
        static::assertCount($qtdLances, $leilao->getLances());

        foreach($valores as $i => $v){
            static::assertEquals($v, $leilao->getLances()[$i]->getValor());
        }
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