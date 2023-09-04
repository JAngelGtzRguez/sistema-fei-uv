<?php
    session_start();
    $user = $_SESSION['usuario'];
    if(!isset($user))
    {
        header('Location: ./index.php');
    }
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
        <title>Menú principal</title>
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
            <?php include('image.php') ?>
        </div>
        <div class="container px-4 py-2" id="hanging-icons">
            <h3 class="pb-2 border-bottom" style="color:#28AD56">Seleccione una opción</h2>
            <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
                <div class="col d-flex align-items-start">
                    <div class="icon-square text-body-emphasis bg-body-secondary d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                            <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                            <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                        </svg>
                    </div>
                <div>
                <h3 class="fs-2 text-body-emphasis" style="color:#18529D">Gestión de claves</h3>
                <p>En este apartado podrá realizar diferentes acciones como: consultar, eliminar, modificar y registar claves.</p>
                <a href="./aulaClase.php" class="btn custom-button text-white" title="Entrar">
                    Entrar
                </a>
            </div>
        </div>
        <div class="col d-flex align-items-start">
            <div class="icon-square text-body-emphasis bg-body-secondary d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-laptop" viewBox="0 0 16 16">
                    <path d="M13.5 3a.5.5 0 0 1 .5.5V11H2V3.5a.5.5 0 0 1 .5-.5h11zm-11-1A1.5 1.5 0 0 0 1 3.5V12h14V3.5A1.5 1.5 0 0 0 13.5 2h-11zM0 12.5h16a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5z"/>
                </svg>
            </div>
            <div>
                <h3 class="fs-2 text-body-emphasis" style="color:#18529D">Préstamo de equipo de cómputo</h3>
                <p>En este apartado podrá registrar el préstamo de cualquier equipo de cómputo o afín.</p>
                <a href="#" class="btn custom-button text-white disabled">
                    Entrar
                </a>
            </div>
        </div>
        <div class="col d-flex align-items-start">
            <div class="icon-square text-body-emphasis bg-body-secondary d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-dpad" viewBox="0 0 16 16">
                    <path d="m7.788 2.34-.799 1.278A.25.25 0 0 0 7.201 4h1.598a.25.25 0 0 0 .212-.382l-.799-1.279a.25.25 0 0 0-.424 0Zm0 11.32-.799-1.277A.25.25 0 0 1 7.201 12h1.598a.25.25 0 0 1 .212.383l-.799 1.278a.25.25 0 0 1-.424 0ZM3.617 9.01 2.34 8.213a.25.25 0 0 1 0-.424l1.278-.799A.25.25 0 0 1 4 7.201V8.8a.25.25 0 0 1-.383.212Zm10.043-.798-1.277.799A.25.25 0 0 1 12 8.799V7.2a.25.25 0 0 1 .383-.212l1.278.799a.25.25 0 0 1 0 .424Z"/>
                    <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v3a.5.5 0 0 1-.5.5h-3A1.5 1.5 0 0 0 0 6.5v3A1.5 1.5 0 0 0 1.5 11h3a.5.5 0 0 1 .5.5v3A1.5 1.5 0 0 0 6.5 16h3a1.5 1.5 0 0 0 1.5-1.5v-3a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 0 16 9.5v-3A1.5 1.5 0 0 0 14.5 5h-3a.5.5 0 0 1-.5-.5v-3A1.5 1.5 0 0 0 9.5 0h-3ZM6 1.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3A1.5 1.5 0 0 0 11.5 6h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a1.5 1.5 0 0 0-1.5 1.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-3A1.5 1.5 0 0 0 4.5 10h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 0 6 4.5v-3Z"/>
                </svg>
            </div>
            <div>
                <h3 class="fs-2 text-body-emphasis" style="color:#18529D">Préstamo de dispositivos para aula de clase</h3>
                <p>En este apartado podrá registar el préstamo de dispositivos para el aula de clase.</p>
                <a href="" class="btn custom-button text-white disabled">
                    Entrar
                </a>
            </div>
        </div>
        <script src="./js/bootstrap.bundle.min.js"></script>
        <script src="./js/jquery-3.7.0.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html>
<?php
    if(isset($message))
    {
        $messageSwal = "";
        if ($message == "error")
        {
            echo "<script> Swal.fire({
                title: '¡Error!',
                icon: 'error',
                html: '<p>Ha ocurrido un error, intente nuevamente.</p>',
                customClass: 
                {
                    confirmButton: 'custom-button'
                }
            }); </script>";
        }
        unset($_SESSION['message']);
    }    
?>