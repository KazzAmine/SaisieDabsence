<?php
require_once '../config.inc.php';

$id=$_POST["id"];

$sql="UPDATE `sanction` SET `signer`=1 WHERE id_sanction=".$id."";
if ($conn->query($sql)===true) {
    echo 'succes';
}
else
{
    echo 'fail';
}
 

?>