<?php
USE Model\Vendedor;

foreach($blogs as $blog): 
    $usuario = Vendedor::find($blog->usuarioId); ?>
    <article class="entrada-blog">
            <div class="imagen">
                <img loading="lazy" src="/imagenes/<?php echo $blog->imagen; ?>" alt="anuncio">
            </div>

            <div class="texto-entrada">
                <a href="/entrada?id=<?php echo $blog->id; ?>">
                    <h4><?php echo $blog->titulo; ?></h4>
                    <p>Escrito el: <span><?php echo $blog->creado; ?></span> por: <span><?php echo $usuario->nombre ?></span> </p>

                    <p>
                        <?php 
                            $descripcion = $blog->descripcion;
                            echo strlen($descripcion) > 100 
                            ? substr($descripcion, 0, 97) . '...' 
                            : $descripcion;
                        ?>      
                    </p>
                </a>
            </div>
    </article>
<?php endforeach; ?>