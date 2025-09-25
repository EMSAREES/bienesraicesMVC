<main>
    <h1 class="nombre-pagina">Actualizar</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error; ?>
    </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include_once __DIR__ . '/formulario.php'; ?>

        <input type="submit" value="Actualizar Vendedor" class="boton boton-verde">
    </form>
</main>