<?php

class biji extends DB
{
    function getbiji()
    {
        $query = "SELECT * FROM biji";
        return $this->execute($query);
    }

    function getbijiById($id)
    {
        $query = "SELECT * FROM biji WHERE id_biji=$id";
        return $this->execute($query);
    }

    function addbiji($data)
    {
        $temp = $data['nama'];

        $query = "INSERT INTO biji VALUES('','$temp')";

        return $this->executeAffected($query);
    }

    function editbiji($id, $data)
    {
        $temp = $data['nama'];

        $query = "UPDATE biji SET
            nama= '$temp'
            WHERE id_biji = $id";

        return $this->executeAffected($query);
    }

    function deletebiji($id)
    {
        $query = "DELETE FROM biji WHERE id_biji=$id";
        return $this->executeAffected($query);
    }
}
