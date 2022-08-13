<?php
require_once "header.php"; 
?>
<div class="container card px-1 py-5 mx-auto">
  <div class="row d-flex  justify-content-center">
      <div class=" text-center">
        <form >   
          <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <button class="nav-link active" id="nav-abs-tab" data-bs-toggle="tab" data-bs-target="#nav-abs" type="button" role="tab" aria-controls="nav-abs" aria-selected="true">Absence Notification</button>
                  <button class="nav-link" id="nav-comp-tab" data-bs-toggle="tab" data-bs-target="#nav-comp" type="button" role="tab" aria-controls="nav-comp" aria-selected="false">Ajouter Comportement</button>
              </div>
          </nav>
              <div class="tab-content" id="nav-tabContent">                          
                <div class="tab-pane fade " id="nav-comp" role="tabpanel" aria-labelledby="nav-comp-tab">
                <div class="row d-flex  justify-content-center">
                  <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                      <div class="card">
                        <input name="CEF" type="text" placeholder="Entrer CEF..." id="cef"> <input type="button" class="btn btn-primary" value="Rechercher" id="cherche-stg"></br> </br>               
                        <div id="motifinfo">

                        </div>
                        <div id="add_motif" class="d-none">
                          <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex"> 
                                    <label class="form-control-label px-3">Motif<span class="text-danger"> *</span></label> 
                                    <textarea id="description_motif" cols="30" rows="1"></textarea>
                                    
                                </div>
                                <div class="form-group col-sm-6 flex-column d-flex"> 
                                <label class="form-control-label invisible  px-3">*Desicion</label> 
                                    <select id="Desicion">
                                      <option selected="selected"><--Select--></option>
                                      <option value="Averstissement">Averstissement</option>
                                      <option value="Blame">Blâme</option>
                                      <option value="Exclusion de 2 jours">Exclusion de 2 jours</option>
                                      <option value="Exclusion Definitive">Exclusion Définitive</option>
                                </select>
                            </div>
                        </div>   
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-12 flex-column d-flex"> 
                                    <input type="button" class="btn btn-primary" id="add-compot" value="Envoyer">                                    
                                </div>
                        </div>   
                        </div>              
                                            
                      </div>  
                  </div>
                </div>
                </div>  
                <div class="tab-pane fade show active" id="nav-abs" role="tabpanel" aria-labelledby="nav-abs-tab">
                
                <?php 
                require_once '../includes/config.inc.php';
                $sql="select s.cef,s.nom,s.prenom,s.filiere,s.groupe ,sa.motif,sa.decision from stagiaire s inner join appliquer ap on 
                ap.cef_stgr=s.cef inner join sanction sa on sa.id_sanction=ap.id_sanction where sa.decision='Exclusion definitive';";
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
                                         <th>Accepter</th>
                                         <th>Refuser</th>
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
                    <td><button type="button"  value='.$row['cef'].' class="btn btn-success delete">supprimer</button></td>
                    <td><button type="button"  value='.$row['cef'].' class="btn btn-danger annuler">annuler</button></td>
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
              </div>
        </form>
    </div>
  </div>
</div>
<?php
require_once "footer.php"; 
?>