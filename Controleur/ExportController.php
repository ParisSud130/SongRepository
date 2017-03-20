<?php
        
    class ExportController extends Controller{
        private $sm;    
        private $tm;    

        public function __construct(){
            $this->sm = new ChantManager();
            $this->tm = new ThemeManager();
        }
                
        public function trameToPdfAction($id) {
            


        }

        public function chantToPdfAction() {
            if (!class_exists('FPDF')) {
                require (__DIR__."/../Utils/fpdf/fpdf.php");
            }
            if (isset($_GET["id"])){
                $id = $_GET["id"];
                $texte = $this->chantToTexte($id);

                $pdf = new FPDF();
                $pdf->AddFont('Trebuchet','','trebuc.php');
                $pdf->AddPage();
                $pdf->SetFont('Trebuchet','',12);
                $pdf->MultiCell(0,10,$texte);
                $pdf->Output();
            }
        }

        private function chantToTexte($id) {
            $song = $this->sm->getSong($id);
            $text = utf8_decode($song->getTitre()) . "\n\n";
            
            foreach ($song->getStrophes() as $strophe){
                $text .= $strophe->getType(). " ".$strophe->getIdentifiant() . "\n";
                $strophe->setTexte(str_replace("œ","oe",$strophe->getTexte()));
                $strophe->setTexte(str_replace("œ","oe",preg_replace( "/[\r\n]+/", "\n", $strophe->getTexte() )));
                $text .= utf8_decode($strophe->getTexte()) . "\n\n"; 
            }  

            return $text;          
        }

}
?>