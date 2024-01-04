<?php
include_once "Verbo.php";
include_once "VerboAvere.php";
include_once "VerboEssere.php";
include_once "Pronome.php";
include_once "Modo.php";
include_once "Tempo.php";
include_once "Coniugazione.php";

class SecondaConiugazione implements Coniugazione {
    //COSTANTE NON HA BISOGNO DI PRIVATE E DEL DOLLARO
    //SI ACCEDE TRAMITE self::costante
    //E NON TRAMITE this->costante
    //private const numero_pronomi = 6;
    private const numero_pronomi = 6;

    private $desinenza_indicativo_presente = ["o","i","e","iamo","ete","ono"];
    private $desinenza_indicativo_imperfetto = ["evo","evi","eva","evamo","evate","evano"];
    private $desinenza_indicativo_passato_remoto = ["ei/etti","esti","e/ette","emmo","este","erono/ettero"];
    private $desinenza_indicativo_futuro_semplice = ["erò","erai","erà","eremo","erete","eranno"];
    private $desinenza_congiuntivo_presente = ["a","a","a","iamo","iate","ano"];
    private $desinenza_congiuntivo_imperfetto = ["essi","essi","esse","essimo","este","essero"];
    private $desinenza_condizionale_presente = ["erei","eresti","erebbe","eremmo","ereste","erebbero"];
    private $desinenza_imperativo_presente = ["","i","a","iamo","ete","ano"];
    private $desinenza_participio_presente = "ente";
    private $desinenza_participio_passato = "uto";
    private $desinenza_gerundio_presente = "endo";

    private Verbo $verbo;
    private Modo $modo;
    private Tempo $tempo;
    private array $oggetto_pronomi_personali;
    private VerboAvere $ausiliareAvere;
    private VerboEssere $ausiliareEssere;

    private function unisciElementi($elemento1, $elemento2) {
        return $elemento1 . '/' . $elemento2;
    }

    private function prima_lettera($parola){
        return $parola[0];
    }

    private function inizializzaArrayOggettoPronomi(){
        $array_pronomi_personali = ["io","tu","egli","noi","voi","essi"];
        $array_persona_pronomi_personali = ["Prima","Seconda","Terza"];
        
        for ($i=0; $i < count($array_pronomi_personali); $i++) {
            $j = $i+1;

            if($j<4)
                $singolo_pronome = new Pronome($array_pronomi_personali[$i], $array_persona_pronomi_personali[$j-1], "Singolare");
            else
                $singolo_pronome = new Pronome($array_pronomi_personali[$i], $array_persona_pronomi_personali[$i-3], "Plurale");

            $this->oggetto_pronomi_personali[$i] = $singolo_pronome;
        }
    }


    public function __construct(Verbo $verbo) {
        $this->verbo = $verbo;
        $this->inizializzaArrayOggettoPronomi();
        $this->ausiliareAvere = new VerboAvere();
        $this->ausiliareEssere = new VerboEssere();
    }

    public function coniugazioneVerbo() : string { //OGGETTO VERBO COME PARAMETRO
        $coniugaz = "";
        // $coniugaz = $coniugaz . $this->coniugazione_modo_indicativo();
        // $coniugaz = $coniugaz . $this->coniugazione_modo_congiuntivo();
        // $coniugaz = $coniugaz . $this->coniugazione_modo_condizionale();
        // $coniugaz = $coniugaz . $this->coniugazione_modo_imperativo();
        return $coniugaz;
    }
    
    public function coniugazioneVerboHTML() : string { //OGGETTO VERBO COME PARAMETRO
        $coniugaz = "";
        $coniugaz = $coniugaz . $this->coniugazione_modo_indicativoHTML();
        $coniugaz = $coniugaz . $this->coniugazione_modo_congiuntivoHTML();
        $coniugaz = $coniugaz . $this->coniugazione_modo_condizionaleHTML();
        $coniugaz = $coniugaz . $this->coniugazione_modo_imperativoHTML();
        $coniugaz = $coniugaz . $this->coniugazione_modo_infinitoHTML();
        $coniugaz = $coniugaz . $this->coniugazione_modo_participioHTML();
        $coniugaz = $coniugaz . $this->coniugazione_modo_gerundioHTML();
        return $coniugaz;
    }

