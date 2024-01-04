<?php
class Modo {
    private String $nomeModo; // indicativo, congiuntivo ecc.
    private String $tipoModo; // finito, indefinito

    public function __construct(string $nome, string $tipo) {
        $this->nomeModo = $nome;
        $this->tipoModo = $tipo;
    }

    public function getNomeModo(){
        return $this->nomeModo;
    }
    
    public function getTipoModo(){
        return $this->tipoModo;
    }
}
?>