<!-- Iniciamos la sesión para guardar los datos en el servidor -->
<?php session_start(); ?>
<!-- Importamos el archivo functions.php -->
<?php require_once('functions.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Listado de Objetivos</title>
</head>
<body>
    <h1>Lista de objetivos</h1>
    <h2>¡Crea tu lista de objetivos y síguela!</h2>

    <!-- Mostramos un mensaje de que se han guardado los datos correctamente o que ha habido un error -->
    <?php if (isset($_SESSION['mensaje'])) : ?>
        <p><?php echo $_SESSION['mensaje']; ?></p>
        <?php unset($_SESSION['mensaje']); ?>
    <?php endif; ?>

    <!-- Creamos un formulario que enviará los datoa a través del método POST -->
    <form method="POST">
        <label for="nombre">Nombre:</label>
        <!-- Si se ha enviado el campo con un texto se volverá a mostrar, sino seguirá vacío -->
        <input type="text" name="nombre" id="nombre" value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>">
        <!-- Comprobamos si el input de nombre está vacío, si lo está mostramos un mensaje de error -->
        <?php if (isset($errores) && in_array("Tienes que introducir un objetivo", $errores)) : ?>
            <p style="color: red;">Tienes que introducir un objetivo</p>
        <?php endif; ?>

        <label for="fecha">Fecha:</label>
        <!-- Si se ha enviado el campo con una fecha introducida se volverá a mostrar, sino seguirá vacío -->
        <input type="date" name="fecha" id="fecha" value="<?php echo isset($_POST['fecha']) ? $_POST['fecha'] : ''; ?>">
        <!-- Comprobamos si el campo de fecha está vacío, si es así mostramos un mensaje de error -->
        <?php if (isset($errores) && in_array("No puedes dejar el campo de la fecha vacío", $errores)) : ?>
            <p style="color: red;">No puedes dejar el campo de la fecha vacío</p>
        <?php endif; ?>

        <!-- Creamos el checkbox y el botón de guardar y enviar el formulario -->
        <label for="logrado">Logrado:</label>
        <input type="checkbox" name="logrado" id="logrado">
        <input type="submit" value="Guardar">
    </form>
</body>
</html>
