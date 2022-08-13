<?php
require_once '../config.inc.php';

$cef=$_POST["cef"];
$date_d=$_POST["date_d"];
$date_f=$_POST["date_f"];
$typeJust=$_POST["typeJust"];






// $res=$conn->query($query);

try{
    $conn->begin_transaction();
    $query="UPDATE `absence` SET `justification`='".$typeJust."' WHERE DATE(date_debut_absence) AND DATE(date_fin_absence) BETWEEN '".$date_d."' AND '".$date_f."' and id_stagiaire='".$cef."'";
    $rowCountQuery='SELECT ROW_COUNT() as rowAffected';
    $querySanction="CALL add_sanction('".$cef."')";
    // $rowCount=$res->fetch_row();
  
    $deleteSanction="delete sanction from sanction inner join appliquer on sanction.id_sanction=appliquer.id_sanction inner join absence on appliquer.cef_stgr=absence.id_stagiaire where absence.id_stagiaire='".$cef."';";
      
    $deleteAppliquer="DELETE FROM `appliquer` WHERE cef_stgr='".$cef."';";
    // for($i=0;$i<$rowCount;$i++){
    //     $updateNote="UPDATE note SET note_assiduite=note_assiduite+0.5 WHERE cef='".$cef."' ";
    //     $conn->query($updateNote);
    // }
    // $checkAnne="SELECT annee_etude from stagiaire where cef='".$cef."';";
    // $anne=$conn->query($checkAnne);
    // if($anne=='1ère année'){
    // $updateNote="";
    // }else if($anne=='1ère année'){

    // }
   
    $conn->query($query);
    
    $res=$conn->query($rowCountQuery);
    if($res->num_rows>0)
    {
        while ($row=$res->fetch_assoc()) {
            $rowCount=$row['rowAffected'];
        }
    }
    $updateNote="UPDATE `note` SET `note_assiduite`=`note_assiduite`+".$rowCount*0.5." WHERE cef='".$cef."';";
    $conn->query($updateNote);
    
    $conn->query($deleteSanction);
    $conn->query($deleteAppliquer);
    
    $conn->query($querySanction);



    echo 'succes';
    $conn->commit();

    }
    catch(Exception $e){
        $conn->rollback();
    }

    

 

?>