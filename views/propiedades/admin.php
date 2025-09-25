<main class="contenedor seccion contenido-centrado">

        <h1>Administrador de BienesRaices</h1>

        <?php
        if ($resultado) {
            list($mensaje, $color) = mostrarNotificacion((int) $resultado);

            if ($mensaje) {
                echo '<p class="alerta ' . htmlspecialchars($color) . '">' . s($mensaje) . '</p>';
            }
        }
        ?>
    

        <a href="propiedades/crear" Class="boton boton-verde"> Nueva Propiedad </a>
        <a href="/vendedores/crear" Class="boton boton-amarillo"> Nuevo Vendedor </a>
        <a href="/blogs/crear" Class="boton boton-azul"> Nuevo Blog </a>

        <h2>Propiedades</h2>
        <div class="contenedor-scrol">
            <table class="propiedades">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titulo</th>
                        <th>Imagen</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody> <!----. Mostrar los Resultados---->
                    <?php 
                    foreach($propiedades as $propiedad): ?>
                    <tr>
                        <td><?php echo $propiedad->id ?></td>
                        <td><?php echo $propiedad->titulo ?></td>
                        <td> <img src="../imagenes/<?php echo $propiedad->imagen ?>" class="imagen-tabla"></td>
                        <td>$ <?php echo $propiedad->precio ?></td>
                        <td>
                            <form method="POST" class="w-100" action="propiedades/eliminar">
                                <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                                <input type="hidden" name="tipo" value="propiedad">

                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>
                
                            <a href="propiedades/actualizar?id=<?php echo $propiedad->id ?>" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <h2>Vendedores</h2>
        <div class="contenedor-scrol">
            <table table class="propiedades">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody> <!----. Mostrar los Resultados---->
                    <?php /** @var \App\Vendedor $vendedor instancia para que no me marque error en nombre, apellifo o telefono */ 
                    foreach($vendedores as $vendedor): ?>
                    <tr>
                        <td><?php echo $vendedor->id ?></td>
                        <td><?php echo $vendedor->nombre . " ". $vendedor->apellido ?></td>
                        <td><?php echo $vendedor->telefono ?></td>
                        <td><?php echo $vendedor->email ?></td>
                        <td>
                            <form method="POST" class="w-100" action="/vendedores/eliminar">
                                <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                                <input type="hidden" name="tipo" value="vendedor">

                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>
                
                            <a href="/vendedores/actualizar?id=<?php echo $vendedor->id ?>" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>


        <h2>Blogs</h2>
        <div class="contenedor-scrol">
            <table table class="propiedades">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titulo</th>
                        <th>Imagen</th>
                        <th>Creado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody> <!----. Mostrar los Resultados---->
                    <?php  /** @var \App\Blog $Blog instancia para que no me marque error en nombre, apellifo o telefono */ 
                    foreach($blog as $blogs): ?>
                    <tr>
                        <td><?php echo $blogs->id ?></td>
                        <td><?php echo $blogs->titulo ?></td>
                        <td> <img src="../imagenes/<?php echo $blogs->imagen ?>" class="imagen-tabla"></td>
                        <td><?php echo $blogs->creado ?></td>

                        <td>
                            <form method="POST" class="w-100" action="/blogs/eliminar">
                                <input type="hidden" name="id" value="<?php echo $blogs->id; ?>">
                                <input type="hidden" name="tipo" value="blog">

                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>
                
                            <a href="/blogs/actualizar?id=<?php echo $blogs->id ?>" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

</main>