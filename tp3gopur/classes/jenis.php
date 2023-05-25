<?php

class jenis extends DB
{
    function getjenis()
    {
        $query = "SELECT * FROM jenis";
        return $this->execute($query);
    }

    function getjenisById($id)
    {
        $query = "SELECT * FROM jenis WHERE id_jenis=$id";
        return $this->execute($query);
    }

    function addjenis($data)
    {
        $temp = $data['nama'];

        $query = "INSERT INTO jenis VALUES('','$temp')";

        return $this->executeAffected($query);
    }

    function editjenis($id, $data)
    {
        $temp = $data['nama'];

        $query = "UPDATE jenis SET
            nama= '$temp'
            WHERE id_jenis = $id";

        return $this->executeAffected($query);
    }

    function deletejenis($id)
    {
        $query = "DELETE FROM jenis WHERE id_jenis=$id";
        return $this->executeAffected($query);
    }
}
