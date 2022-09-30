<?php
    require '../includes/app.php';
    
    estarAutenticado();
    use App\Propiedad;
    $propiedades = Propiedad::all();

    //Mensaje condicional
    $resultado =$_GET['resultado'] ?? null;
    
    if($_SERVER['REQUEST_METHOD']==='POST'){
        $id=$_POST['id'];
        $id=filter_var($id,FILTER_VALIDATE_INT);
       
        if($id){
            $propiedad = Propiedad::find($id);
            $propiedad->eliminar();
        }
    }

    
    incluirTemplates('header');
?>
    <main class="contenedor seccion">
        <h1>Administrador Bienes Raices</h1>
        <?php if (intval($resultado)===1):?>
            <p class="alerta exito">Anuncio creado correctamente</p>
        <?php elseif(intval($resultado)===2): ?>
            <p class="alerta exito">Anuncio actualizado correctamente</p>
            <?php elseif(intval($resultado)===3): ?>
            <p class="alerta exito">Anuncio eliminado correctamente</p>
        <?php endif;?>
        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($propiedades as $propiedad): ?>
                <tr>
                    <td><?php echo $propiedad->id ?></td>
                    <td><?php echo $propiedad->titulo?></td>
                    <td><img class="imagen-tabla" src="imagenes/<?php echo $propiedad->imagen ?>"></td>
                    <td><?php echo $propiedad->precio ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id ?>">
                            <input type="submit" value="Eliminar" class="boton-rojo-block">
                        </form>
                        <a href="admin/propiedades/actualizar.php?id=<?php echo $propiedad->id ?>" class="boton-verde-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </main>
<?php
    mysqli_close($db);
    incluirTemplates('footer');
?>