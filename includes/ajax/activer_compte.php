<?php
require_once '../config.inc.php';

$mat=$_POST["mat"];

$sql="UPDATE `personnel` SET `is_active`=1 WHERE mat='".$mat."'";
if ($conn->query($sql)===true) {
    echo 'succes';
}
else
{
    echo 'fail';
}
 

?>