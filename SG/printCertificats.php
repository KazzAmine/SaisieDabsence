<?php 
require_once 'header.php';
?>
<div id="stagaireContainer">
    <div class="container-fluid">
        <h3 class="text-dark mb-4">Stagiaires</h3>
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 fw-bold">Liste des stagiaires</p>
            </div>
            <div class="card-body" id="lstStagiaire">
                <div class="row">
                    <div class="col-md-4 text-nowrap">
                        <div id="dataTable_length" class="dataTables_length"  aria-controls="dataTable"><label class="form-label">
                            <form method="POST">
                            <select class="d-inline-block form-select form-select-sm mb-6" id="filiereCert" name="filiereCert" >
                                    <option value="" disabled selected>Filieres</option>
                                    
                                    <!-- les Filiere -->
                                    <?php
                                     require '../includes/config.inc.php';
                                     $query='select DISTINCT filiere FROM stagiaire';
                                     $stmt=$conn->query($query);
                                     if($stmt->num_rows>0){
                                         while($row=$stmt->fetch_assoc()){
                                             echo "<option value='".$row['filiere']."'>".$row['filiere']."</option>";
                                         }
                                     }
                                    ?>    
                            </select>
                         <select class="d-inline-block form-select form-select-sm mb-6" id="groupeCert" name="groupeCert" >
                                    <!-- les groupes -->
                                   
                            </select>
                          
                        </form>
                        </label>
                        </div>
                    </div>
                    <div class="table-responsive table mt-2" id="tableCont" role="grid" aria-describedby="dataTable_info">                   
                         <!-- table des stagiaires -->

                     </div>      
                     <div id="warning">
                            <p>NB: note discipline est sur /20 pour Les 1er années, et sur /15 pour les 2éme années</p>
                        </div>
            </div>
        </div>
    </div>
</div>
<div id="infoStagiaire" class='d-none'>
    <div class="container container-fluid">
        <div class="card shadow">
            <div class="card-header py-3">
                <p id="goBack"><- liste stagaire</p>
                <p class="text-primary m-0 fw-bold" id="contname">STAGIAIRE : <span id="stgnom">
                    
                </span> </p>

            </div>
            <div class="card-body">
            <div id="DetStg">
                <p id="infoCont">
                    
                </p>
            </div>
            <div id="Certificats">
                    <div class="row" id="attContainer">
                        <form>
                            <label>Attestation scolaire</label>
                            <button type="button" id="btnattScolaire" class="offset-2">Telecharger</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<?php 
require_once 'footer.php';
?>
<script>
     var pageTitle=$("#pageTitle");
    pageTitle.text("Stagiaires");
</script>