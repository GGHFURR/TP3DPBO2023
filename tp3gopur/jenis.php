<?php

include('config/db.php');
include('classes/DB.php');
include('classes/jenis.php');
include('classes/biji.php');
include('classes/kopi.php');
include('classes/Template.php');

$jenis = new jenis($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$jenis->open();
$jenis->getjenis();

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($jenis->addjenis($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'jenis.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'jenis.php';
            </script>";
        }
    }

    $button = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skindata.html');

$mainTitle = 'Jenis';


$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama jenis</th>
<th scope="row">Aksi</th>
</tr>';


$data = null;
$no = 1;
$formLabel = 'jenis';

while ($div = $jenis->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['nama_jenis'] . '</td>
    <td style="font-size: 22px;">
        <a href="jenis.php?id=' . $div['id_jenis'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="jenis.php?hapus=' . $div['id_jenis'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($jenis->editjenis($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'jenis.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'jenis.php';
            </script>";
            }
        }

        $jenis->getjenisById($id);
        $row = $jenis->getResult();
        $dataUpdate = $row['nama_jenis'];
        $button = 'Simpan';
        $title = 'Edit';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($jenis->deletejenis($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'jenis.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'jenis.php';
            </script>";
        }
    }
}

$jenis->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $button);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->replace('TITLE', $mainTitle);
$view->write();