    private function coniugazione_modo_indicativoHTML() : string {
        $this->modo = new Modo("INDICATIVO","FINITO");

        $coniugaz = '
        <div class="modo">
            <span class="nome-modo"><h2>' . $this->modo->getNomeModo() . '</h2></span>
            <div class="single-row">';
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_indicativo_presente();
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_indicativo_passato_prossimo();
        $coniugaz .= '</div>';

            $coniugaz .= '<div class="single-row">';
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_indicativo_imperfetto();
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_indicativo_trapassato_prossimo();
            $coniugaz .= '</div>';

            $coniugaz .= '<div class="single-row">';
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_indicativo_passato_remoto();
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_indicativo_trapassato_remoto();
            $coniugaz .= '</div>';

            $coniugaz .= '<div class="single-row">';
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_indicativo_futuro_semplice();
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_indicativo_futuro_anteriore();
            $coniugaz .= '</div>';
        $coniugaz .= '</div>';

        return $coniugaz;
    }

    private function coniugazione_modo_congiuntivoHTML() : string {
        $this->modo = new Modo("CONGIUNTIVO","FINITO");

        $coniugaz = '
        <div class="modo">
            <span class="nome-modo"><h2>' . $this->modo->getNomeModo() . '</h2></span>
            <div class="single-row">';
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_congiuntivo_presente();
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_congiuntivo_passato();
            $coniugaz .= '</div>';

            $coniugaz .= '<div class="single-row">';
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_congiuntivo_imperfetto();
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_congiuntivo_trapassato();
            $coniugaz .= '</div>';
        $coniugaz .= '</div>';

        return $coniugaz;
    }

    private function coniugazione_modo_condizionaleHTML() : string {
        $this->modo = new Modo("CONDIDIONALE","FINITO");

        $coniugaz = '
        <div class="modo">
            <span class="nome-modo"><h2>' . $this->modo->getNomeModo() . '</h2></span>
            <div class="single-row">';
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_condizionale_presente();
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_condizionale_passato();
            $coniugaz .= '</div>';
        $coniugaz .= '</div>';

        return $coniugaz;
    }

    private function coniugazione_modo_imperativoHTML() : string {
        $this->modo = new Modo("IMPERATIVO","FINITO");

        $coniugaz = '
        <div class="modo">
            <span class="nome-modo"><h2>' . $this->modo->getNomeModo() . '</h2></span>
            <div class="single-row">';
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_imperativo_indicativo();
            $coniugaz .= '</div>';
        $coniugaz .= '</div>';

        return $coniugaz;
    }

    private function coniugazione_modo_infinitoHTML() : string {
        $this->modo = new Modo("INFINITO","INDEFINITO");

        $coniugaz = '
        <div class="modo">
            <span class="nome-modo"><h2>' . $this->modo->getNomeModo() . '</h2></span>
            <div class="single-row">';
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_infinito_presente();
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_infinito_passato();
            $coniugaz .= '</div>';
        $coniugaz .= '</div>';

        return $coniugaz;
    }

    private function coniugazione_modo_participioHTML() : string {
        $this->modo = new Modo("PARTICIPIO","INDEFINITO");

        $coniugaz = '
        <div class="modo">
            <span class="nome-modo"><h2>' . $this->modo->getNomeModo() . '</h2></span>
            <div class="single-row">';
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_participio_presente();
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_participio_passato();
            $coniugaz .= '</div>';
        $coniugaz .= '</div>';

        return $coniugaz;
    }

    private function coniugazione_modo_gerundioHTML() : string {
        $this->modo = new Modo("GERUNDIO","INDEFINITO");

        $coniugaz = '
        <div class="modo">
            <span class="nome-modo"><h2>' . $this->modo->getNomeModo() . '</h2></span>
            <div class="single-row">';
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_gerundio_presente();
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_gerundio_passato();
            $coniugaz .= '</div>';
        $coniugaz .= '</div>';

        return $coniugaz;
    }

    private function coniugazione_verbo_classica_infinito_presente() : string {
        $radice = $this->verbo->getRadice();
        $desinenza = $this->verbo->getDesinenza();
        $this->tempo = new Tempo("Presente", "Semplice");

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        //$this->stampa_desinenza_del_verbo($this->desinenza_imperativo_presente, $output);
        $output .= '<span class="single-conjugation">';
        $output .= $radice . '<span style="color: red;">' . $desinenza . '</span>' . '</span>';
        $output .= '</div>
        </div>';

        return $output;
    }

