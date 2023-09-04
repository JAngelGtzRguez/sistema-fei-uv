<?php
    session_start();
    $user = $_SESSION['usuario'];
    if(isset($_SESSION['message']))
    {   
        $message = $_SESSION['message'];
    }
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
        h3, h4, h5{
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

        .custom-button-r
        {
            background-color: #808080 !important;
            font-family: GillSansRegular;
        }
    </style>
    <body>
        <div class="container px-4">
            <?php include('image.php'); getData();?>
            <h3 class="pb-2 pt-4 border-bottom text-center" style="color:#18529D">Buscar claves</h2>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <div class="row mb-3">
                    <div class="col-sm">
                        <p>Aula:</p> 
                        <div class="input-group mb-3">
                            <input type="text" name="aula" id="aula" class="form-control" placeholder="Ingrese el aula" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        </div>
                    </div>
                    <div class="col-sm"></div>
                    <div class="col-sm">
                        <p>Clave:</p>
                        <div class="input-group mb-3">
                            <input type="text" name="clave" id="clave" class="form-control" placeholder="Ingrese la clave" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        </div>
                    </div>
                    <div class="pt-2">
                        <button type="submit" class="btn custom-button text-white w-25" title="Buscar">
                            Buscar
                        </button>
                        <a class="btn custom-button-r text-white w-25" id="regresar" href="./menuPrincipal.php">
                            Menú principal
                        </a>
                    </div>
                </div>
            </form>
            <div class="row mb-3">
                <div class="col-4"></div>
                <div class="col-4"></div>
                <div class="col-4 text-center">
                    <div class="row ">
                        <div class="col text-end">
                            <p class="pt-2">Registar clave</p>
                        </div>
                        <div class="col">
                            <a class="btn" href="./altaAulaClase.php" title="Registrar clave">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-2">
                <h5 class="card-tittle">Resultados (<?php echo $num_registros; ?>)</h5>
                <?php if($num_registros > 0){ ?>
                    <table class="table table-striped table-bordered table-sm caption-top">
                        <thead>
                            <tr>
                                <th class="w-25 text-center">Aula</th>
                                <th class="w-25 text-center">Clave</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                while($row = $claves->fetch_assoc()) 
                                { ?>
                                    <tr>
                                        <td class='text-center align-middle'>
                                            <?php echo $row['nombre'];?>
                                        </td>
                                        <td class='text-center align-middle'>
                                            <?php echo $row['clave'];?>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn edit" title="Editar clave">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                </svg>
                                            </button>
                                            <button class="btn delete" title="Eliminar clave">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                                </svg>
                                            </button>
                                            <input type="hidden" class="id_aula" value="<?php echo $row['id_aula']; ?>">
                                        </td>
                                    </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="container-fluid col-12">
                        <ul class="pagination pg-dark justify-content-center pb-5 pt-5 mb-0" style="float: none;">
                            <li class="page-item">
                                <?php 
                                    if($_REQUEST["page"]  == "1")
                                    {
                                        $_REQUEST["page"] == "0";
                                    }
                                    else
                                    {
                                        if($pagina > 1)
                                        {
                                            $ant = $_REQUEST["page"] - 1;
                                            echo "<a class='page-link' aria-label='Previous' href='aulaClase.php?page=1'><span aria-hidden='true'>&laquo;</span><span class='sr-only'></span></a>";
                                            echo "<li lcass='page-item'><a class='page-link' href='aulaClase.php?page=". ($pagina-1) ."'>".$ant."</a></li>"; 
                                        }
                                    }
                                    echo "<li class='page-item active'><a class='page-link'>".$_REQUEST["page"]."</a></li>";
                                    $sigui = $_REQUEST["page"] + 1;
                                    $ultima = $num_registros / $registros;
    
                                    if($ultima == $_REQUEST["page"] + 1)
                                    {
                                        $ultima == "";
                                    }
                                    if($pagina<$paginas && $paginas>1)
                                    {
                                        echo "<li class='page-item'><a class='page-link' href='aulaClase.php?page=".($pagina+1)."'>".$sigui."</a></li>";
                                    }
                                    if($pagina<$paginas && $paginas>1)
                                    {
                                        echo "<li class='page-item'><a class='page-link' aria-label='Next' href='aulaClase.php?page=". ceil($ultima) ."'><span aria-hidden='true'>&raquo;</span><span class='sr-only'></span></a></li>";
                                    } 
                                ?>
                            </li>
                        </ul>
                    </div>
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
    <?php
        if(isset($message))
        {
            $messageSwal = "";
            $flag        = false;
            if ($message == "sucessfull")
            {
                $messageSwal = "Clave registrada correctamente.";                                                       
            }
            if ($message == "sucessfullModify")
            {
                $messageSwal = "Clave actualizada correctamente.";
            }
            if ($message == "error")
            {
                $flag = true;
                $messageSwal = "Ha ocurrido un error, intente nuevamente.";
            }
            if ($flag == false) 
            {
                echo "<script> Swal.fire({
                    title: '¡Correcto!',
                        icon: 'success',
                        html: '<p>".$messageSwal."</p>',
                        customClass: 
                        {
                            confirmButton: 'custom-button'
                        }
                    }); </script>";
            }
            else
            {
                echo "<script> Swal.fire({
                    title: '¡Error!',
                    icon: 'error',
                    html: '<p>".$messageSwal."</p>',
                    customClass: 
                    {
                        confirmButton: 'custom-button'
                    }
                }); </script>";
            }
            unset($_SESSION['message']);
        }    
    ?>
