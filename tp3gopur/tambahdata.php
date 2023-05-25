<?php

include('config/db.php');
include('classes/DB.php');
include('classes/jenis.php');
include('classes/biji.php');
include('classes/kopi.php');
include('classes/Template.php');

$view = new Template('templates/skintambahdata.html');

$kopi = new kopi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$kopi->open();

if (isset($_POST['submit'])) {
    if ($kopi->addkopi($_POST, $_FILES) > 0) {
        echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'index.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'tambah.php';
            </script>";
    }
}




$jenis = new jenis($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$jenis->open();
$jenis->getjenis();
$optionsjenis = null;


while ($row = $jenis->getResult()) {
    $optionsjenis .= "<option value=" . $row['id_jenis'] . ">" . $row['nama_jenis'] . "</option>";
}
$jenis->close();


$biji = new biji($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$biji->open();
$biji->getbiji();
$optionsbiji = null;


while ($row = $biji->getResult()) {

    $optionsbiji .= "<option value=" . $row['id_biji'] . ">" . $row['nama_biji'] . "</option>";
}


$biji->close();

$kopi->close();

$view->replace('OPTIONS_JENIS', $optionsjenis);
$view->replace('OPTIONS_BIJI', $optionsbiji);
$view->replace('TOMBOL_SUBMIT', 'Tambah Data');
$view->replace('MASUKKAN_NAMA_KOPI', 'Masukkan Nama Kopi');
$view->replace('MASUKKAN_DESKRIPSI', 'Masukkan Deskripsi');
$view->write();
