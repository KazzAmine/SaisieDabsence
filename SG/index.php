<?php 
require_once 'header.php';
?>
<div id="home" class="card card-body">
     
<?php 
                require_once '../includes/config.inc.php';
                $sql="select s.cef,sa.id_sanction,s.nom,s.prenom,s.filiere,s.groupe ,sa.motif,sa.decision from stagiaire s inner join appliquer ap on 
                ap.cef_stgr=s.cef inner join sanction sa on sa.id_sanction=ap.id_sanction where sa.decision!='exclusion definitive' and sa.signer=0;";
                $res=$conn->query($sql);
                if ($res->num_rows > 0) {
                    echo'
                    <table class="table table-responsive table-striped">
                    <tr class="table-light">
                                         <th>Cef</th>
                                         <th>Nom</th>
                                         <th>Prenom</th>
                                         <th>Fillière</th>
                                         <th>Groupe</th>
                                         <th>Motif</th>
                                         <th>Desicion</th>
                                         <th>signer</th>
                                       </tr>
                                       <tbody>';
                while($row = $res->fetch_assoc()) 
                {
                echo'
                <tr>
                    <td>'.$row['cef'].'</td>
                    <td>'.$row['nom'].'</td>
                    <td>'.$row['prenom'].'</td>
                    <td>'.$row['filiere'].'</td>
                    <td>'.$row['groupe'].'</td>
                    <td>'.$row['motif'].'</td>
                    <td>'.$row['decision'].'</td>
                    <td><button type="button"  value='.$row['id_sanction'].' class="btn btn-success annuler">signer</button></td>
                </tr>
                ';
                }
                echo'</tbody>
                </table>';
            }else{
              echo'vide';
            }
            
                ?>
</div>

<?php 
require_once 'footer.php';
?>


<script>
     var pageTitle=$("#pageTitle");
    pageTitle.text("Acceuil");
</script>