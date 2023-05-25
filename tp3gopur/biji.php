<?php

include('config/db.php');
include('classes/DB.php');
include('classes/biji.php');
include('classes/Template.php');

$biji = new biji($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$biji->open();
$biji->getbiji();

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($biji->addbiji($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'biji.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'biji.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skindata.html');

$mainTitle = 'Biji';

$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Biji</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'Biji';

while ($div = $biji->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['nama_biji'] . '</td>
    <td style="font-size: 22px;">
        <a href="biji.php?id=' . $div['id_biji'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="biji.php?hapus=' . $div['id_biji'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($biji->editbiji($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'biji.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'biji.php';
            </script>";
            }
        }

        $biji->getbijiById($id);
        $row = $biji->getResult();

        $dataUpdate = $row['nama_biji'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($biji->deletebiji($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'biji.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'biji.php';
            </script>";
        }
    }
}

$biji->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->replace('TITLE', $mainTitle);
$view->write();
