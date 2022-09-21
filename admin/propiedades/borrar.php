<?php
    require '../../includes/funciones.php';
    
    $auth = estarAutenticado();
    if(!$auth){
        header('Location:/');
    }
    incluirTemplates('header');
?>
    <main class="contenedor seccion">
        <h1>Borrar</h1>
    </main>
<?php
    incluirTemplates('footer');
?>