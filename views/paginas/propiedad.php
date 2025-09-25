<main class="contenedor seccion">
        <h1><?php echo $propiedad->titulo; ?></h1>

        <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="anuncio">

        <div class="resumen-propiedad">
            <p class="precio"><?php echo $propiedad->precio; ?></p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="Icono de baño">
                    <p><?php echo $propiedad->wc; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono de estacionamiento">
                    <p><?php echo $propiedad->estacionamiento; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono de dormitorio">
                    <p><?php echo $propiedad->habitaciones; ?></p>
                </li>
            </ul>
            <p>
                <?php echo $propiedad->descripcion; ?>
            </p>
        </div><!--.resumen-propiedad-->
</main>
