<?php

use App\Propiedad;

    require '../../includes/app.php';
    
    estarAutenticado();

    $id= $_GET['id'];
    $id = filter_var($id,FILTER_VALIDATE_INT);

    if(!$id){
        header('Localtion: /admin');
    }

    $propiedad = Propiedad::find($id);

    $consulta = "SELECT * FROM vendedores";
    $vendedores = mysqli_query($db,$consulta);

    $errores = [];
    $titulo = $propiedad->titulo;
    $precio = $propiedad->precio;
    $descripcion = $propiedad->descripcion;
    $habitaciones = $propiedad->habitaciones;
    $wc = $propiedad->wc;
    $estacionamiento = $propiedad->estacionamiento;
    $vendedorId = $propiedad->vendedorId;
    $imagenPropiedad = $propiedad->imagen;

    if ( $_SERVER['REQUEST_METHOD'] === 'POST' ){

        $args=$_POST['propiedad'];

        $propiedad->sincronizar($args);

        $imagen=$_FILES['imagen'];

        
       
        if(!$titulo){
            $errores [] ="Debes añadir un titulo";
        }

        if(!$precio){
            $errores [] ="Debes añadir un precio";
        }

        if(strlen($descripcion) < 50){
            $errores [] ="La descripcion es obligatoria y tiene que tener 50 caracteres";
        }

        if(!$habitaciones){
            $errores [] ="Debes añadir las habitaciones";
        }

        if(!$wc){
            $errores [] ="Debes añadir los baños";
        }

        if(!$estacionamiento){
            $errores [] ="Debes añadir los estacionamiento";
        }
        if (empty($vendedorId)){
            $errores [] ="Debes seleccionar un vendedor";
        }
        $medida=1000*1000;
        if($imagen['size']>$medida){
            $errores[] = "La imagen es muy pesada";
        }
        //Insertar en la Base de Datos
        if(empty($errores)){
            $carpetaImagenes='../../imagenes/';
            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }
            $nombreImagen='';
            if($imagen['name']){
                echo $carpetaImagenes.$propiedad['imagen'];
                $nombreImagen = md5(uniqid(rand(),true)).".jpg";
                move_uploaded_file($imagen['tmp_name'],$carpetaImagenes . $nombreImagen );
            }else{
                $nombreImagen=$propiedad['imagen'];
            }


           $query = "UPDATE propiedades SET  titulo = '${titulo}', precio = '${precio}',imagen='${nombreImagen}',descripcion = '${descripcion}',titulo = '${titulo}', habitaciones = ${habitaciones},wc = ${wc},estacionamiento=${estacionamiento},vendedorId = ${vendedorId} WHERE id=${id} ";
           $resultado = mysqli_query($db,$query);
   
           if ($resultado){
               header("Location:/admin?resultado=2");
           }
        }
    }

    incluirTemplates('header');
?>
    <main class="contenedor seccion">
        <h1>Actualizar</h1>
        <a href="/admin" class="boton boton-verde">Volver</a>
        <?php foreach ($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error ?>     
            </div>
        <?php endforeach; ?>
        <form class="formulario" method="POST" enctype="multipart/form-data" action="" >
            <?php include '../../includes/templates/formulario_propiedades.php'?>
            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
    </main>
<?php
    incluirTemplates('footer');
?>