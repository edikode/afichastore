<?php
require("../../../functions/koneksi.php");
$updateRecordsArray = $_POST['recordsArray'];
$Tabel = $_POST['tabel'];
$sortir = $_POST['sortir'];
$lokasi = $_POST['lokasi'];
$id = $_POST['id'];

$listingCounter = 1;
foreach ($updateRecordsArray as $recordIDValue) {    
    execSQL("UPDATE blok SET sortir = ? WHERE blok_id = ? and lokasi = ?", array("iis", $listingCounter, $recordIDValue, $lokasi), true);
    $listingCounter = $listingCounter + 1;
}
?>