    private function coniugazione_verbo_classica_infinito_passato() : string {
        $radice = $this->verbo->getRadice();
        $stringa = $this->verbo->getParola();
        $desinenza = $this->verbo->getDesinenza();
        $this->tempo = new Tempo("Passato", "Semplice");

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        //$this->stampa_desinenza_del_verbo($this->desinenza_imperativo_presente, $output);
        $output .= '<span class="single-conjugation">';
        if ( (substr($stringa, -5) === "scere") || (substr($stringa, -4) === "cere") ) //verbi -iere
            $output .= 'avere ' . '<span style="color: red;">' . $radice . 'i' . $this->desinenza_participio_passato . '</span>' . '</span>';
        else
            $output .= 'avere ' . '<span style="color: red;">' . $radice . $this->desinenza_participio_passato . '</span>' . '</span>';
        $output .= '</div>
        </div>';

        return $output;
    }

    private function coniugazione_verbo_classica_participio_presente() : string {
        $radice = $this->verbo->getRadice();
        $this->tempo = new Tempo("Presente", "Semplice");

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        //$this->stampa_desinenza_del_verbo($this->desinenza_imperativo_presente, $output);
        $output .= '<span class="single-conjugation">';
        $output .= $radice . '<span style="color: red;">' . $this->desinenza_participio_presente . '</span>' . '</span>';
        $output .= '</div>
        </div>';

        return $output;
    }

    private function coniugazione_verbo_classica_participio_passato() : string {
        $radice = $this->verbo->getRadice();
        $stringa = $this->verbo->getParola();
        $this->tempo = new Tempo("Passato", "Semplice");

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        //$this->stampa_desinenza_del_verbo($this->desinenza_imperativo_presente, $output);
        $output .= '<span class="single-conjugation">';
        if ( (substr($stringa, -5) === "scere") || (substr($stringa, -4) === "cere") ) //verbi -iere
            $output .= $radice . '<span style="color: red;">i' . $this->desinenza_participio_passato . '</span>' . '</span>';
        else
            $output .= $radice . '<span style="color: red;">' . $this->desinenza_participio_passato . '</span>' . '</span>';
        $output .= '</div>
        </div>';

        return $output;
    }

    private function coniugazione_verbo_classica_gerundio_presente() : string {
        $radice = $this->verbo->getRadice();
        $this->tempo = new Tempo("Presente", "Semplice");

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        //$this->stampa_desinenza_del_verbo($this->desinenza_imperativo_presente, $output);
        $output .= '<span class="single-conjugation">';
        $output .= $radice . '<span style="color: red;">' . $this->desinenza_gerundio_presente . '</span>' . '</span>';
        $output .= '</div>
        </div>';

        return $output;
    }

    private function coniugazione_verbo_classica_gerundio_passato() : string {
        $radice = $this->verbo->getRadice();
        $stringa = $this->verbo->getParola();
        $this->tempo = new Tempo("Passato", "Semplice");

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        //$this->stampa_desinenza_del_verbo($this->desinenza_imperativo_presente, $output);
        $output .= '<span class="single-conjugation">';
        if ( (substr($stringa, -5) === "scere") || (substr($stringa, -4) === "cere") ) //verbi -iere
            $output .= 'avendo ' . $radice . '<span style="color: red;">i' . $this->desinenza_participio_passato . '</span>' . '</span>';
        else
            $output .= 'avendo ' . $radice . '<span style="color: red;">' . $this->desinenza_participio_passato . '</span>' . '</span>';
        $output .= '</div>
        </div>';

        return $output;
    }

    private function coniugazione_verbo_no_eccezioni($stringa, $lunghezza_radice_parola, $array_desinenza, &$output_string){
        //Passo come parametro l'oggetto verbo e l'output su cui stampare il tutto
        for ($i=0; $i < self::numero_pronomi; $i++) {
            //stampo radice del verbo
            //salvo eventuale stampa in una stringa
            //così potenzialmente o la ritorno, o la stampo
            $output_string .= '<span class="single-conjugation">';
            $output_string .= $this->oggetto_pronomi_personali[$i]->getParolaPronome() . ' ';

            //stampo poi la desinenza del verbo
            if($array_desinenza[$i] == ""){
                $output_string .= "-";
                $output_string .= "</span>";
            }else{
                $output_string .= substr($stringa, 0, $lunghezza_radice_parola);

                //stampo poi la desinenza del verbo
                $output_string .= '<span style="color: red;">' . $array_desinenza[$i] . '</span>';
                $output_string .= "</span>";
            }
        }
    }

