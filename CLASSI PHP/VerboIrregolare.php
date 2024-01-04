<?php
class VerboIrregolare extends Verbo {
    public function coniuga() : string {
        return "Verbo Irregolare, non ancora implementato";
    }

    public function getParola() : string {
        return "";
    }

    public function getRadice() : string {
        return "";
    }
    
    public function getDesinenza() : string {
        return "";
    }

    public function getLunghezzaRadice() : int {
        return 0;
    }

    public function getLunghezzaDesinenza() : int {
        return 0;
    }

}
?>