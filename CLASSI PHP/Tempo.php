<?php
class Tempo {
    private string $nomeTempo;
    private string $tipoTempo; //Semplice

    public function __construct(string $nome, string $tipo) {
        $this->nomeTempo = $nome;
        $this->tipoTempo = $tipo;
    }
    
    public function getNomeTempo() : string {
        return $this->nomeTempo;
    }

    public function getTipoTempo() : string {
        return $this->tipoTempo;
    }
}
?>