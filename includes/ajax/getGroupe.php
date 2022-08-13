<?php 
  require '../config.inc.php';
  $filiere=$_POST['filiere'];
  $query="SELECT DISTINCT groupe FROM stagiaire WHERE filiere='".$filiere."'";
  $stmt=$conn->query($query);
  echo ' <option value="" disabled selected>Groupe</option>';
  if($stmt->num_rows>0){
      while($row=$stmt->fetch_assoc()){
          echo "<option value='".$row['groupe']."'>".$row['groupe']."</option>";
      }
  }
