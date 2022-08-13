<?php 
require "../config.inc.php";


function get_total($cef_stg)
{
    global $conn;
    $query="select count(*) as total from absence where id_stagiaire='".$cef_stg."';";
    $res= $conn->query($query);
     if($res->num_rows>0){
         while($r=$res->fetch_assoc()){
            return $r['total'];
        }
    }
}

function get_Note($cef_stg)
{
    global $conn;
    $query="SELECT `note_comportement`, `note_assiduite` FROM `note` WHERE cef='".$cef_stg."';";
    $res= $conn->query($query);
     if($res->num_rows>0){
         while($r=$res->fetch_assoc()){
            return $r['note_assiduite'] ."/".$r['note_comportement'];
        }
    }
}

$grp=$_POST['grp'];
try{
    
    $query="SELECT cef ,nom ,prenom FROM stagiaire where groupe='".$grp."';";
   $res= $conn->query($query);
    if($res->num_rows>0){
        while($row=$res->fetch_assoc()){
            echo $row['cef'].'/'.$row['nom'].'/'.$row['prenom'].'/'.get_total($row['cef']).'/'.get_Note($row['cef']).'@';
            // echo var_dump($jsonRow);
        }
    }
    
} 
catch(Exception $e){
echo $e->getMessage();
}