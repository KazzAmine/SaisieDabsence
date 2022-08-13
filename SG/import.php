<?php
require "../includes/config.inc.php";
$count=11;
if(isset($_POST['but_import'])){
   $target_dir = "D:/";
   $target_file = $target_dir . basename($_FILES["importfile"]["name"]);

   $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

   $uploadOk = 1;
   if($imageFileType != "csv" ) {
     $uploadOk = 0;
   }

   if ($uploadOk != 0) {
      if (move_uploaded_file($_FILES["importfile"]["tmp_name"], $target_dir.'importfile.csv')) {

        // Checking file exists or not
        $target_file = $target_dir . 'importfile.csv';
        //$fileexists = 0;
        /*if (file_exists($target_file)) {
           $fileexists = 1;
        }*/
        if (file_exists($target_file)) {
           // Reading file
           $file = fopen($target_file,"r");
           $i = 0;
           $importData_arr = array();
                       
            while (($data = fgetcsv($file, 10000, ",")) !== FALSE) {
                $data = array_map("utf8_encode", $data);
                $num = count($data);
             
                for ($c=0; $c < $num; $c++) {
                    $importData_arr[$i][] = mysqli_real_escape_string($conn, $data[$c]);
                }
                $i++;
           }
           fclose($file);

           $skip = 0;
           // insert import data
           foreach($importData_arr as $data){
              if($skip != 0){
                 $Dept = $data[0];
                 $Code_EFP = $data[1];
                 $EFP = $data[2];
                 $Niveau = $data[3];
                 $Code_Filiere = $data[4];
                 $Filiere = $data[5];
                 $Type_Formation = $data[6];
                 $Groupe = $data[7];
                 $Annee_etude = $data[8];
                 $Numero_stagiaire = $data[9];
                 $Nom = $data[10];
                 $Prénom = $data[11];

               //   Checking duplicate entry
                 $sql = "SELECT count(*) as allcount from stagiaire WHERE cef='".$Numero_stagiaire."'";
                 $retrieve_data = $conn->query($sql);
                 $row = mysqli_fetch_array($retrieve_data);
                 $count = $row['allcount'];
                
                 if($count == 0){
                        //   Insert record
                        $insert_query = "INSERT INTO `stagiaire`(`dep`, `code_efp`, `efp`, `niveau`, `code_filiere`, `filiere`, `type_formation`, `groupe`, `annee_etude`, `cef`, `nom`, `prenom`)  values('".$Dept."','".$Code_EFP."','".$EFP."','".$Niveau."','".$Code_Filiere."','".$Filiere."','".$Type_Formation."','".$Groupe."','".$Annee_etude."','".$Numero_stagiaire."','".$Nom."','".$Prénom."')";
                        mysqli_query($conn,$insert_query);
                        if($Annee_etude=='1ère année'){
                           $insert_note="INSERT INTO `note`( `cef`, `note_comportement`, `note_assiduite`) VALUES ('".$Numero_stagiaire."',5,15);";
                          mysqli_query($conn,$insert_note);
                        }else if($Annee_etude=='2ème année'){
                           $insert_note="INSERT INTO `note`( `cef`, `note_comportement`, `note_assiduite`) VALUES ('".$Numero_stagiaire."',5,10);";
                           mysqli_query($conn,$insert_note);
                        }                       
                 }        
              }
              $skip ++;
           }
           $newtargetfile = $target_file;
           if (file_exists($newtargetfile)) {
              unlink($newtargetfile);
           }
         }

      }
   }
}

require_once 'header.php';
?>
<div class="card card-body">
   <div id="wholeWraper" class="popup_import">
      <h1>Importer la base de donnés</h1>
         <form method="post" action="" enctype="multipart/form-data" id="import_form">
            <input type='file' name="importfile" id="importfile"><br>
            <input type="submit" id="but_import" class="btn btn-outline-primary" name="but_import" value="Import">
         </form>    
   </div>
   <div id="instruction">
      <p>le Format du fichier doit être .CSV</p>
   </div>
</div>
<?php 
require_once 'footer.php';
?>
<script>
     var pageTitle=$("#pageTitle");
    pageTitle.text("Importation");
</script>
