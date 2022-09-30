<?php
    require '../../includes/app.php';
    ini_set('display_errors', 1);

    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;

    estarAutenticado();
    
    $db = conectarDB();

    $consulta = "SELECT * FROM vendedores";

    $vendedores = mysqli_query($db,$consulta);

    $errores = Propiedad::getErrores();

    $propiedad = new Propiedad;
    if ( $_SERVER['REQUEST_METHOD'] === 'POST' ){

        $propiedad = new Propiedad();
        
        
        $nombreImagen = md5(uniqid(rand(),true)).".jpg";

        if ($_FILES['propiedad']['tmp_name']['imagen']){
            $image =Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad ->setImagen($nombreImagen);
        }
        $errores = $propiedad->validar();
        
        //Insertar en la Base de Datos
        if(empty($errores)){
            if (!is_dir(CARPETA_IMAGENES)){
                mkdir(CARPETA_IMAGENES);
            }
            $image->save(CARPETA_IMAGENES.$nombreImagen);
            $resultado=$propiedad->guardar();
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
            <?php include '../../includes/templates/formulario_propiedades.php'?>
            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>
<?php
    incluirTemplates('footer');
?>