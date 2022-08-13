<?php

require_once '../config.inc.php';

$mat=$_POST['mat'];
$pass=$_POST['pass'];

$result = $conn->query("SELECT `mat`, `cin`, `nom`, `prenom`, `poste`, `password`, `is_active` FROM `personnel` where mat='".$mat."' and password='".$pass."'");
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        if ($row['is_active']==1) {
            $_SESSION['mat']=$row['mat'];
            $_SESSION['cin']=$row['cin'];
            $_SESSION['nom']=$row['nom'];
            $_SESSION['prenom']=$row['prenom'];
            $_SESSION['password']=$row['password'];
            
            echo $row['poste'] ;   
        }
        else{
            echo 'fail';
        }   
    }
}
else{
    echo 'fail';
}
?>