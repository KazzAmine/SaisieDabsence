<?php
require_once '../config.inc.php';

$mat=$_POST["mat"];
$cin=$_POST["cin"];
$nom=$_POST["nom"];
$prenom=$_POST["prenom"];
$pass=$_POST["pass"];

$sql="INSERT INTO `personnel`(`mat`, `cin`, `nom`, `prenom`, `poste`, `password`,`is_active`) VALUES ('".$mat."','".$cin."','".$nom."','".$prenom."','SG','".$pass."','0')";
$res=$conn->query($sql);
if ($res===TRUE) {
  echo 'success';
 } else {
  echo "Error: " . $sql . "<br>" . $conn->error;
 }

?>