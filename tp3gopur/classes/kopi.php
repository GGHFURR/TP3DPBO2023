<?php

class kopi extends DB
{
    function getkopiJoin()
    {
        $query = "SELECT * FROM kopi JOIN jenis ON kopi.id_jenis=jenis.id_jenis JOIN biji ON kopi.id_biji=biji.id_biji ORDER BY kopi.id";

        return $this->execute($query);
    }

    function getkopi()
    {
        $query = "SELECT * FROM kopi";
        return $this->execute($query);
    }

    function getkopiById($id)
    {
        $query = "SELECT * FROM kopi 
        JOIN jenis ON kopi.id_jenis = jenis.id_jenis 
        JOIN biji ON kopi.id_biji = biji.id_biji 
        WHERE id = $id 
        ORDER BY kopi.id;
        ";
        return $this->execute($query);
    }

    function searchkopi($keyword)
    {
        $query = "SELECT * FROM kopi
        JOIN jenis ON kopi.id_jenis = jenis.id_jenis
        JOIN biji ON kopi.id_biji = biji.id_biji
        WHERE nama LIKE '%" . $keyword . "%'
        ORDER BY kopi.id;
        ";
        return $this->execute($query);
    }

    function addkopi($data, $file)
    {
        $temp = $file['image']['tmp_name'];
        $images = $file['image']['name'];

        $dir = "assets/images/$images";
        move_uploaded_file($temp, $dir);

        $nama = $data['nama'];
        $jenis = $data['jenis'];
        $biji = $data['biji'];
        $deskripsi = $data['deskripsi'];
        $query = "INSERT INTO kopi VALUES('','$nama', '$jenis', '$biji', '$images', '$deskripsi')";

        return $this->executeAffected($query);
    }

    function editkopi($id, $data, $file)
    {
        $temp = $file['image']['tmp_name'];
        $images = $file['image']['name'];

        $dir = "assets/images/$images";
        move_uploaded_file($temp, $dir);

        $nama = $data['nama'];
        $jenis = $data['jenis'];
        $biji = $data['biji'];
        $deskripsi = $data['deskripsi'];

        $query = "UPDATE kopi SET 
        nama = '$nama',
        id_jenis = '$jenis',
        id_biji = '$biji',
        image = '$images',
        deskripsi = '$deskripsi'
        WHERE id = $id";


        return $this->executeAffected($query);
    }

    function deletekopi($id)
    {
        $query = "DELETE FROM kopi WHERE id= $id";
        return $this->executeAffected($query);
    }
}
