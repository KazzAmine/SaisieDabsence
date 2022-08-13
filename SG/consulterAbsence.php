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
                            <select class="d-inline-block form-select form-select-sm mb-6" id="filiere" name="filiere" >
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
                         <select class="d-inline-block form-select form-select-sm mb-6" id="groupe" name="groupe" >
                                    <!-- les groupes -->
                                   
                            </select>
                        </form>
                        </label>
                        </div>
                       
                    </div>
                    <div class="table-responsive table mt-2" id="dataTableCont" role="grid" aria-describedby="dataTable_info">                   
                         <!-- table des stagiaires -->

                     </div>      
                     <div id="warning">
                            <p>NB: note d'absence est sur /15 pour Les 1er années, et sur /10 pour les 2éme années</p>
                        </div>
            </div>
        </div>
    </div>
</div>
<div id="absenceStagiaire" class='d-none'>
    <div class="container container-fluid">
        <div class="card shadow">
            <div class="card-header py-3">
                <p id="goBack"><- liste stagaire</p>
                <p class="text-primary m-0 fw-bold" id="contname">STAGIAIRE : <span id="stgnom">
                    
                </span> </p>
                
            </div>
            
            <div class="card-body">
                <div id="Absence">
                    <h2 id="absenceTitle">Absence</h2>
                    <button type="button" class="btn btn-primary" id="showCert">ajouter certificat</button>
                    <div id="Certificats">
                     <div class="row d-none" id="certContainer">
                      <form action="">
                          <label for="">Type de justification :</label>
                        <select name="typeJust" id="typeJust">
                        <option value="">--Select--</option>
                            <option value="malade">malade</option>
                            <option value="marriage">marriage</option>
                            <option value="concour">concour</option>
                            <option value="mort">mort</option>
                        </select><br>
                          <label for="">Entrer date debut:</label>
                          <input type="date" id="dateD" name="dateD"> <br>
                          <label for="">Entrer date fin:      </label>
                          <input type="date" id="dateF" name="dateF"> </br>
                          <button type="button" class="btn btn-outline-primary" id="saveCert" name="saveCert">Ajouter</button><br><hr><hr>
                      </form>
                 </div>
                </div>
                    <div id="searchBar">
                        <form method="POST">
                            <label for="">Chercher une absence par date :  </label>
                            <label class="form-label">
                                <input id="txtDateAbs" name="txtDateAbs" placeholder="JJ/MM/AAAA" onfocus="(this.type='date')" onblur="(this.type='text')"/>
                            </label>      
                            <button type="button" name="btnsearch" id="btnsearch" class="offset-2">rechercher</button>
                        </form>
                    </div>
                    <div class="table-responsive table mt-2" id="tableAbsence" role="grid" aria-describedby="dataTable_info"">
                        <!-- table absence -->
                        
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
    pageTitle.text("Consultation d'absence");
</script>