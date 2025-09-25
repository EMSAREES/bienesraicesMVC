<main class="contenedor seccion">
        <h1>Mas Sobre Nosotros</h1>

        <?php include 'inconos.php'; ?>
        
    </main>

    <!--------------------------------------------------------------------------------------------------------------------------------------------------------------------->

    <section class="seccion contenedor">
        <h2>Casas y Depas en Venta</h2>

        <?php
            include 'listado.php';
        ?>

        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton-verde">Ver Todas</a>
        </div>
    </section>

    <!--------------------------------------------------------------------------------------------------------------------------------------------------------------------->

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario de contacto y un asesor se pondra en contacto contigo a la brevedad</p>

        <a href="contacto.php" class="boton-amarillo">Contactanos</a>

    </section>

    <!--------------------------------------------------------------------------------------------------------------------------------------------------------------------->

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>

            <?php 
                include 'cardBlog.php';
            ?>
            
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>

            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas.
                </blockquote>
                <p>- Emilio Reyes </p>
            </div>
        </section>
    </div>