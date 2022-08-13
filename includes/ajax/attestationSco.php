<?php
require '../config.inc.php';
require '../fpdf.php';


try{
    $cef=$_GET['cef'];
    $identite_stagiaire = $conn->query("SELECT `niveau`, `filiere`, `type_formation`, `annee_etude`, `cef`, `nom`, `prenom` FROM `stagiaire` WHERE cef ='".$cef."'");
    if ($identite_stagiaire->num_rows > 0) {
    
        while($row = $identite_stagiaire->fetch_assoc()) {
            
            $pdf = new FPDF('P', 'mm', 'A5');
    
            
            $pdf->AddPage();
    
            $pdf->Image('../ofppt_logo.png', 10, 5, 130, 30);

            $pdf->Ln(30);
    

            $pdf->SetFont('Arial', 'B', 16);

            $pdf->Cell(0, 10, 'ATTESTATION DE POURSUITE DE FORMATION', 'TB', 1, 'C');
            // $pdf->Cell(0, 10, 'N°:', 0, 1, 'C');
    

            $pdf->Ln(5);

    
            $pdf->SetFont('Arial', '', 10);
    
    
            $pdf->Write(7,utf8_decode("Je soussigné, Directeur de l'établissement Institut Spécialisé de Technologie Appliquée TAZA : \n"));
    
            $pdf->Write(7,"    " . "Atteste que le stagiaire : ");
    
            $pdf->SetFont('', 'BIU');
    
            $pdf->Write(7,utf8_decode( $row['nom'].' '.$row['prenom'] . "\n"));
    
            $pdf->SetFont('', '');
    
            $pdf->Write(7,utf8_decode("    " . "Niveau de formation :  " .$row['niveau']  . "  \n"));
    
            $pdf->Write(7,utf8_decode("    " . "Spécialité :  " .$row['filiere']. " \n"));
    
            $pdf->Write(7,utf8_decode( "    " . "En :  " . $row['annee_etude'] . "  \n"));
    
            $pdf->Write(7,utf8_decode( "    " . "Type Formation :  " .$row['type_formation']  . "  \n"));
    
            $pdf->Write(7,utf8_decode( "    " . "N° d'inscription : " . $row['cef'] . " \n"));
    
            $pdf->Write(7, utf8_decode("    " . "Année de formation :  ") .date("Y")-1 .'/'.date("Y"). "  \n");
    
    
            $pdf->Write(7,utf8_decode( "Poursuit sa formation à l'établissement depuis \n"));
    
            $pdf->Write(7,utf8_decode( "Cette attestation est délivré à l'intéressé pour servir et valoir ce que le droit. \n"));

            $pdf->Ln(5);
    
            $pdf->Cell(0, 5, utf8_decode('Fait à Taza Le :') .date('d/m/Y'), 0, 1, 'C');

            $pdf->Ln(10);
    
            $pdf->Write(7,utf8_decode("                                     signature et cachet du :"));
            $pdf->Ln(15);
            $pdf->Write(7,utf8_decode("               Directeur "."                                                  "."Surveillant générale "));
      
            //Afficher le pdf
            $pdf->Output("I","attestation.pdf",false);

        }
    } 
      
}catch(Exception $ex)
{
    echo $ex->getMessage();
}

?>