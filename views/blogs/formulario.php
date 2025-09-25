<fieldset>
    <legend>Información General</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="blog[titulo]" placeholder="Titulo del blog" value="<?php echo s( $blog->titulo ); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" name="blog[imagen]" accept="image/jpeg, image/png">
    <img id="preview" class="imagen-small" style="display:none; margin-top:10px;" />

    <?php if($blog->imagen): ?>
        <img src="/imagenes/<?php echo $blog->imagen ?>" class="imagen-small">
    <?php endif; ?>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="blog[descripcion]"><?php echo s($blog->descripcion); ?></textarea>
</fieldset>


<fieldset>
    <legend>Autor</legend>

    <label for="vendedor">Autor</label>
    <select name="blog[usuarioId]" id="vendedor">
        <option selected value="">-- Seleccione --</option>
        <?php foreach($usuarios as $vendedor) { ?>
            <option <?php echo $blog->usuarioId === $vendedor->id ? 'selected' : ''; ?> value="<?php echo s($vendedor->id); ?>">
                <?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?>
            </option> 
        <?php  } ?>
    </select>
</fieldset>