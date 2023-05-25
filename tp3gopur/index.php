<?php

include('config/db.php');
include('classes/DB.php');
include('classes/jenis.php');
include('classes/biji.php');
include('classes/kopi.php');
include('classes/Template.php');


$listkopi = new kopi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);


$listkopi->open();
$listkopi->getkopiJoin();


if (isset($_POST['btn-cari'])) {

    $listkopi->searchkopi($_POST['cari']);
} else {
    $listkopi->getkopiJoin();
}

$data = null;


while ($row = $listkopi->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 kopi-thumbnail">
        <a href="detail.php?id=' . $row['id'] . '">
        
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['image'] . '" class="card-img-top" alt="' . $row['image'] . '">
            </div>
            <div class="card-body">
                <p class="card-text my-2 kopi-nama">' . $row['nama'] . '</p>
                <p class="card-text jenis-nama">' . $row['nama_jenis'] . '</p>
                <p class="card-text biji-nama">' . $row['nama_biji'] . '</p>
                
            </div>
        </a>
    </div>    
    </div>';
}


$listkopi->close();


$home = new Template('templates/skin.html');


$home->replace('DATA_KOPI', $data);
$home->write();
