<?php 
require "../config.inc.php";
$cef=$_POST['cef'];
$dateAbs=$_POST['dateAbsence'];
 try{
    echo '<table class="table my-0" id="absenceTable">
    <thead>
        <tr>
            <th>date debut</th>
            <th>date fin</th>  
            <th>justification</th>            
        </tr>
    </thead>
    <tbody>';
    
    $query="SELECT date_debut_absence,date_fin_absence,justification FROM absence where id_stagiaire='".$cef."' AND DATE(date_debut_absence) = '".$dateAbs."';";

   $res= $conn->query($query);
    if($res->num_rows>0){
        while($row=$res->fetch_assoc()){
            echo "<tr>
            <td>".$row['date_debut_absence']."</td>
            <td>".$row['date_fin_absence']."</td>
            <td>".$row['justification']."</td>
        </tr>";
        }
    }else{
        echo 'pas d\'absence dans cette date';
    }
    echo "</tbody>
    </table>";
} 
catch(Exception $e){
echo $e->getMessage();
}