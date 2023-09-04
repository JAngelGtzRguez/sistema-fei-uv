<?php
    include ('./conection.php');
    $conn = conectiondb();

    $id_aula = $_POST['id_aula'];
    $clave   = 0;
    $status  = 0;
    $stmt    = $conn->prepare("UPDATE aula SET clave=?, status=? WHERE id_aula=?");
    $stmt->bind_param("iii", $clave, $status, $id_aula);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    mysqli_close($conn);
?>