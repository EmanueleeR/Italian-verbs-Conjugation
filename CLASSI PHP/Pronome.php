<?php
class Pronome {
    private string $parolaPronome; // Io, Tu, Egli, Noi, Voi, Essi
    private string $persona; // Prima , Seconda, Terza
    private string $numero; // Singolare, Plurare

    public function __construct(string $parolaPronome, string $persona, string $numero) {
        $this->parolaPronome = $parolaPronome;
        $this->persona = $persona;
        $this->numero = $numero;
    }
    
    //public function setParolaPronome(string $parolaPronome) : void {}
    public function getParolaPronome() : string {
        return $this->parolaPronome;
    }
    //public function setPersona(string $persona) : void {}
    public function getPersona() : string {
        return $this->persona;
    }
    //public function setNumero(string $numero) : void {}
    public function getNumero() : string {
        return $this->numero;
    }
}
?>