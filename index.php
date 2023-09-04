<?php
    session_start();
    if(isset($_SESSION['message']))
    {
        $message = $_SESSION['message'];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <title>Inicio de sesión</title>
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

        h2, h4
        {
            font-family: GillSansBold;
        }

        p{
            font-family: GillSansRegular;
        }

        @media only screen and (max-width: 576px) {
            .form 
            {
                padding-top: 10rem;
            }
        }

        .custom-button 
        {
            background-color: #28AD56 !important;
        }

        .btn 
        {
            background-color: #18529D !important;
        }

        .borderRed
        {
            --tw-border-opacity: 1;
            border-color: rgba(239, 68, 68, var(--tw-border-opacity));
        }

        .borderGreen
        {
            --tw-border-opacity: 1;
            border-color: rgba(16, 185, 129, var(--tw-border-opacity));
        }

        .imgLogin 
        {
            width: 50%;
            height: 100%;
            position: fixed;
        }

        .pleca 
        {
            background: #0D47A1;
            color: #fff;
            font-size: 18px;
            font-weight: normal;
            height: 2em;
            padding-right: 2em;
            padding-left: 2em;
        }

        .float-right 
        {
            float: right!important;
        }

        a 
        {
            color: #007bff;
            text-decoration: none;
            background-color: transparent;
            -webkit-text-decoration-skip: objects;
            font-family: GillSansRegular;
        }

        #colImg 
        {
            padding-left: 0;
        }

        img 
        {
            vertical-align: middle;
            border-style: none;
        }

        @media (min-width: 768px)
        {
            .col-md-6 {
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 50%;
            }

            .col-md-12 {
                -ms-flex: 0 0 100%;
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        @media (max-width: 767px)
        {
            #colImg {
                display: none;
            }
        }

        @media (max-width: 767px)
        {
            .text
            {
                padding-left: 6.3rem !important;
            }
        }

        .text
        {
            padding-left: 10.625rem;
        }
    </style>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6" id="colImg">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="image_login.jpg" class="imgLogin row">
                        </div>
                    </div>
                </div>               
                <div id="divIzq" class="col-sm-12 col-md-6">
                    <div class="row float-right">
                        <div class="pleca">
                            <a href="https://www.uv.mx" style="color:#ffffff;">Universidad Veracruzana</a>
                        </div>
                    </div>
                    <div style="width: 100%; height: 100%; display: table;">
                        <div style="display: table-cell; vertical-align: middle;" class="pt-4">
                            <h2 class="text-center pt-4" style="color:#18529D">Sistema de Gestión de Claves y Préstamo de Equipo (SGCPE)</h2>
                            <h4 class="text-center">Facultad de Estadística e Informática</h4>
                            <h2 class="text-center">Inicio de sesión</h2>
                            <form action="userSearch.php" method="post" id="form">
                                <div class="row justify-content-center">
                                    <div>
                                        <p class="h-3 text">Cuenta/correo institucional:</p>
                                    </div>                                    
                                    <div class="input-group mb-3" style="width: 50%">
                                        <input type="text" name="user" id="user" class="form-control" placeholder="Ingrese su correo o cuenta institucional" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    </div>
                                    <div>
                                        <p class="h-3 text">Contraseña:</p>
                                    </div>
                                    <div class="input-group mb-3" style="width: 50%">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Ingrese su contraseña" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    </div>
                                    <div class="text-center pt-5">
                                        <button type="submit" name="enviar" id="enviar" class="btn btn-primary">Iniciar sesión</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="./js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="./js/jquery-3.7.0.js"></script>
    </body>
    <?php
        if (isset($message)) 
        {
            $text_error = "";
            if($message == "no_exist")
            {
                $text_error = "La cuenta institucional no pertenece a la Facultad de Estadística e Infomática.";
            }

            if($message == "no_login")
            {
                $text_error = "Correo/cuenta o contraseña incorrecta, favor de verificar.";
            }

            if($message == "error")
            {
                $text_error = "Ha ocurrido un problema, intente de nuevo, si el problema persiste contacte a soporte.";
            }
            
            if($text_error !="")
            {
                echo "<script> Swal.fire({
                        icon: 'error',
                        html: '<p>".$text_error."</p>',
                        customClass: 
                        {
                            confirmButton: 'custom-button'
                        }
                    }); </script>";
            }
            session_destroy();
        }
    ?>
</html>

<script>
    $(document).ready(function() 
    {
        $("#enviar").on("click", function(e) 
        {
            e.preventDefault();
            validarFormulario();
        })
    
        $('#user').on("change", function() 
        {
            $(this).removeClass("borderGreen borderRed")
        });
    
        $('#password').on("change", function() 
        {
            $(this).removeClass("borderGreen borderRed")
        });
    });

    function validarFormulario() 
    {
        var usuario = $('#user').val();
        var clave = $('#password').val();
        if(usuario.length == 0) 
        {
            Swal.fire({
                icon: 'error',
                html: '<p>Es necesario ingresar su correo/cuenta institucional.</p>',
                customClass: 
                {
                    confirmButton: 'custom-button'
                }
            })
            $('#user').addClass("borderRed");
            return false;
        }
        else 
        {
            $('#user').addClass("borderGreen");   
        }
        if (clave.length == 0) 
        {
            Swal.fire({
                icon: 'error',
                html: '<p>Es necesario ingresar su password.</p>',
                customClass: 
                {
                    confirmButton: 'custom-button'
                }
            })
            $('#password').addClass("borderRed");
            return false;
        }
        else 
        {
            $('#password').addClass("borderGreen");   
        }
        $("#form").submit();
    }
</script>