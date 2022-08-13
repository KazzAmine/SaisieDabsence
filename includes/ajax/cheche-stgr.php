<?php

require_once '../config.inc.php';

$cef=$_POST['cef'];
$result = $conn->query("SELECT `filiere`, `groupe`, `cef`, `nom`, `prenom` FROM `stagiaire` WHERE `cef`='".$cef."'");
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        echo '
        <h1>informations</h1>
        <table  class="table table-responsive table-striped">
            <tr class="table-light">
              <th>Fillière</th>
              <th>Groupe</th>
              <th>Cef</th>
              <th>Nom</th>
              <th>Prenom</th>
            </tr>
            <tr>
              <td>'.$row['filiere'].'</td>
              <td>'.$row['groupe'].'</td>
              <td>'.$row['cef'].'</td>
              <th>'.$row['nom'].'</th>
              <th>'.$row['prenom'].'</th>       
            </tr> 
            </table> ';
            
    }
    $res = $conn->query("select motif,type_motif,decision,date_application from sanction inner join appliquer on sanction.id_sanction=appliquer.id_sanction where type_motif='comportement' and appliquer.cef_stgr='".$cef."'");
      if ($res->num_rows > 0) {
        echo' <h1>Historique</h1>
         <table class="table table-responsive table-striped">
         <tr class="table-light">
           <th>motif</th>
           <th>type_motif</th>
           <th>desicion</th>
           <th>date</th>
           
         </tr>
        ';
        while($row = $res->fetch_assoc()){
          echo '
         <tr>
           <td>'.$row['motif'].'</td>
           <td>'.$row['type_motif'].'</td>
           <th>'.$row['decision'].'</th>
           <th>'.$row['date_application'].'</th>
           
         </tr>
       
           ';
          }
          echo'</table>';
}
}



?>