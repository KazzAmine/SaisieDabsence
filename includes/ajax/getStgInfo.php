<?php 
require "../config.inc.php";
   
$cef=$_POST['cef'];

$query="SELECT cef, CONCAT(nom, ' ', prenom) AS 'nom du stagiaire',filiere,groupe,annee_etude,niveau from stagiaire where cef='".$cef."'";
$res= $conn->query($query);
        if($res->num_rows>0){
        while($row=$res->fetch_assoc()){
            echo $row['cef'].'/'.$row['nom du stagiaire'].'/'.$row['filiere'].'/'.$row['groupe'].'/'.$row['annee_etude'].'/'.$row['niveau'].'@';
        }
}