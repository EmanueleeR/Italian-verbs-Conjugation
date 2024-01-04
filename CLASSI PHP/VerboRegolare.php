<?php
include_once "PrimaConiugazione.php";
include_once "SecondaConiugazione.php";
include_once "TerzaConiugazione.php";

class VerboRegolare extends Verbo {
    private string $parola;
    private string $radice;
    private string $desinenza;
    private int $lunghezzaRadice;// = strlen($stringa) - 3;
    private int $lunghezzaDesinenza;

    private Coniugazione $coniugazione; //prima, seconda, terza, propria
    private string $tipo_coniugazione; //prima, seconda, terza, propria
    private string $forma; //attiva, passiva, riflessiva, pronominale
    private string $genere; //transitivo, intransitivo
    private string $ausiliare; //essere, avere

    public function __construct(string $verbo) {
        $desiTreLettere = substr($verbo, -3);
        $desiQuattroLettere = substr($verbo, -4);
        if($desiTreLettere == "are" || $desiTreLettere == "ere" || $desiTreLettere == "ire"){
            //CLASSICA CONIUGAZIONE
            //echo "Classica Coniugazione<br>";
            if($desiTreLettere == "are"){
                //echo "Prima Coniugazione<br>";
                $this->coniugazione = new PrimaConiugazione($this);
                $lunghezza_radice_parola = strlen($verbo) - 3;
                $this->radice = substr($verbo, 0, $lunghezza_radice_parola);
                $this->desinenza = $desiTreLettere;
                $this->lunghezzaDesinenza = strlen($desiTreLettere);
                $this->lunghezzaRadice = strlen($verbo) - $this->lunghezzaDesinenza;
                $this->tipo_coniugazione = "Prima";
            }else if($desiTreLettere == "ere"){
                //echo "Seconda Coniugazione<br>";
                $this->coniugazione = new SecondaConiugazione($this);
                $lunghezza_radice_parola = strlen($verbo) - 3;
                $this->radice = substr($verbo, 0, $lunghezza_radice_parola);
                $this->desinenza = $desiTreLettere;
                $this->lunghezzaDesinenza = strlen($desiTreLettere);
                $this->lunghezzaRadice = strlen($verbo) - $this->lunghezzaDesinenza;
                $this->tipo_coniugazione = "Seconda";
            }else{
                //echo "Terza Coniugazione<br>";
                $this->coniugazione = new TerzaConiugazione($this);
                $lunghezza_radice_parola = strlen($verbo) - 3;
                $this->radice = substr($verbo, 0, $lunghezza_radice_parola);
                $this->desinenza = $desiTreLettere;
                $this->lunghezzaDesinenza = strlen($desiTreLettere);
                $this->lunghezzaRadice = strlen($verbo) - $this->lunghezzaDesinenza;
                $this->tipo_coniugazione = "Terza";
            }
        } else if($verbo == "ire"){
            //VERBO IRE
            //echo "Verbo Ire Terza Coniugazione<br>";
            $this->coniugazione = new PrimaConiugazione($this);
            $this->radice = "-";
            $this->desinenza = "ire";
            $this->lunghezzaDesinenza = strlen($this->desinenza);
            $this->lunghezzaRadice = strlen($verbo) - $this->lunghezzaDesinenza;
            $this->tipo_coniugazione = "Terza";
        } else if($desiQuattroLettere == "arre" || $desiQuattroLettere == "orre" || $desiQuattroLettere == "urre"){
            //SECONDA CONIUGAZIONE
            //echo "Seconda Coniugazione Con 4 Lettere<br>";
            $this->coniugazione = new SecondaConiugazione($this);
            $lunghezza_radice_parola = strlen($verbo) - 4;
            $this->radice = substr($verbo, 0, $lunghezza_radice_parola);
            $this->desinenza = $desiQuattroLettere;
            $this->lunghezzaDesinenza = strlen($desiQuattroLettere);
            $this->lunghezzaRadice = strlen($verbo) - $this->lunghezzaDesinenza;
            $this->tipo_coniugazione = "Seconda";
        } else {
            throw new InvalidArgumentException("Verbo non appartenente a nessuna coniugazione esistente");
        }

        $this->parola = $verbo;
    }

    public function coniuga(): string {
        
        // return $this->coniugazione->coniugazioneVerbo();
        return $this->coniugazione->coniugazioneVerboHTML();
    }

    public function getParola() : string {
        return $this->parola;
    }

    public function getRadice() : string {
        return $this->radice;
    }

    public function getDesinenza() : string {
        return $this->desinenza;
    }

    public function getLunghezzaRadice() : int {
        return $this->lunghezzaRadice;
    }
    
    public function getLunghezzaDesinenza() : int {
        return $this->lunghezzaDesinenza;
    }
}

?> 