    private function coniugazione_verbo_tempo_composto($array_desinenza, &$output_string){
        $radice = $this->verbo->getRadice();
        $stringa = $this->verbo->getParola();
        for ($i=0; $i < self::numero_pronomi; $i++) {
            $output_string .= '<span class="single-conjugation">';
            $output_string .= $this->oggetto_pronomi_personali[$i]->getParolaPronome() . ' ';

            //stampo poi la desinenza del verbo
            if ( (substr($stringa, -5) === "scere") || (substr($stringa, -4) === "cere") ) //verbi -iere
                $output_string .= $array_desinenza[$i] . " " . $radice . '<span style="color: red;">i' . $this->desinenza_participio_passato . '</span>';
            else
                $output_string .= $array_desinenza[$i] . " " . $radice . '<span style="color: red;">' . $this->desinenza_participio_passato . '</span>';
        $output_string .= "</span>";
        }
    }

    private function stampa_desinenza_del_verbo($array_desinenza, &$output_string){
        //Passo come parametro l'oggetto verbo e l'output su cui stampare il tutto
        $stringa = $this->verbo->getParola();
        $lunghezza_radice_parola = $this->verbo->getLunghezzaRadice();

        //CONTROLLARE CASI PARTICOLARI DELLA PRIMA CONIUGAZIONE
        if (substr($stringa, -4) === "iere") //verbi -iere
            $this->eccezioneIere($stringa, $lunghezza_radice_parola, $array_desinenza, $output_string);
        else
            $this->coniugazione_verbo_no_eccezioni($stringa, $lunghezza_radice_parola, $array_desinenza, $output_string);
    }

    private function coniugazione_verbo_classica_indicativo_presente(){ //OGGETTO VERBO COME PARAMETRO
        $this->tempo = new Tempo("Presente", "Semplice");

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        $this->stampa_desinenza_del_verbo($this->desinenza_indicativo_presente, $output);
        $output .= '</div>
        </div>';

        //echo $output;
        return $output;
    }

    private function coniugazione_verbo_classica_indicativo_passato_prossimo(){ //OGGETTO VERBO COME PARAMETRO
        $this->tempo = new Tempo("Passato Prossimo", "Composto");
        
        $desinenzaVerboAvere = $this->ausiliareAvere->getDesinenzaIndicativoPresente();
        $desinenzaVerboEssere = $this->ausiliareEssere->getDesinenzaIndicativoPresente();
        
        // Unisci gli array elemento per elemento
        $unioneaVerboAvereEVerboEssere = array_map([$this, 'unisciElementi'], $desinenzaVerboAvere, $desinenzaVerboEssere);

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        $this->coniugazione_verbo_tempo_composto($unioneaVerboAvereEVerboEssere, $output);
        $output .= '</div>
        </div>';

        //echo $output;
        return $output;
    }

    private function coniugazione_verbo_classica_indicativo_imperfetto(){
        $this->tempo = new Tempo("Imperfetto", "Semplice");

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        $this->stampa_desinenza_del_verbo($this->desinenza_indicativo_imperfetto, $output);
        $output .= '</div>
        </div>';

        //echo $output;
        return $output;
    }

    private function coniugazione_verbo_classica_indicativo_trapassato_prossimo(){ //OGGETTO VERBO COME PARAMETRO
        $this->tempo = new Tempo("Trapassato Prossimo", "Composto");
        
        $desinenzaVerboAvere = $this->ausiliareAvere->getDesinenzaIndicativoImperfetto();
        $desinenzaVerboEssere = $this->ausiliareEssere->getDesinenzaIndicativoImperfetto();

        // Unisci gli array elemento per elemento
        $unioneaVerboAvereEVerboEssere = array_map([$this, 'unisciElementi'], $desinenzaVerboAvere, $desinenzaVerboEssere);

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        $this->coniugazione_verbo_tempo_composto($unioneaVerboAvereEVerboEssere, $output);
        $output .= '</div>
        </div>';

        //echo $output;
        return $output;
    }

