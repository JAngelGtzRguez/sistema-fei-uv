<?php
    try 
    {
        include ('./conection.php');
        $conn = conectiondb();

        global $message;
        $id_aula        = $_POST['aula'];
        $clave          = $_POST['clave'];
        $status         = 1;
        $stmt = $conn->prepare("UPDATE aula SET clave=?, status=? WHERE id_aula=?;");
        $stmt->bind_param("iii", $clave, $status, $id_aula);
        $stmt->execute();
        $stmt->get_result();

        if($stmt->affected_rows > 0)
        {
            $message = "sucessfull";
        }
        session_start();
        $_SESSION['message'] = $message;
        header("Location: ./aulaClase.php");
        $stmt->close();
        mysqli_close($conn);
    } 
    catch (\Throwable $th) 
    {
        $message = "error";
        session_start();
        $_SESSION['message'] = $message;
        header("Location: ./aulaClase.php");
    }
?>