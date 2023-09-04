<?php
    function conectiondb()
    {
        $host="35.238.98.240";
        $port=3306;
        $socket="";
        $user="root";
        $password="SCARLET45hunters";
        $dbname="sistema_claves";
        $conn = new mysqli($host, $user, $password, $dbname, $port, $socket);
        return $conn;        
    }
?>