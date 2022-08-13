<?php
require_once '../config.inc.php';

$sg=$_POST["sg"];
$cin=$_POST["cin"];
$nom=$_POST["nom"];
$prenom=$_POST["prenom"];


$sql="UPDATE `personnel` SET `cin`='".$cin."',`nom`='".$nom."',`prenom`='".$prenom."' WHERE mat='".$sg."'";
if ($conn->query($sql)===true) {
    echo 'succes';
}
 

?>