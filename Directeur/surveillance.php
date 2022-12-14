<?php
require_once "header.php"; 
?>
<div class="container navForm px-1 py-5 mx-auto">

<div class="row d-flex  justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
            <div class="card">
              <h2>gestion du surveillance générale</h2>
              <form>
                <div class="form-card">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Activation</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Afficher</button>
                          </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <?php 
                                require_once '../includes/config.inc.php';
                                $sql="SELECT `mat`, `cin`, `nom`, `prenom` FROM `personnel` WHERE is_active=0;";
                                $res=$conn->query($sql);
                                if ($res->num_rows > 0) {
                                    echo'
                                        <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Matricule</th>
                                            <th>CIN</th>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                        </tr>
                                        </thead>
                                        <tbody>';
                                while($row = $res->fetch_assoc()) 
                                {
                                echo'
                                <tr>
                                    <td>'.$row['mat'].'</td>
                                    <td>'.$row['cin'].'</td>
                                    <td>'.$row['nom'].'</td>
                                    <td>'.$row['prenom'].'</td>
                                    <td><button type="button" id="active" value='.$row['mat'].' class="btn btn-success accept">Activer</button></td>
                                    <td><button type="button"  value='.$row['mat'].' class="btn btn-danger refuse">Refuser</button></td>
                                </tr>
                                ';
                                }
                                echo'</tbody>
                                </table>';
                            }
                            else
                            {
                                echo 'Aucun demmande';
                            }
                             ?>
                            
                        </div> 
    
                          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                          
                            <label ID="Label1"  Text="Les Informations Personnelles"></label>
                            <div class="row justify-content-between text-left">
                            <div >
                            <label class="form-control-label px-3">Choiser un surveilleur</label>
                                <select style="margin-bottom: 30px;" id="select-sg" >
                                <?php 
                                      require_once '../includes/config.inc.php';
                                      try{

                                        $res= $conn->query("SELECT distinct mat, nom , prenom  FROM `personnel` where poste='SG' ");
                                        if($res->num_rows>0){
                                            echo "<option selected='selected'>".'--Select--'."</option>";
                                            while($row=$res->fetch_assoc()){
                                                echo "<option value='".$row['mat']."' >".$row['nom']." ".$row['prenom']." </option>";
                                            }
                                        }
                                      } 
                                      catch(Exception $e){
                                      echo $e->getMessage();
                                      }
                                  ?>
                                </select>
                              </div>
                            <div class="form-group col-sm-6 flex-column d-flex"> 
                                    <label class="form-control-label `px-3`">Matricule<span class="text-danger"> *</span></label>
                                    <input type="text" id="mat2" > 
                                </div>
                                <div class="form-group col-sm-6 flex-column d-flex"> 
                                    <label class="form-control-label px-3">CIN<span class="text-danger"> *</span></label>
                                    <input type="text" id="cin2" > 
                                </div>
                            </div>
                            <div class="row justify-content-between text-left">
                                <div class="form-group col-sm-6 flex-column d-flex"> 
                                    <label class="form-control-label px-3">Nom<span class="text-danger"> *</span></label> 
                                    <input type="text" id="nom2" > 
                                </div>
                                <div class="form-group col-sm-6 flex-column d-flex"> 
                                    <label class="form-control-label px-3">Prenom<span class="text-danger"> *</span></label> 
                                    <input type="text" id="prenom2" > 
                                </div>
                            </div>
                            <div class="row justify-content-between text-left">
                            
                            </div>
                            <div class="row justify-content-between text-left">
                                <div class="form-group col-sm-6 flex-column d-flex"> 
                                <label class="form-control-label invisible px-3">*</label> 
                                    <button type="button" id="supp-sg" class="btn-block btn-danger">Supprimer</button>
                                </div>
                            </div>
                            
                          </div>
                        </div>
                        </form>
            </div>
        </div>
    </div>
</div>
<?php
require_once "footer.php"; 
?>