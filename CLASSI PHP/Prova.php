<?php
class ClasseEsterna {
    // Classe interna protetta
class ClasseInternaProtetta {
    protected function metodoProtettoInterno() {
        echo "Chiamato da un metodo protetto interno.\n";
    }
}

// Classe interna privata
class ClasseInternaPrivata {
    private function metodoPrivatoInterno() {
        echo "Chiamato da un metodo privato interno.\n";
    }
}

    public function metodoEsterno() {
        echo "Chiamato da un metodo esterno.\n";

        // Creazione di un'istanza della classe interna
        $classeInterna = new ClasseInterna();
        $classeInterna->metodoInterno(); // Accessibile perché la classe interna è dichiarata nella stessa classe
    }

    public function chiamataMetodoInterno() {
        // Accessibile perché la classe interna è dichiarata nella stessa classe
        $classeInterna = new ClasseInterna();
        $classeInterna->metodoInterno();
    }

    // Classe interna pubblica
    public function chiamataMetodoPubblicoInterno() {
        // Accessibile perché la classe interna è dichiarata nella stessa classe
        $classeInterna = new ClasseInterna();
        $classeInterna->metodoInterno();
    }

    private function chiamataMetodoPrivatoInterno() {
        // Questo funzionerà perché la classe esterna può accedere a membri privati della classe interna
        $classeInterna = new ClasseInternaPrivata();
        $classeInterna->metodoPrivatoInterno();
    }

    public function chiamataMetodoProtettoInterno() {
        // Questo funzionerà perché la classe esterna può accedere a membri protetti della classe interna
        $classeInterna = new ClasseInternaProtetta();
        $classeInterna->metodoProtettoInterno();
    }

    private function chiamataMetodoPrivatoEsterno() {
        // Questo funzionerà perché il metodo privato è definito nella stessa classe
        $this->metodoPrivatoEsterno();
    }

    private function metodoPrivatoEsterno() {
        echo "Chiamato da un metodo privato esterno.\n";
    }
}

// Classe interna pubblica
class ClasseInterna {
    public function metodoInterno() {
        echo "Chiamato da un metodo interno.\n";
    }
}

// Creazione di un'istanza della classe esterna
$istanza = new ClasseEsterna();

// Chiamate ai metodi
$istanza->metodoEsterno();
$istanza->chiamataMetodoInterno();
$istanza->chiamataMetodoPubblicoInterno();
$istanza->chiamataMetodoPrivatoInterno();
$istanza->chiamataMetodoProtettoInterno();
$istanza->chiamataMetodoPrivatoEsterno();

?>