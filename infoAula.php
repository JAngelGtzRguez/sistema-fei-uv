<?php
    include ('./conection.php');
    $conn = conectiondb();

    $id_aula    = $_POST['id_aula'];
    $ubicacion  = "";
    $stmt       = $conn->prepare("SELECT ubicacion, descripcion FROM aula WHERE id_aula=?");
    $stmt->bind_param("i", $id_aula);
    $stmt->execute();
    $result = $stmt->get_result();

    $stmt->close();
    mysqli_close($conn);    

    $jsondata = array();

    while($results = $result->fetch_assoc())
    {
        $jsondata["ubicacion"][]   = $results['ubicacion'];
        $jsondata["descripcion"][] = $results['descripcion'];
    }
?>

<?php echo json_encode($jsondata, JSON_FORCE_OBJECT); ?>