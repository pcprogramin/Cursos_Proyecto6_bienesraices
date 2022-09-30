<?php
   require '../../includes/app.php';
use App\Propiedad;
use App\Vendedor;

use Intervention\Image\ImageManagerStatic as Image;
 
    
    estarAutenticado();

    $id= $_GET['id'];
    $id = filter_var($id,FILTER_VALIDATE_INT);

    if(!$id){
        header('Localtion: /admin');
    }

    $propiedad = Propiedad::find($id);
    $vendedores= Vendedor::all();


    $errores = Propiedad::getErrores();

    if ( $_SERVER['REQUEST_METHOD'] === 'POST' ){

        $propiedad->sincronizar($_POST['propiedad']);
        $errores = $propiedad->validar();
        $nombreImagen = md5(uniqid(rand(),true)).".jpg";
        
        if ($_FILES['propiedad']['tmp_name']['imagen']){
            
            $image =Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad ->setImagen($nombreImagen);
            $image->save(CARPETA_IMAGENES.$nombreImagen);
        }
        //Insertar en la Base de Datos
        if(empty($errores)){
            
            $resultado = $propiedad->guardar();
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