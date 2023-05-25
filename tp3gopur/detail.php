<?php

include('config/db.php');
include('classes/DB.php');
include('classes/jenis.php');
include('classes/biji.php');
include('classes/kopi.php');
include('classes/Template.php');

$kopi = new kopi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$kopi->open();

$data = nulL;

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($kopi->deletekopi($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = '?id=" . $id . "';
            </script>";
        }
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $kopi->getkopiById($id);
        $row = $kopi->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['nama'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['image'] . '" class="img-thumbnail" alt="' . $row['image'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                
                                <tr>
                                    <td>Jenis</td>
                                    <td>:</td>
                                    <td>' . $row['nama_jenis'] . '</td>
                                </tr>
                                <tr>
                                    <td>Jenis Biji</td>
                                    <td>:</td>
                                    <td>' . $row['nama_biji'] . '</td>
                                </tr>
                                <tr>
                                <td>Deskripsi</td>
                                <td>:</td>
                                <td>' . $row['deskripsi'] . '</td>
                            </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="edit.php?id=' . $row['id'] . '"><button type="button" class="btn btn-dark text-white">Ubah Data</button></a>
                <a href="?hapus=' . $row['id'] . '"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

$kopi->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_KOPI', $data);
$detail->write();
