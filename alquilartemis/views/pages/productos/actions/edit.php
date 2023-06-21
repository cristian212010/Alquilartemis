<?php 
if (isset($_POST['editProducto'])) {
  $url = "http://localhost/Alquilartemis/apirest/controllers/productos.php?op=GetId";
  $data = array(
      'producto_id' => $_POST['edit']
  );
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  
  $response = curl_exec($ch);
  curl_close($ch);
  
  $productos = json_decode($response, true);
  $producto = $productos[0];

?>
<form action="" method="post">
            <div>
                <label for="">nombre</label>
                <input type="text" name="nombre_editado" value="<?php echo $producto['nombre']; ?>">
            </div>
            <div>
                <label for="">descripcion</label>
                <input type="text" name="descripcion_editado" value="<?php echo $producto['descripcion']; ?>">
            </div>
            <div>
                <label for="">precio</label>
                <input type="number" name="precio_editado" value="<?php echo $producto['precio']; ?>">
            </div>
            <div>
                <label for="">stock</label>
                <input type="number" name="stock_editado" value="<?php echo $producto['stock']; ?>">
            </div>
            <div>
                <label for="">categoria</label>
                <input type="text" name="categoria_editado" value="<?php echo $producto['categoria']; ?>">
            </div>
            
           
            <input type="hidden" name="editando_id" value="<?php echo $producto['producto_id']; ?>">
            <input type="submit" value="Editar producto" name="editarProducto">
        </form>
<?php } ?>
<?php
if (isset($_POST['editarProducto'])) {
    $url = "http://localhost/Alquilartemis/apiRest/controllers/productos.php?op=update";
    $data = array(
        'producto_id' => $_POST['editando_id'],
        'nombre' => $_POST['nombre_editado'], 
        'descripcion' => $_POST['descripcion_editado'],
        'precio' => $_POST['precio_editado'],
        'stock' => $_POST['stock_editado'],
        'categoria' => $_POST['categoria_editado'],
       
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($ch);
    curl_close($ch);
    print $response;

    echo "<script>alert('producto editado');document.location='productos'</script>";
}


?>


      