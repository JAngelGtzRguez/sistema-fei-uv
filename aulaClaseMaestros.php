<?php
    session_start();
    $user = $_SESSION['usuario'];
    if(!isset($user))
    {
        header('Location: ./index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <title>Consulta de aulas</title>
    </head>
    <style>
        @font-face {
            font-family: GillSansBold;
            src: url(GillSans/Gill\ Sans\ Bold.otf);
        }
        @font-face {
            font-family: GillSansRegular;
            src: url(GillSans/Gill\ Sans.otf);
        }
        h3, h4{
            font-family: GillSansBold;
        }
        p{
            font-family: GillSansRegular;
        }

        .custom-button 
        {
            background-color: #28AD56 !important;
            font-family: GillSansRegular;
        }
    </style>
    <body>
        <div class="container px-4">
            <?php include('image.php'); getData(); ?>
            <h3 class="pb-2 pt-4 border-bottom text-center" style="color:#18529D">Buscar aula</h2>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <div class="row mb-3">
                    <div class="col-sm"></div>
                    <div class="col-sm">
                        <p>Aula:</p> 
                        <div class="input-group mb-3">
                            <input type="text" name="aula" id="aula" class="form-control" placeholder="Ingrese el aula" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        </div>
                    </div>
                    <div class="col-sm"></div>
                    <div class="pt-2 text-center">
                        <button type="submit" class="btn custom-button text-white w-25" title="Buscar">
                            Buscar
                        </button>
                    </div>
                </div>
            </form>
            <div class="pt-2">
                <?php if($result->num_rows > 0){ ?>
                    <table class="table table-striped table-bordered table-sm caption-top">
                        <thead>
                            <tr>
                                <th class="w-25 text-center">Aula</th>
                                <th class="w-25 text-center">Clave</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                while($row = $result->fetch_assoc()) 
                                { ?>
                                    <tr>
                                        <td class='text-center align-middle'>
                                            <?php echo $row['nombre'];?>
                                        </td>
                                        <td class='text-center align-middle'>
                                            <?php echo $row['clave'];?>
                                        </td>
                                    </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>  
                    <div class="alert alert-danger text-center" role="alert">
                        No se encontaron coincidencias.
                    </div>
                <?php } ?>  
            </div>
        </div>
        <script src="./js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="./js/jquery-3.7.0.js"></script>
    </body>
</html>

<?php
    function getData()
    {
        try 
        {
            error_reporting(0);
            include ('./conection.php');
            global $result;
            $status     = 1;
            $conn       = conectiondb();
            $whereAula  = "";
            $clave      = 0;
            if(!empty($_POST))
            {
                $aula   = $_POST['aula'];
                if(!empty($aula))
                {
                    $whereAula = "AND nombre LIKE '%$aula%'";
                }
            }
            $stmt = $conn->prepare("SELECT id_aula,nombre,clave FROM aula WHERE status=? AND clave!=? $whereAula  ORDER BY nombre ASC LIMIT 5");
            $stmt->bind_param("ii", $status, $clave);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            mysqli_close($conn);
        } 
        catch (\Throwable $th) 
        {
            $message = "error";
            session_start();
            $_SESSION['message'] = $message;
            header("Location: ./index.php");
        }
    }
?>