    private function coniugazione_verbo_classica_indicativo_passato_remoto(){
        $this->tempo = new Tempo("Passato Remoto", "Semplice");
        //prendo la parola che identifica l'oggetto Verbo.
        //inizializzo la variabile stringa con il contenuto dell'oggetto Verbo
        //Calcolo la lunghezza della radice della parola, togliendo gli ultimi 3 caratteri
        $stringa = $this->verbo->getParola();

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        $this->stampa_desinenza_del_verbo($this->desinenza_indicativo_passato_remoto, $output);
        $output .= '</div>
        </div>';

        //echo $output;
        return $output;
    }

    private function coniugazione_verbo_classica_indicativo_trapassato_remoto(){ //OGGETTO VERBO COME PARAMETRO
        $this->tempo = new Tempo("Trapassato Remoto", "Composto");
        
        $desinenzaVerboAvere = $this->ausiliareAvere->getDesinenzaIndicativoPassatoRemoto();
        $desinenzaVerboEssere = $this->ausiliareEssere->getDesinenzaIndicativoPassatoRemoto();

        // Unisci gli array elemento per elemento
        $unioneaVerboAvereEVerboEssere = array_map([$this, 'unisciElementi'], $desinenzaVerboAvere, $desinenzaVerboEssere);

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        $this->coniugazione_verbo_tempo_composto($unioneaVerboAvereEVerboEssere, $output);
        $output .= '</div>
        </div>';

        //echo $output;
        return $output;
    }

    private function coniugazione_verbo_classica_indicativo_futuro_semplice(){
        $this->tempo = new Tempo("Futuro Semplice", "Semplice");
        //prendo la parola che identifica l'oggetto Verbo.
        //inizializzo la variabile stringa con il contenuto dell'oggetto Verbo
        //Calcolo la lunghezza della radice della parola, togliendo gli ultimi 3 caratteri
        $stringa = $this->verbo->getParola();

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        $this->stampa_desinenza_del_verbo($this->desinenza_indicativo_futuro_semplice, $output);
        $output .= '</div>
        </div>';

        //echo $output;
        return $output;
    }

    private function coniugazione_verbo_classica_indicativo_futuro_anteriore(){ //OGGETTO VERBO COME PARAMETRO
        $this->tempo = new Tempo("Futuro Anteriore", "Composto");
        
        $desinenzaVerboAvere = $this->ausiliareAvere->getDesinenzaIndicativoFuturoSemplice();
        $desinenzaVerboEssere = $this->ausiliareEssere->getDesinenzaIndicativoFuturoSemplice();

        // Unisci gli array elemento per elemento
        $unioneaVerboAvereEVerboEssere = array_map([$this, 'unisciElementi'], $desinenzaVerboAvere, $desinenzaVerboEssere);

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        $this->coniugazione_verbo_tempo_composto($unioneaVerboAvereEVerboEssere, $output);
        $output .= '</div>
        </div>';

        //echo $output;
        return $output;
    }

    private function coniugazione_verbo_classica_congiuntivo_presente(){
        $this->tempo = new Tempo("Presente", "Semplice");
        //prendo la parola che identifica l'oggetto Verbo.
        //inizializzo la variabile stringa con il contenuto dell'oggetto Verbo
        //Calcolo la lunghezza della radice della parola, togliendo gli ultimi 3 caratteri
        $stringa = $this->verbo->getParola();

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        $this->stampa_desinenza_del_verbo($this->desinenza_congiuntivo_presente, $output);
        $output .= '</div>
        </div>';

        //echo $output;
        return $output;
    }

    private function coniugazione_verbo_classica_congiuntivo_passato(){ //OGGETTO VERBO COME PARAMETRO
        $this->tempo = new Tempo("Passato", "Composto");
        
        $desinenzaVerboAvere = $this->ausiliareAvere->getDesinenzaIndicativoFuturoSemplice();
        $desinenzaVerboEssere = $this->ausiliareEssere->getDesinenzaIndicativoFuturoSemplice();

        // Unisci gli array elemento per elemento
        $unioneaVerboAvereEVerboEssere = array_map([$this, 'unisciElementi'], $desinenzaVerboAvere, $desinenzaVerboEssere);

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        $this->coniugazione_verbo_tempo_composto($unioneaVerboAvereEVerboEssere, $output);
        $output .= '</div>
        </div>';

        //echo $output;
        return $output;
    }
    
