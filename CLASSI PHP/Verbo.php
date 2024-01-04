<?php
    abstract class Verbo {
        abstract public function coniuga() : string;
        abstract public function getParola() : string;
        abstract public function getRadice() : string;
        abstract public function getDesinenza() : string;
        abstract public function getLunghezzaRadice() : int;
        abstract public function getLunghezzaDesinenza() : int;
    }
?>