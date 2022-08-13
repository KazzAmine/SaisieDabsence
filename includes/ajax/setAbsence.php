<?php 
require "../config.inc.php";
$cef=$_POST['cef'];
$date_debut = date("Y-m-d H:i", strtotime($_POST['date_d']));  
$date_fin = date("Y-m-d H:i", strtotime($_POST['date_f']));  

$query="INSERT INTO `absence`( `id_stagiaire`, `date_debut_absence`, `date_fin_absence`,`justification`) VALUES ('".$cef."','".$date_debut."','".$date_fin."','non justifié')";

$queryNote="CALL update_note_assiduite('".$cef."')";
$querySanction="CALL add_sanction('".$cef."')";
try{
    $conn->begin_transaction();
    $conn->query($query);

    $conn->query($queryNote);
    $conn->commit();
    $conn->query($querySanction);
    $conn->commit();
    // echo $cef .'  '.$date_debut.'   '.$date_fin;
}
catch(Exception $ex){
    echo $ex->getMessage();
    $conn->rollback();
}