</html>

<?php
    function getData()
    {
        try 
        {
            error_reporting(0);
            include ('./conection.php');
            global $claves;
            global $num_registros;
            global $pagina;
            global $registros;
            global $paginas;
            $status     = 1;
            $conn       = conectiondb();
            $whereAula  = "";
            $whereClave = "";
            $clave      = 0;
            if(!empty($_POST))
            {
                $aulasearch   = $_POST['aula'];
                $clavesearch  = $_POST['clave'];
                if(!empty($aulasearch))
                {
                    $whereAula = "AND nombre LIKE '%$aulasearch%'";
                }
                if(!empty($clavesearch))
                {
                    $whereClave = "AND clave LIKE '%$clavesearch%'";
                }
            }

            if(!empty($_REQUEST["page"]))
            {
                $_REQUEST["page"] = $_REQUEST["page"];
            }
            else
            {
                $_REQUEST["page"] = '1';
            }

            if($_REQUEST["page"] == "")
            {
                $_REQUEST["page"] = "1";
            }

            $aula = $conn->prepare("SELECT id_aula,nombre,clave FROM aula WHERE status=? AND clave!=? $whereAula $whereClave ORDER BY nombre ASC");
            $aula->bind_param("ii", $status,$clave);
            $aula->execute();
            $clave = $aula->get_result();
            $aula->close();

            $num_registros  = $clave->num_rows;
            $registros      = '5';
            $pagina         = $_REQUEST["page"];
            if(is_numeric($pagina))
            {
                $inicio = (($pagina-1)*$registros);
            }
            else
            {
                $inicio = 0;
            }
            $aulas = $conn->prepare("SELECT id_aula,nombre,clave FROM aula WHERE status=? AND clave!=? $whereAula $whereClave ORDER BY nombre ASC LIMIT ?,?");
            $aulas->bind_param("iiii", $status,$clave,$inicio,$registros);
            $aulas->execute();
            $claves = $aulas->get_result();
            $aulas->close();
            mysqli_close($conn);
            $paginas = ceil($num_registros/$registros);
        } 
        catch (\Throwable $th) 
        {
            $message = "error";
            session_start();
            $_SESSION['message'] = $message;
            header("Location: ./menuPrincipal.php");
        }
    }
?>

<script>
    $(document).ready(function() 
    {
        $(document).on('click', '.delete', function() 
        {
            const buttonDelete = $(this);
            Swal.fire({
                title: '¿Estás seguro que deseas eliminar el registro?',
                text: "Esta acción no se prodrá revertir.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#18529D',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, eliminar!',
                cancelButtonText: 'Cancelar'
                }).then((result) => {
                if (result.isConfirmed) 
                {
                    var id_aula = buttonDelete.siblings('.id_aula').val();
                    $.ajax({
                        type: "POST",
                        url: "./deleteAula.php",
                        cache: false,
                        data: {id_aula},
                        error:function()
                        {
                            Swal.fire(
                                '¡Oh no!',
                                'Ha ocurrido un error, intente de nuevo, por favor.',
                                'error'
                            );
                        },
                        success: function()
                        {
                            Swal.fire(
                                '¡Registro eliminado!',
                                'El registro ha sido eliminado exitosamente.',
                                'success'
                            );
                            buttonDelete.closest('tr').remove();
                        }
                    });
                }
            });
        })
        .on('click', '.edit', function() 
        {
            const buttonEdit = $(this);
            var id_aula = buttonEdit.siblings('.id_aula').val();
            var form = $('<form id="edit" action="./editarAulaClase.php" method="POST"></form>')
                        .append($('<input type="hidden" name="_method" value="POST">'))
                        .append($('<input type="hidden" name="_token" value="{{ csrf_token() }}">'))
                        .append($('<input type="hidden" name="id_aula">').val(id_aula));
            $(document.body).append(form);
            form.submit();
        });
    });
</script>