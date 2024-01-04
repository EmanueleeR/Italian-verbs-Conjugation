<?php

class MiaClasse {
    public function __construct($parametro) {
        try {
            if ($parametro === null) {
                throw new Exception("Il parametro è obbligatorio.");
            }

            // Altri codici del costruttore...

        } catch (Exception $e) {
            //echo "Errore nel costruttore: " . $e->getMessage() . "<br>";
            throw $e;
        }
    }

    public function metodoChePotrebbeGenerareEccezione() {
        try {
            // Codice del metodo che potrebbe generare un'eccezione...
            echo "CIAOOOO DEL METODO<br>";
        } catch (Exception $e) {
            echo "Errore nel metodo: " . $e->getMessage();
            throw $e;
        }
    }
}

// Utilizzo della classe con il blocco try...catch all'esterno
//try {
    $istanza = new MiaClasse(null);
    //$istanza->metodoChePotrebbeGenerareEccezione();

    // Altri codici dopo la creazione dell'istanza...
    echo "Ciao";
/*} catch (Exception $e) {
    echo "Errore durante l'utilizzo della classe: " . $e->getMessage();
}*/

?>