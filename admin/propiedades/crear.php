<?php
    require '../../includes/app.php';
    ini_set('display_errors', 1);

    use App\Propiedad;
    
    estarAutenticado();
    
    $db = conectarDB();

    $consulta = "SELECT * FROM vendedores";

    $vendedores = mysqli_query($db,$consulta);

    $errores = [];
    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedorId = '';
    if ( $_SERVER['REQUEST_METHOD'] === 'POST' ){
        $propiedad = new Propiedad($_POST);
        $propiedad->guardar();
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
        if(!$imagen['name'] || $imagen['error']){
            $errores[] = "Debes añadir una imagen";
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
            
            $nombreImagen = md5(uniqid(rand(),true)).".jpg";
            move_uploaded_file($imagen['tmp_name'],$carpetaImagenes . $nombreImagen );

           
   
           $resultado = mysqli_query($db,$query);
   
           if ($resultado){
               header("Location:/admin?resultado=1");
           }
        }
    }

    incluirTemplates('header');
?>
    <main class="contenedor seccion">
        <h1>Crear</h1>
        <a href="/admin" class="boton boton-verde">Volver</a>
        <?php foreach ($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error ?>     
            </div>
        <?php endforeach; ?>
        <form class="formulario" method="POST" enctype="multipart/form-data" action="/admin/propiedades/crear.php" >
            <fieldset>
                <legend>Información General</legend>       
                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder= "Titulo de la Propiedad" value="<?php echo $titulo ?>">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder= "Precio Propiedad" value="<?php echo $precio ?>">

                <label for="imgenes">Imagen:</label>
                <input type="file" id="imagenes" name="imagen" accept='image/jpeg, image/png'>
                
                <label for="description">Descripción:</label>
                <textarea id="descripcion" name="descripcion"><?php  echo $descripcion; ?></textarea>
            </fieldset>
            <fieldset>
                <legend>Información Propiedad</legend>
                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones"  name="habitaciones" placeholder="Ej: 3" min="1" value="<?php echo $habitaciones ?>">
                <label for="wc">Baños:</label>
                <input type="number" id="wc" name = "wc" placeholder="Ej: 3" min="1" value="<?php echo $wc ?>">
                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" value="<?php echo $estacionamiento ?>">
            </fieldset>
            <fieldset>
                <legend>Vendedor</legend>
                <select name = "vendedorId">
                    <option value="">-- Seleccionar Vendedor</option>
                    <?php while ($vendedor  = mysqli_fetch_assoc($vendedores)): ?>
                        <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : '' ?> value = "<?php echo $vendedor['id'] ?>"><?php echo $vendedor['nombre']." ". $vendedor['apellido'] ?></option>
                    <?php endWhile; ?>
                </select>
            </fieldset>
            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>
<?php
    incluirTemplates('footer');
?>