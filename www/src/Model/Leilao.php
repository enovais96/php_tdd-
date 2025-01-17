<?php

namespace Alura\Leilao\Model;

class Leilao {
    /** @var Lance[] */
    private $lances;
    /** @var string */
    private $descricao;
    /** @var bool */
    private $finalizado;

    public function __construct(string $descricao){
        $this->descricao = $descricao;
        $this->lances = [];
        $this->finalizado = false;
    }

    public function recebeLance(Lance $lance){
        if (!empty($this->lances) && $this->lanceDoUltimoUsuario($lance)){
            throw new \DomainException('Usuário não pode dar dois lances seguidos.');
        }

        $totalLancesUsuario = $this->quantidadeLancesPorUsuario($lance->getUsuario());

        if($totalLancesUsuario >= 5){
            throw new \DomainException('Usuário não pode dar mais de cinco lances por leilão.');
        }

        $this->lances[] = $lance;
    }

    /**
     * @return Lance[]
     */
    public function getLances(): array {
        return $this->lances;
    }

    /**
     * @param Lance $lance
     * @return bool
     */
    public function lanceDoUltimoUsuario(Lance $lance): bool {
        $ultimoUsuario = $this->lances[count($this->lances) - 1];
        return $lance->getUsuario() == $ultimoUsuario->getUsuario();
    }

    public function finaliza(){
        $this->finalizado = true;
    }

    /**
     * @return bool
     */
    public function estaFinalizado() : bool {
        return $this->finalizado;
    } 

    /**
     * @param Usuario $usuario
     * @return int
     */
    private function quantidadeLancesPorUsuario(Usuario $usuario): int {
        $totalLancesUsuario = array_reduce($this->lances, 
            function (int $totalAcumulado, Lance $lanceAtual) use ($usuario) {
                if ($lanceAtual->getUsuario() == $usuario){
                    return $totalAcumulado+1;
                }

                return $totalAcumulado;
            }, 0);

        return $totalLancesUsuario;
    }
}
