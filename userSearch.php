<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if ($_POST['user'] != '' && $_POST['password'] != '') 
        {
            // Datos de autenticación
            $user       = $_POST['user'];
            $password   = $_POST['password'];

            include ('./conection.php');
            $conn = conectiondb();
            global $result;
    
            $stmt = $conn->prepare("SELECT nombre, apellido_materno, apellido_paterno, rol FROM maestro WHERE correo_institucional=? AND password=?");
            $stmt->bind_param("ss", $user, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            $stmt->close();
            mysqli_close($conn);

            if($result)
            {
                while($row = $result->fetch_array())
                {
                    $fullname           = $row['nombre']." ".$row['apellido_paterno']." ".$row['apellido_materno'];
                    $usersuccesful      = $_POST['user'];
                    $passwordsuccesful  = $_POST['password']; 
                    $proffesor_rol      = $row['rol'];
                }
            }
            else 
            {
                session_start();
                $_SESSION["message"]="no_login";
                header("Location: ./index.php");
                die();
            }

            if(isset($usersuccesful) && isset($passwordsuccesful) && isset($proffesor_rol))
            {
                if($proffesor_rol == 1)
                {
                    session_start();
                    $_SESSION["usuario"]=$fullname;
                    header("Location: ./menuPrincipal.php");
                    die();
                }
                else if($proffesor_rol == 2)
                {
                    session_start();
                    $_SESSION["usuario"]=$fullname;
                    header("Location: ./aulaClaseMaestros.php");
                    die();
                }
                else
                {
                    session_start();
                    $_SESSION["message"]="error";
                    header("Location: ./index.php");
                    die();
                }
            }
            else
            {
                session_start();
                $_SESSION["message"]="no_login";
                header("Location: ./index.php");
                die();
            }
        }
        else
        {
            session_start();
            $_SESSION["message"]="no_login";
            header("Location: ./index.php");
            die();
        }
    }
    else
    {
        session_start();
        $_SESSION["message"]="error";
        header("Location: ./index.php");
        die();
    }
?>