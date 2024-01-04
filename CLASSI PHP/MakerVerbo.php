<?php
    abstract class MakerVerbo {
        private static $arrayVerbiIrregolari = ["andare","accendere","incendere","raccendere","riaccendere"
        ,"accludere","concludere","escludere","includere"];

        public static function createVerbo(string $infinito) {
            // Determina il tipo di verbo (regolare o irregolare) e restituisci un'istanza appropriata
            if (self::isVerboIrregolare($infinito)) {
                return new VerboIrregolare($infinito);
            } else {
                return new VerboRegolare($infinito);
            }
        }
    
        private static function isVerboIrregolare(string $infinito) : bool {
            // Implementa la logica per determinare se il verbo è irregolare
            if(self::ricercaLineare($infinito) != -1)
                return true;
            return false;
        }

        private static function ricercaLineare(string $value) : int {
            for($i = 0; $i < count(self::$arrayVerbiIrregolari); ++$i)
                if(self::$arrayVerbiIrregolari[$i] == $value)
                    return $i;
            return -1;
        }
    }
?>