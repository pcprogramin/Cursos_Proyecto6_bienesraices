<?php
    require 'includes/funciones.php';
    incluirTemplates('header');
?>
<main class="contenedor seccion">
    <h1>Anuncios</h1>
    <main class="contenedor seccion">

        <h2>Casas y Depas en Venta</h2>

        <?php 
        $limite = 9;
        include 'includes/templates/anuncios.php';
         ?>
    </main>
</main>
<?php
    incluirTemplates('footer');
    ?>