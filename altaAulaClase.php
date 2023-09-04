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
        <link rel="stylesheet" href="./css/select2.css">
        <title>Alta de aula de clase</title>
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
        h3
        {
            font-family: GillSansBold;
        }
        
        p
        {
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

        .select2-selection
        {
            border: 1px solid #ced4da !important;
        }

        .borderRed
        {
            --tw-border-opacity: 1 !important;
            border-color: rgba(239, 68, 68, var(--tw-border-opacity)) !important;
        }

        .borderGreen
        {
            --tw-border-opacity: 1 !important;
            border-color: rgba(16, 185, 129, var(--tw-border-opacity)) !important;
        }
    </style>
    <body>
        <?php include('image.php'); getDataAulas();?>
        <div class="container px-4 py-5">
            <h3 class="pb-2 border-bottom text-center" style="color:#18529D">Registrar clave</h2>
            <form action="registrarClave.php" method="post" id="form">
                <div class="row mb-3">
                    <div class="col-sm">
                        <p>¿A que aula asociará la clave?</p> 
                        <div class="input-group mb-3">
                            <select name="aula" id="aula" multiple="multiple" class="form-control aula">
                                <?php while($aulas = $aula->fetch_assoc()) { ?>
                                    <option value="<?php echo $aulas['id_aula']; ?>"><?php echo $aulas['nombre']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm"></div>
                    <div class="col-sm">
                        <p>Escriba la clave que se asociará con el aula</p>
                        <div class="input-group mb-3">
                            <input type="number" name="clave" id="clave" class="form-control" placeholder="Ingrese la clave" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm py-2">
                        <p>Ubicación del aula</p>
                        <div class="input-group mb-3">
                            <select name="ubicacion" multiple="multiple" id="ubicacion" class="form-control ubicacion" disabled>    
                                <option value="1">Edificio A</option>
                                <option value="2">Edificio B</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm"></div>
                    <div class="col-sm py-2">
                        <p>Descripción</p>
                        <div class="input-group mb-3">
                            <textarea name="descripcion" id="description" placeholder="Ingrese una descripción" class="form-control" cols="30" rows="4" aria-label="Recipient's username" aria-describedby="basic-addon2" disabled></textarea>
                        </div>
                    </div>
                    <div class="pt-5 text-center">
                        <button class="btn custom-button text-white w-25" id="enviar">
                            Registrar
                        </button>
                        <a class="btn custom-button-r text-white w-25" id="regresar" href="./aulaClase.php">
                            Regresar
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <script src="./js/bootstrap.bundle.min.js"></script>
        <script src="./js/jquery-3.7.0.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="./js/select2.js"></script>
        <script src="./js/i18n/es.js"></script>
    </body>
</html>

<?php
    function getDataAulas()
    {
        include ('./conection.php');
        $conn = conectiondb();
        global $aula;

        $stmt = $conn->prepare("SELECT id_aula, nombre FROM aula WHERE status = 0");
        $stmt->execute();
        $aula = $stmt->get_result();
        $stmt->close();
        mysqli_close($conn);
    }
?>

<script>
    $(document).ready(function() 
    {
        $("#aula").select2({
            language: "es",
            placeholder: "Ingrese el aula",
            allowClear: true,
            maximumSelectionLength: 1
        });

        $("#ubicacion").select2({
            language: "es",
            placeholder: "Ingrese la ubicación",
            allowClear: true,
            maximumSelectionLength: 1
        });

        $("#enviar").on("click", function(e) 
        {
            e.preventDefault();
            validarFormulario();
        });
        $( "#aula" ).on( "change", function()
        {
            var id_aula = $("#aula option:selected").val();
            if(id_aula != undefined)
            {
                $.ajax({
                    type: "POST",
                    url: "./infoAula.php",
                    cache: false,
                    data: {id_aula},
                    dataType: 'json',
                    error:function()
                    {
                        Swal.fire('¡Oh no!', 'Ha ocurrido un error, intente de nuevo, por favor.', 'error');
                    },
                    success: function(data)
                    {
                        $('#ubicacion').append($('<option value="'+data['ubicacion'][0]+'"selected>'+data['ubicacion'][0]+'</option>')).trigger('change');
                        $('#description').text(data['descripcion'][0]).val(data['descripcion'][0]).trigger('change');;
                    }
                });
            }
            else
            {
                $('#ubicacion').val(null).trigger('change');
                $('#description').val('').text('').trigger('change');;
            }
        });
    });

    function validarFormulario() 
    {
        var aula        = $('.aula option:selected').val();
        var clave       = $('#clave').val();
        var edificio    = $('.ubicacion option:selected').val();
        var description = $('#description').val();

        $('.aula').siblings('.select2').find('.select2-selection').removeClass("borderRed borderGreen");
        $('#clave').removeClass("borderRed borderGreen");
        $('.ubicacion').siblings('.select2').find('.select2-selection').removeClass("borderRed borderGreen");
        $('#description').removeClass("borderRed borderGreen");

        if(aula == undefined && clave == "" && edificio == undefined && description == "")
        {
            Swal.fire({
                icon: 'error',
                html: '<p>Todos los campos son obligatorios.</p>',
                customClass: 
                {
                    confirmButton: 'custom-button'
                }
            })
            $('.aula').siblings('.select2').find('.select2-selection').addClass("borderRed");
            $('#clave').addClass("borderRed");
            $('.ubicacion').siblings('.select2').find('.select2-selection').addClass("borderRed");
            $('#description').addClass("borderRed");
            return false;
        }

        var error = false;
        if(aula == undefined || clave == "" || edificio == undefined || description == "")
        {
            if(aula == undefined)
            {
                $('.aula').siblings('.select2').find('.select2-selection').addClass("borderRed");
                error = true;
            }
            else
            {
                $('.aula').siblings('.select2').find('.select2-selection').addClass("borderGreen");
            }

            if(clave == "")
            {
                $('#clave').addClass("borderRed");
                error = true;
            }
            else
            {
                $('#clave').addClass("borderGreen");
            }

            if(edificio == undefined)
            {
                $('.ubicacion').siblings('.select2').find('.select2-selection').addClass("borderRed");
                error = true;
            }
            else
            {
                $('.ubicacion').siblings('.select2').find('.select2-selection').addClass("borderGreen");
            }

            if(description == "")
            {
                $('#description').addClass("borderRed");
                error = true;
            }
            else
            {
                $('#description').addClass("borderGreen");
            }
        }

        if(error == true)
        {
            Swal.fire({
                icon: 'error',
                html: '<p>Algunos campos están vacíos, por favor verifique su información.</p>',
                customClass: 
                {
                    confirmButton: 'custom-button'
                }
            })
            return false;
        }
        else
        {
            $('.aula').siblings('.select2').find('.select2-selection').addClass("borderGreen");
            $('#clave').addClass("borderGreen");
            $('.ubicacion').siblings('.select2').find('.select2-selection').addClass("borderGreen");
            $('#description').addClass("borderGreen");
            $("#form").submit();
        }
    }
</script>