<?php

// Iniciamos la variable errores como un array vacío
$errores = array();

// Comprobamos que el método de solicitud sea POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtenemos los valores de los campos de nombre, fecha,y el checkbox logrado del formulario
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $logrado = isset($_POST['logrado']) ? 'Sí' : 'No';

    // Si el campo de nombre está vacío añadimos un mensaje de error al array de errores
    if (empty($nombre)) {
        $errores[] = "Tienes que introducir un objetivo";
    }

    // Si el campo de fecha está vacío añadimos un mensaje de error al array de errores
    if (empty($fecha)) {
        $errores[] = "No puedes dejar el campo de la fecha vacío";
    }

    // Comprobamos una condición que no haya ningún error en la validación del formulario
    if (empty($errores)) {
        // Si es así se crea una línea con los valores de los campos del formulario separados por punto y coma
        $linea = $nombre . ';' . $fecha . ';' . $logrado . "\n";
        // Definimos en la variable el nombre del archivo donde vamos a guardar los datos que tenemos en la linea
        $archivo = 'objetivos.csv';

        // Comprobamos que el archivo no exista
        if (!file_exists($archivo)) {
            // Creamos el archivo y lo abrimos en modo escritura para añadir una línea de encabezamiento y lo cerramos
            $handle = fopen($archivo, 'w');
            // Comprobamos si no se ha podido crear o abrir el archivo de objetivos y mostramos un mensaje de error
            if ($handle === false) {
                $_SESSION['mensaje'] = 'Ha ocurrido un error al guardar los datos. Póngase en contacto con el servicio informático';
                // Redirigimos al usuario al formulario y detenemos la ejecución para salir del script
                header('Location: ' . $_SERVER['REQUEST_URI']);
                exit;
            }
            fwrite($handle, "Nombre;Fecha;Checked\n");
            fclose($handle);
        }

        // Abrimos el archivo en modo escritura con el puntero al final del mismo
        $handle = fopen($archivo, 'a+');
        // Comprobamos que los datos se hayan guardado correctamente y mostramos un mensaje informando del éxito
        if (fwrite($handle, $linea)) {
            $_SESSION['mensaje'] = 'Los datos se han guardado correctamente.';
        // Si hay algún problema al escribir en el archivo, mostramos un mensaje de error
        } else {
            $_SESSION['mensaje'] = 'Ha ocurrido un error al guardar los datos.';
        }
        // Cerramos el archivo después de guardar la información del formulario
        fclose($handle);
        // Redirigimos al usuario a la misma página después de enviar los datos correctamente
        header('Location: ' . $_SERVER['REQUEST_URI']);
        // Detenemos la ejecución y salimos del script
        exit;
    }
}