    private function coniugazione_verbo_classica_congiuntivo_imperfetto(){
        $this->tempo = new Tempo("Imperfetto", "Semplice");
        //prendo la parola che identifica l'oggetto Verbo.
        //inizializzo la variabile stringa con il contenuto dell'oggetto Verbo
        //Calcolo la lunghezza della radice della parola, togliendo gli ultimi 3 caratteri
        $stringa = $this->verbo->getParola();

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        $this->stampa_desinenza_del_verbo($this->desinenza_congiuntivo_imperfetto, $output);
        $output .= '</div>
        </div>';

        //echo $output;
        return $output;
    }

    private function coniugazione_verbo_classica_congiuntivo_trapassato(){ //OGGETTO VERBO COME PARAMETRO
        $this->tempo = new Tempo("Trapassato", "Composto");
        
        $desinenzaVerboAvere = $this->ausiliareAvere->getDesinenzaIndicativoFuturoSemplice();
        $desinenzaVerboEssere = $this->ausiliareEssere->getDesinenzaIndicativoFuturoSemplice();

        // Unisci gli array elemento per elemento
        $unioneaVerboAvereEVerboEssere = array_map([$this, 'unisciElementi'], $desinenzaVerboAvere, $desinenzaVerboEssere);

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        $this->coniugazione_verbo_tempo_composto($unioneaVerboAvereEVerboEssere, $output);
        $output .= '</div>
        </div>';

        //echo $output;
        return $output;
    }
    
    private function coniugazione_verbo_classica_condizionale_presente(){
        $this->tempo = new Tempo("Presente", "Semplice");
        //prendo la parola che identifica l'oggetto Verbo.
        //inizializzo la variabile stringa con il contenuto dell'oggetto Verbo
        //Calcolo la lunghezza della radice della parola, togliendo gli ultimi 3 caratteri
        $stringa = $this->verbo->getParola();

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        $this->stampa_desinenza_del_verbo($this->desinenza_condizionale_presente, $output);
        $output .= '</div>
        </div>';

        //echo $output;
        return $output;
    }

    private function coniugazione_verbo_classica_condizionale_passato(){
        $this->tempo = new Tempo("Passato", "Composto");
        
        $desinenzaVerboAvere = $this->ausiliareAvere->getDesinenzaCondizionalePresente();
        $desinenzaVerboEssere = $this->ausiliareEssere->getDesinenzaCondizionalePresente();

        // Unisci gli array elemento per elemento
        $unioneaVerboAvereEVerboEssere = array_map([$this, 'unisciElementi'], $desinenzaVerboAvere, $desinenzaVerboEssere);

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        $this->coniugazione_verbo_tempo_composto($unioneaVerboAvereEVerboEssere, $output);
        $output .= '</div>
        </div>';

        //echo $output;
        return $output;
    }
    
    private function coniugazione_verbo_classica_imperativo_indicativo(){
        $this->tempo = new Tempo("Presente", "Semplice");
        //prendo la parola che identifica l'oggetto Verbo.
        //inizializzo la variabile stringa con il contenuto dell'oggetto Verbo
        //Calcolo la lunghezza della radice della parola, togliendo gli ultimi 3 caratteri
        $stringa = $this->verbo->getParola();

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        $this->stampa_desinenza_del_verbo($this->desinenza_imperativo_presente, $output);
        $output .= '</div>
        </div>';

        //echo $output;
        return $output;
    }

    private function eccezioneIere(string $stringa, int $lunghezza_radice_parola, array $array_desinenza, string &$output_string) : void {
        for ($i=0; $i < self::numero_pronomi; $i++) {
            //stampo radice del verbo
            //salvo eventuale stampa in una stringa
            //così potenzialmente o la ritorno, o la stampo
            $output_string .= '<span class="single-conjugation">';
            $output_string .= $this->oggetto_pronomi_personali[$i]->getParolaPronome() . " ";

            //stampo poi la desinenza del verbo
            if($array_desinenza[$i] == ""){
                $output_string .= "-";
                $output_string .= "</span>";
            }else if( $this->prima_lettera($array_desinenza[$i]) == 'i'){
            //se primo carattere desinenza uguale a 'i'
            //Tolgo la i dalla radice
                $output_string .= substr($stringa, 0, $lunghezza_radice_parola - 1);
                $output_string .= '<span style="color: red;">' . $array_desinenza[$i] . '</span>';
                $output_string .= "</span>";
            }else{
                $output_string .= substr($stringa, 0, $lunghezza_radice_parola);
                $output_string .= '<span style="color: red;">' . $array_desinenza[$i] . '</span>';
                $output_string .= "</span>";
            }
        }
    }
}

?>