<?php
include_once 'Verbo.php';
include_once "Pronome.php";
include_once "Modo.php";
include_once "Tempo.php";
include_once "Coniugazione.php";

class VerboEssere extends Verbo {
    private string $parola;
    private string $radice;
    private string $desinenza;
    private int $lunghezzaRadice;// = strlen($stringa) - 3;
    private int $lunghezzaDesinenza;

    private Coniugazione $coniugazione; //prima, seconda, terza, propria
    private string $tipo_coniugazione; //prima, seconda, terza, propria


    //COSTANTE NON HA BISOGNO DI PRIVATE E DEL DOLLARO
    //SI ACCEDE TRAMITE self::costante
    //E NON TRAMITE this->costante
    //private const numero_pronomi = 6;
    private const numero_pronomi = 6;

    private $desinenza_indicativo_presente = ["sono","sei","è","siamo","siete","sono"];
    private $desinenza_indicativo_imperfetto = ["ero","eri","era","eravamo","eravate","erano"];
    private $desinenza_indicativo_passato_remoto = ["fui","fosti","fu","fummo","foste","furono"];
    private $desinenza_indicativo_futuro_semplice = ["sarò","sarai","sarà","saremo","sarete","saranno"];
    private $desinenza_congiuntivo_presente = ["sia","sia","sia","siamo","siate","siano"];
    private $desinenza_congiuntivo_imperfetto = ["fossi","fossi","fosse","fossimo","foste","fossero"];
    private $desinenza_condizionale_presente = ["sarei","saresti","sarebbe","saremmo","sareste","sarebbero"];
    private $desinenza_imperativo_presente = ["","sii","sia","siamo","siate","siano"];
    private $desinenza_participio_presente = "essente";
    private $desinenza_participio_passato = "stato";
    private $desinenza_gerundio_presente = "essendo";

    private Modo $modo; //OGGETTO DI TIPO MODO ISTANZIATO NEL COSTRUTTORE
    private Tempo $tempo; //OGGETTO DI TIPO TEMPO ISTANZIATO NEL COSTRUTTORE
    private array $oggetto_pronomi_personali;

    public function __construct() {
        $this->parola = "essere";
        $this->tipo_coniugazione = "Propria";
        $desinenza = substr($this->parola, -3);

        $lunghezza_radice_parola = strlen($this->parola) - 3;
        $this->radice = substr($this->parola, 0, $lunghezza_radice_parola);
        $this->desinenza = $desinenza;
        $this->lunghezzaDesinenza = strlen($desinenza);
        $this->lunghezzaRadice = strlen($this->parola) - $this->lunghezzaDesinenza;

        $this->inizializzaArrayOggettoPronomi();
    }

