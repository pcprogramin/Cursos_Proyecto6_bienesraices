<?php
    require 'includes/funciones.php';
    incluirTemplates('header',true);
?>
    <main class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="">
                <h3>Seguridad</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse vero eligendi dolorem cupiditate nisi placeat minima sunt praesentium, aspernatur amet quos, natus, nam aperiam laboriosam. Optio provident libero est quasi.
                </p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="">
                <h3>Precio</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse vero eligendi dolorem cupiditate nisi placeat minima sunt praesentium, aspernatur amet quos, natus, nam aperiam laboriosam. Optio provident libero est quasi.
                </p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="">
                <h3>A Tiempo</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse vero eligendi dolorem cupiditate nisi placeat minima sunt praesentium, aspernatur amet quos, natus, nam aperiam laboriosam. Optio provident libero est quasi.
                </p>
            </div>
        </div>
    </main>
    <section class="seccion contenedor">
        <h2>Casas y Depas en Venta</h2>
        <?php 
        $limite = 3;
        include 'includes/templates/anuncios.php';
         ?>                                                        
        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton-verde">Ver Todas</a>
        </div>
    </section>
    <section class="imagen-contacto">
        <h2>Encuentra la casa de tu sueño</h2>
        <p>Llena el formulario de contacto y un asesorador se pondrá en contacto contigo a la brevedad</p>
        <a href="contacto.php" class="boton-amarillo">Contactanos</a>
    </section>
    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro blog</h3>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jpeg">
                        <img src="build/img/blog1.jpg" loading="lazy">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.php"><h4>Terraza en el techo de tu casa</h4></a>
                    <p>Escrito el : <span>20/10/2021</span> por: <span>Admin</span></p>
                    <p>
                        Consejo para contruir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero.
                    </p>
                </div>
            </article>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jpeg">
                        <img src="build/img/blog2.jpg" loading="lazy">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.php"><h4>Guia para decorar tu casa</h4></a>
                    <p>Escrito el : <span>20/10/2021</span> por: <span>Admin</span></p>
                    <p>
                        Consejo para contruir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero.
                    </p>
                </div>
            </article>
        </section>
        <section>
            <h3>Testimonial</h3>
            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una excelente fomra, muy buena antención y la casa que me ofrecieron cumple con todas mis expetativas.
                </blockquote>
                <p>- Prudencio Chaparro González</p>
            </div>
        </section>
    </div>
    <?php
    incluirTemplates('footer');
    ?>