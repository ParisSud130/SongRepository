<?php
        
    class ExportController extends Controller{
        private $sm;    
        private $tm;    

        public function __construct(){
            $this->sm = new SongManager();
            $this->tm = new ThemeManager();
        }
                
        public function trameToPdfAction($id) {
        }

        public function chantToPdfAction() {
            if (!class_exists('FPDF')) {
                require (__DIR__."/../Utils/fpdf/fpdf.php");
            }
            if (isset($_GET["id"])){
                $pdf = new FPDF();
                $pdf->AddPage();

                $this->writeSong($pdf, $_GET["id"]);

                $pdf->Output();
            }
        }

        private function writeSong($_pdf, $idChant) {
            $song = $this->sm->getSong($idChant);
            $this->writeTitre($_pdf, $song);

            foreach ($song->getStrophes() as $strophe){
                $this->writeStrophe($_pdf, $strophe);
            }  
        }

        private function writeTitre($_pdf, $_song) {
            $_pdf->SetFont('Helvetica', 'b', 20);
            $_pdf->Write(10, utf8_decode($_song->getTitre()));
            $_pdf->Ln();
            $_pdf->SetFont('Helvetica', 'bi', 14);
            $_pdf->Write(7, '(' . utf8_decode($_song->getRecueil()->getNomRecueil()) . ' # ' . $_song->getNumChant() . ')');
            $_pdf->Ln();
            $_pdf->Ln();
        }

        private function writeStrophe($_pdf, $_strophe) {
            
            $_pdf->SetFont('Helvetica', 'bi', 12);
            $_pdf->Write(7, $_strophe->getType(). " ".$_strophe->getIdentifiant());
            $_pdf->Ln();

            $_pdf->SetFont('Helvetica', '', 12);
            $_strophe->setTexte(str_replace("œ","oe",$_strophe->getTexte()));
            $_strophe->setTexte(str_replace("œ","oe",preg_replace( "/[\r\n]+/", "\n", $_strophe->getTexte() )));
            $_pdf->Write(7, utf8_decode($_strophe->getTexte()));
            $_pdf->Ln();
            $_pdf->Ln();
        }
    }

?>