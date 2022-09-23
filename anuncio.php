<?php
ini_set('error_reporting', E_ALL);
    $id = $_GET['id'];
    $id= filter_var($id,FILTER_VALIDATE_INT);

    if (!$id){
        header("Location:/");
    }
    require 'includes/app.php';
    $db = conectarDB();
   
    $query = "SELECT * FROM propiedades  WHERE id = ${id}";

    $resultado = mysqli_query($db, $query);

    if(!$resultado->num_rows){
        header("Location:/");
    }
    
    $propiedad = mysqli_fetch_assoc($resultado);

    incluirTemplates('header');

?>
    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad['titulo'] ?></h1>

        <img src="imagenes/<?php echo $propiedad['imagen'] ?>" >

        <div class="resumen-propiedad">
            <p class="precio"><?php echo $propiedad['precio'] ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad['wc'] ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad['estacionamiento'] ?></p>
                </li>
                <li>
                    <img class="icono"  loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p><?php echo $propiedad['habitaciones'] ?></p>
                </li>
            </ul>
            <p><?php echo $propiedad['descripcion'] ?></p>
        </div>
    </main>
    <?php
    mysqli_close($db);
    incluirTemplates('footer');
    ?>