<?php
    try 
    {
        include ('./conection.php');
        $conn = conectiondb();

        global $message;
        $clave          = $_POST['clave'];
        $description    = $_POST['descripcion'];
        $id_aula        = $_POST['id_aula'];
        $stmt = $conn->prepare("UPDATE aula SET clave=?, descripcion=? WHERE id_aula=$id_aula");
        $stmt->bind_param("is", $clave, $description);
        $stmt->execute();
        $stmt->get_result();

        if($stmt->affected_rows >= 0)
        {
            $message = "sucessfullModify";
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