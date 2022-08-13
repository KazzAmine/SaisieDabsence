<?php
require "../includes/config.inc.php";
$tables = '*';
if(isset($_POST['but_export'])){
//Call the core function
backup_tables( $tables);
}
//Core function
function backup_tables( $tables = '*') {
    global $conn;
    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;
    }

    mysqli_query($conn, "SET NAMES 'utf8'");

    //get all of the tables
    if($tables == '*')
    {
        $tables = array();
        $result = mysqli_query($conn, 'SHOW TABLES');
        while($row = mysqli_fetch_row($result))
        {
            $tables[] = $row[0];
        }
    }
    else
    {
        $tables = is_array($tables) ? $tables : explode(',',$tables);
    }

    $return = '';
    //cycle through
    foreach($tables as $table)
    {
        $result = mysqli_query($conn, 'SELECT * FROM '.$table);
        $num_fields = mysqli_num_fields($result);
        $num_rows = mysqli_num_rows($result);

        $return.= 'DROP TABLE IF EXISTS '.$table.';';
        $row2 = mysqli_fetch_row(mysqli_query($conn, 'SHOW CREATE TABLE '.$table));
        $return.= "\n\n".$row2[1].";\n\n";
        $counter = 1;

        //Over tables
        for ($i = 0; $i < $num_fields; $i++) 
        {   //Over rows
            while($row = mysqli_fetch_row($result))
            {   
                if($counter == 1){
                    $return.= 'INSERT INTO '.$table.' VALUES(';
                } else{
                    $return.= '(';
                }

                //Over fields
                for($j=0; $j<$num_fields; $j++) 
                {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = str_replace("\n","\\n",$row[$j]);
                    if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                    if ($j<($num_fields-1)) { $return.= ','; }
                }

                if($num_rows == $counter){
                    $return.= ");\n";
                } else{
                    $return.= "),\n";
                }
                ++$counter;
            }
        }
        $return.="\n\n\n";
    }

    //save file
    $fileName = 'db-dbAbsence-'.date('Y').'.sql';
    $handle = fopen($fileName,'w+');
    fwrite($handle,$return);
    if(fclose($handle)){
        // echo "Done, the file name is: ".$fileName;
        $dbhost1 = 'localhost';
        $dbuser1 = 'root';
        $dbpass1 = '';
        $dbname1 = 'dbAbsence'.date('Y');
        $cnxCreateDb = mysqli_connect($dbhost1,$dbuser1,$dbpass1);

        $sql = "CREATE DATABASE ".$dbname1;
        $cnxCreateDb->query($sql);

        $cnxInsertTables = mysqli_connect($dbhost1,$dbuser1,$dbpass1,$dbname1);
        $commands = file_get_contents($fileName);   
        $cnxInsertTables->multi_query($commands);

        $dbTables = array("stagiaire", "sanction", "sanction","note","appliquer","prendre","absence");
        for($i=0;$i<count($dbTables);$i++){
            $truncateTables = "TRUNCATE TABLE ".$dbTables[$i];
            $conn->query($truncateTables);
        }
     }
        exit; 
    }
     
  
    //TRUNCATE TABLE tablename
   
    require_once 'header.php';
    ?>
    <div class="card card-body">
<form action="" method="POST">
    <h1>Exporter la base de donnés</h1>
    <button type="submit" name="but_export" class="btn btn-outline-primary" id="but_export">export</button>
</form>
</div>
<?php 
require_once 'footer.php';
?>
<script>
    var pageTitle=$("#pageTitle");
    pageTitle.text("Exportation");
</script>