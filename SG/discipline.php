<?php 
require_once 'header.php';
?>
<div class="container navForm px-1 py-5 mx-auto">
<div class="row d-flex  justify-content-center" >
        <div class="text-center"  >
            <div class="cardd card">
                <div class="form-card">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Ajouter</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">comportement</button>
                          </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                              
                            <div class="row justify-content-between text-left">

                            <div class="col-md-4 text-nowrap">
                        <div id="dataTable_length" class="dataTables_length"  aria-controls="dataTable"><label class="form-label">
                            <form method="POST">
                            <input type="date" name="date" id="date">

                            <select class="d-inline-block form-select form-select-sm mb-6" id="filiereAbs" name="filiereAbs" >
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

                        <select class="d-inline-block form-select form-select-sm mb-6 mt-4" id="group" name="groupe">          
                                    <!-- les groupes -->
                                  
                            </select>
                        </form>
                        </label>
                        </div>
                    </div>
                    <div class="table-responsive table mt-2" id="dataTableCon" role="grid" aria-describedby="dataTable_info">                   
                         <!-- table d'absence -->
                                    
                     </div>    
                     <button type="button" id="btnSaveAbsence" class="btn btn-outline-dark">Enregistrer</button>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                           <form id="formComp">
                               
                                <div id="recherchConatainer" class="form-group col-sm-6 flex-column d-flex"> 
                                        <div class="text-md-end dataTables_filter" id="dataTable_filter">
                                                <label class="form-label">
                                                    <input type="search" id="txtCef" class="form-control form-control-sm" name="txtCef" placeholder="CEF" required> 
                                                </label>
                                        </div>
                                    <button type="button" id="btnFind" name="btnFind">rechercher <i class="fa fa-search" aria-hidden="true"></i> </button>
                                </div>
                                
                               <div id="stginfo">
                                   <!-- information du stagiaire -->

                               </div>

                               <div id="compContainer">
                                <!-- historique comportement -->

                               </div>                                
                                <div id="cont" class="d-none">
                                 <label for="motifArea">Description de motif:</label> <textarea name="motifArea" id="motifArea" cols="20" rows="3"></textarea>
                                
                                </div>
                                <button class="d-none" type="button" id="btnsubmit" name="btnsubmit">Validé</button>
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
    pageTitle.text(" discipline");
</script>