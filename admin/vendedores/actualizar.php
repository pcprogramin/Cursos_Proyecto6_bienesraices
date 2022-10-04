<?php
require '../../includes/app.php';

use App\Vendedor;

estarAutenticado();

$id = $_GET['id'];
$id = filter_var($id,FILTER_VALIDATE_INT);
if(!$id){
    header('Location: /admin');
}

$vendedor= Vendedor::find($id);

$errores = Vendedor::getErrores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vendedor->sincronizar($_POST['vendedor']);
    $errores=$vendedor->validar();
    if (empty($errores)) {
        $vendedor->guardar();
    }
}

incluirTemplates('header');
?>
<main class="contenedor seccion">
    <h1>Actualizar Vendedor</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach; ?>
    <form class="formulario" method="POST" enctype="multipart/form-data" >
        <?php include '../../includes/templates/formulario_vendedores.php' ?>
        <input type="submit" value="Guardar Cambios" class="boton boton-verde">
    </form>
</main>