    public function coniuga() : string {
        return $this->coniugazioneVerboHTML();
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

    public function getDesinenzaIndicativoPresente() : array {
        return $this->desinenza_indicativo_presente;
    }

    public function getDesinenzaIndicativoImperfetto() : array {
        return $this->desinenza_indicativo_imperfetto;
    }

    public function getDesinenzaIndicativoPassatoRemoto() : array {
        return $this->desinenza_indicativo_passato_remoto;
    }

    public function getDesinenzaIndicativoFuturoSemplice() : array {
        return $this->desinenza_indicativo_futuro_semplice;
    }

    public function getDesinenzaCongiuntivoPresente() : array {
        return $this->desinenza_congiuntivo_presente;
    }

    public function getDesinenzaCongiuntivoImperfetto() : array {
        return $this->desinenza_congiuntivo_imperfetto;
    }

    public function getDesinenzaCondizionalePresente() : array {
        return $this->desinenza_condizionale_presente;
    }

    public function getDesinenzaImperativoPresente() : array {
        return $this->desinenza_imperativo_presente;
    }

    /*public function getDesinenzaParticipioPresente() : string {
        return $this->desinenza_participio_presente;
    }

    public function getDesinenzaParticipioPassato() : string {
        return $this->desinenza_participio_passato;
    }

    public function getDesinenzaGerundioPresente() : string {
        return $this->desinenza_gerundio_presente;
    }*/

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

    public function coniugazioneVerbo() : string { //OGGETTO VERBO COME PARAMETRO
        $coniugaz = "";
        //$coniugaz = $coniugaz . $this->coniugazione_modo_indicativo();
        //$coniugaz = $coniugaz . $this->coniugazione_modo_congiuntivo();
        //$coniugaz = $coniugaz . $this->coniugazione_modo_condizionale();
        //$coniugaz = $coniugaz . $this->coniugazione_modo_imperativo();
        return $coniugaz;
    }
    
    private function coniugazioneVerboHTML() : string { //OGGETTO VERBO COME PARAMETRO
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
        $radice = $this->radice;
        $desinenza = $this->desinenza;
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
        $output .= $radice . $desinenza . '</span>';
        $output .= '</div>
        </div>';

        return $output;
    }

    private function coniugazione_verbo_classica_infinito_passato() : string {
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
        $output .= 'avere ' . $this->desinenza_participio_passato . '</span>';
        $output .= '</div>
        </div>';

        return $output;
    }

    private function coniugazione_verbo_classica_participio_presente() : string {
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
        $output .= $this->desinenza_participio_presente . '</span>';
        $output .= '</div>
        </div>';

        return $output;
    }

    private function coniugazione_verbo_classica_participio_passato() : string {
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
        $output .= $this->desinenza_participio_passato . '</span>';
        $output .= '</div>
        </div>';

        return $output;
    }

    private function coniugazione_verbo_classica_gerundio_presente() : string {
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
        $output .= $this->desinenza_gerundio_presente . '</span>';
        $output .= '</div>
        </div>';

        return $output;
    }

    private function coniugazione_verbo_classica_gerundio_passato() : string {
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
        $output .= 'avendo ' . $this->desinenza_participio_passato . '</span>';
        $output .= '</div>
        </div>';

        return $output;
    }

    private function coniugazione_modo_indicativo(){
        $coniugaz = "";
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_indicativo_presente();
        $coniugaz = $coniugaz . "--------------------------------------------------------<br>";
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_indicativo_imperfetto();
        $coniugaz = $coniugaz . "--------------------------------------------------------<br>";
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_indicativo_passato_remoto();
        $coniugaz = $coniugaz . "--------------------------------------------------------<br>";
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_indicativo_futuro_semplice();
        $coniugaz = $coniugaz . "--------------------------------------------------------<br>";
        
        return $coniugaz;
    }

    private function coniugazione_modo_congiuntivo(){
        $coniugaz = "";
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_congiuntivo_presente();
        $coniugaz = $coniugaz . "--------------------------------------------------------<br>";
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_congiuntivo_imperfetto();
        $coniugaz = $coniugaz . "--------------------------------------------------------<br>";
        return $coniugaz;
    }

    private function coniugazione_modo_condizionale(){
        $coniugaz = "";
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_condizionale_presente();
        $coniugaz = $coniugaz . "--------------------------------------------------------<br>";
        return $coniugaz;
    }

    private function coniugazione_modo_imperativo(){
        $coniugaz = "";
        $coniugaz = $coniugaz . $this->coniugazione_verbo_classica_imperativo_indicativo();
        return $coniugaz;
    }

    private function coniugazione_verbo_no_eccezioni($array_desinenza, &$output_string){
        for ($i=0; $i < self::numero_pronomi; $i++) {
            $output_string .= '<span class="single-conjugation">';
            $output_string .= $this->oggetto_pronomi_personali[$i]->getParolaPronome() . ' ';

            if($array_desinenza[$i] == ""){
                $output_string .= "-";
                $output_string .= "</span>";
            }else{
                //stampo poi la desinenza del verbo
                $output_string .= $array_desinenza[$i];
                $output_string .= "</span>";
            }
        }
    }

    private function coniugazione_verbo_tempo_composto($array_desinenza, &$output_string){
        for ($i=0; $i < self::numero_pronomi; $i++) {
            $output_string .= '<span class="single-conjugation">';
            $output_string .= $this->oggetto_pronomi_personali[$i]->getParolaPronome() . ' ';

            //stampo poi la desinenza del verbo
            $output_string .= $array_desinenza[$i] . " " . $this->desinenza_participio_passato;
            $output_string .= "</span>";
        }
    }

    private function stampa_desinenza_del_verbo($array_desinenza, &$output_string){
        $this->coniugazione_verbo_no_eccezioni($array_desinenza, $output_string);
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

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        $this->coniugazione_verbo_tempo_composto($this->desinenza_indicativo_presente, $output);
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

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        $this->coniugazione_verbo_tempo_composto($this->desinenza_indicativo_imperfetto, $output);
        $output .= '</div>
        </div>';

        //echo $output;
        return $output;
    }

    private function coniugazione_verbo_classica_indicativo_passato_remoto(){
        $this->tempo = new Tempo("Passato Remoto", "Semplice");

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

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        $this->coniugazione_verbo_tempo_composto($this->desinenza_indicativo_passato_remoto, $output);
        $output .= '</div>
        </div>';

        //echo $output;
        return $output;
    }

    private function coniugazione_verbo_classica_indicativo_futuro_semplice(){
        $this->tempo = new Tempo("Futuro Semplice", "Semplice");

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

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        $this->coniugazione_verbo_tempo_composto($this->desinenza_indicativo_futuro_semplice, $output);
        $output .= '</div>
        </div>';

        //echo $output;
        return $output;
    }

    private function coniugazione_verbo_classica_congiuntivo_presente(){
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
        $this->stampa_desinenza_del_verbo($this->desinenza_congiuntivo_presente, $output);
        $output .= '</div>
        </div>';

        //echo $output;
        return $output;
    }

    private function coniugazione_verbo_classica_congiuntivo_passato(){
        $this->tempo = new Tempo("Passato", "Composto");

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        $this->coniugazione_verbo_tempo_composto($this->desinenza_congiuntivo_presente, $output);
        $output .= '</div>
        </div>';

        //echo $output;
        return $output;
    }
    
    private function coniugazione_verbo_classica_congiuntivo_imperfetto(){
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
        $this->stampa_desinenza_del_verbo($this->desinenza_congiuntivo_imperfetto, $output);
        $output .= '</div>
        </div>';

        //echo $output;
        return $output;
    }

    private function coniugazione_verbo_classica_congiuntivo_trapassato(){
        $this->tempo = new Tempo("Trapassato", "Composto");

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        $this->coniugazione_verbo_tempo_composto($this->desinenza_congiuntivo_imperfetto, $output);
        $output .= '</div>
        </div>';

        //echo $output;
        return $output;
    }
    
    private function coniugazione_verbo_classica_condizionale_presente(){
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
        $this->stampa_desinenza_del_verbo($this->desinenza_condizionale_presente, $output);
        $output .= '</div>
        </div>';

        //echo $output;
        return $output;
    }

    private function coniugazione_verbo_classica_condizionale_passato(){
        $this->tempo = new Tempo("Passato", "Composto");

        $output = "";
        $output = '
            <div class="tempo-verbale">
                <div class="box-titolo-tempo">
        <span class="nome-tempo">
        ';
        $output .= '<h3>'. $this->tempo->getNomeTempo(). '</h3></span>
        </div>
        <div class="coniugazione-tempo">';
        $this->coniugazione_verbo_tempo_composto($this->desinenza_condizionale_presente, $output);
        $output .= '</div>
        </div>';

        //echo $output;
        return $output;
    }
    
    private function coniugazione_verbo_classica_imperativo_indicativo(){
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
        $this->stampa_desinenza_del_verbo($this->desinenza_imperativo_presente, $output);
        $output .= '</div>
        </div>';

        //echo $output;
        return $output;
    }
}

?>