<?php
require_once '../config.inc.php';

try {
    $cef=$_POST["cef"];
$conn->begin_transaction();
$sql="DELETE FROM `stagiaire` WHERE cef='".$cef."'";
$conn->query($sql);

$sql1="DELETE FROM `absence` WHERE id_stagiaire='".$cef."'";
$conn->query($sql1);

$sql2="DELETE FROM `note` WHERE cef='".$cef."'";
$conn->query($sql2);
echo 'succes';

$conn->commit();
}catch(Exception $ex){
    $conn->rollback();
    echo $ex->getMessage();
}
 