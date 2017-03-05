<?php
    class ExportController extends Controller{
        
        public function __construct(){
        }
                
        public function toPdfAction() {
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial','B',16);
            $pdf->Cell(40,10,'Hello World !');
            $pdf->Output();

            //$params = array( "songs"=>$lastSongs,  "mostViewedSongs"=>$mostViewedSongs,  "intro"=>$intro);
            //new View("accueil.php", Config::APP_NAME, $params);

        }

}
?>