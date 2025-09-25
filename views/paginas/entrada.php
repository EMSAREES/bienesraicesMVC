<?php 
USE Model\Vendedor;
$usuario = Vendedor::find($blog->usuarioId); ?>
?>

<main class="contenedor seccion contenido-centrado">
        <h1><?php echo $blog->titulo; ?></h1>

        <picture>
                <img loading="lazy" src="/imagenes/<?php echo $blog->imagen; ?>" alt="anuncio">
        </picture>

        <p class="informacion-meta">Escrito el: <span><?php echo $blog->creado; ?></span> por: <span><?php echo $usuario->nombre ?></span> </p>

        <div class="resumen-propiedad">
            <p> <?php echo $blog->descripcion;?> </p>

        </div>
</main>