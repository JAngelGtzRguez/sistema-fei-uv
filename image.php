<!DOCTYPE html>
<html lang="en">
    <style>    
        @font-face {
            font-family: GillSansRegular;
            src: url(GillSans/Gill\ Sans.otf);
        }
        
        .sansRegular
        {
            font-family: GillSansRegular;
        }

        @media (max-width: 767px)
        {
            .background-green 
            {
                background-color: #28AD56 !important;
                height: 5rem !important;
                align-items: center!important;
            }

            .background-blue
            {
                background-color: #18529D !important;
                height: 8rem !important;
            }
        }

        .background-green 
        {
            background-color: #28AD56;
            height: 1.8rem;
        }

        .background-blue
        {
            background-color: #18529D;
            height: 3.5rem;
        }
    </style>

    <div class="container">
        <div class="row background-green">
            <div class="col">
                <h5 class="text-white sansRegular">Universidad Veracruzana</h5>
            </div>
            <div class="col"></div>
            <div class="col d-flex justify-content-end">
                <h5 class="text-white sansRegular">Facultad de Estadística e Informática</h5>
            </div>
        </div>
        <div class="row background-blue align-items-center">
            <div class="col">
                <h2 class="text-white sansRegular">Aulas y Equipo</h2>
            </div>
            <div class="col d-flex justify-content-end"></div>
            <div class="col d-flex justify-content-end align-items-center">
                <!-- <h5 class="text-white sansRegular"><?php print $user ?></h5> -->
                <h5 class="text-white sansRegular">Jose Angel Gutierrez Rodriguez</h5>
                <a href="./cerrarSession.php" id="closeSession" class="btn rounded-circle" style="color:#FFFFFF" title="Cerrar sesión">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="45" fill="currentColor" class="bi bi-door-closed" viewBox="0 0 16 16">
                        <path d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2zm1 13h8V2H4v13z"/>
                        <path d="M9 9a1 1 0 1 0 2 0 1 1 0 0 0-2 0z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</html>