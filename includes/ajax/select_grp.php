<?php 
require_once '../config.inc.php';
try{
        
    $f=$_POST['group'];
    echo '<table class="table my-0" id="dataTable">
    <thead>
        <tr>
            <th>cef</th>
            <th>nom</th>
            <th>prenom</th>         
            
        </tr>
    </thead>
    <tbody>';
    
   $res= $conn->query("SELECT cef,nom,prenom FROM `stagiaire` WHERE groupe='".$f."'");
    if($res->num_rows>0){
        while($row=$res->fetch_assoc()){
            echo "<tr>
            <td> <a id='showStgInfo'>".$row['cef']."</a></td>
            <td>".$row['nom']."</td>
            <td>".$row['prenom']."</td> 
        </tr>";
        }
    }
    echo "</tbody>
    </table>";
} 
catch(Exception $e){
echo $e->getMessage();
}