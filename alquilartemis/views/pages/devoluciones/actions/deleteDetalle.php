<?php
if (isset($_POST['eliminarDetalle'])) {
    $url = "http://localhost/Alquilartemis/apiRest/controllers/entradaDetalles.php?op=delete";
    $data = array(
        'entrada_detalle_id' => $_POST['entrada_detalle_id']
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    

    $response = curl_exec($ch);
    curl_close($ch);
    print $response;
    print_r($data);

    echo "<script>alert('Detalle devoluciones eliminado');document.location='devoluciones'</script>"; 
}
?>