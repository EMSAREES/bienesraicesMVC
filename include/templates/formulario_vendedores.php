<fieldset>
    <legend>Información General</legend>

    <label for="titulo">Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre Vendedor(a)" value="<?php echo s( $vendedor->nombre ); ?>">

    <label for="precio">Apellido:</label>
    <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido Vendedor(a)" value="<?php echo s($vendedor->apellido); ?>">

</fieldset>

<fieldset>
    <legend>Información de Contacto</legend>

    <label for="imagen">Telefono:</label>
    <input type="number" id="telefono" name="vendedor[telefono]" placeholder="Telefono del vendedor(a)" value="<?php echo s($vendedor->telefono); ?>">

    <label for="imagen">Email:</label>
    <input type="email" id="email" name="vendedor[email]" placeholder="correo del vendedor(a)" value="<?php echo $vendedor->email? s($vendedor->email) : " "; ?>">

</fieldset>