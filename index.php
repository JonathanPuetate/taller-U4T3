<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro Concurso</title>

  <style>
body {
  font-family: Arial, sans-serif;
  background-color: #f2f2f2;
  padding: 20px;
}

h2 {
  text-align: center;
  color: #333;
}

form {
  background: white;
  padding: 20px;
  max-width: 500px;
  margin: auto;
  border-radius: 10px;
  box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
}

label {
  font-weight: bold;
}

input, select {
  width: 100%;
  padding: 8px;
  margin: 8px 0 15px 0;
  border: 1px solid #ccc;
  border-radius: 5px;
}

input[type="checkbox"] {
  width: auto;
  margin-right: 5px;
}

button {
  background-color: #2d89ef;
  color: white;
  padding: 10px;
  border: none;
  width: 100%;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #1b5fbf;
}

/* MENSAJE DE ERROR */
.error {
  background: #ffe5e5;
  color: #b30000;
  padding: 10px;
  border-left: 5px solid red;
  max-width: 500px;
  margin: 10px auto;
  border-radius: 5px;
}

/* MENSAJE DE ÉXITO */
.success {
  background: #e6ffea;
  color: #1b7f2a;
  padding: 10px;
  border-left: 5px solid green;
  max-width: 500px;
  margin: 10px auto;
  border-radius: 5px;
}
  </style>
</head>

<body>

<h2>Registro Concurso de Programación</h2>

<?php
$errores = array();
$exito = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = trim($_POST["nombre"]);
    $lenguajes = isset($_POST["lenguaje"]) ? $_POST["lenguaje"] : array();
    $nivel = isset($_POST["nivel"]) ? $_POST["nivel"] : "";
    $correo = trim($_POST["correo"]);
    $codigo = trim($_POST["codigo"]);

    // NOMBRE
    if (strlen($nombre) < 6 || !preg_match("/^[A-Za-zÁÉÍÓÚáéíóúñÑ ]+$/", $nombre)) {
        $errores[] = "El nombre debe tener mínimo 6 caracteres y solo letras.";
    }

    // LENGUAJES
    if (count($lenguajes) == 0) {
        $errores[] = "Debe seleccionar al menos un lenguaje.";
    }

    // NIVEL
    if ($nivel == "") {
        $errores[] = "Debe seleccionar un nivel de experiencia.";
    }

    // CORREO (compatibilidad PHP viejo)
    if (!preg_match("/@estudiante\.edu\.ec$/", $correo)) {
        $errores[] = "El correo debe terminar en @estudiante.edu.ec.";
    }

    // CÓDIGO
    if (!preg_match("/^[A-Za-z0-9]{8}$/", $codigo)) {
        $errores[] = "El código debe tener exactamente 8 caracteres alfanuméricos.";
    }

    if (count($errores) == 0) {
        $exito = true;
    }
}
?>

<!-- MENSAJES -->
<?php
if (count($errores) > 0) {
    echo "<div class='error'><b>Errores:</b><ul>";
    foreach ($errores as $e) {
        echo "<li>$e</li>";
    }
    echo "</ul></div>";
}
?>

<?php if ($exito) { ?>
  <div class="success">
    <b>Registro exitoso 🎉</b><br><br>
    Nombre: <?php echo $nombre; ?><br>
    Nivel: <?php echo $nivel; ?><br>
    Correo: <?php echo $correo; ?><br>
    Código: <?php echo $codigo; ?><br>
    Lenguajes: <?php echo implode(", ", $lenguajes); ?>
  </div>
<?php } ?>

<!-- FORMULARIO -->
<form method="POST">

  <label>Nombre completo:</label>
  <input type="text" name="nombre">

  <label>Lenguajes:</label>
  <input type="checkbox" name="lenguaje[]" value="Java"> Java
  <input type="checkbox" name="lenguaje[]" value="Python"> Python
  <input type="checkbox" name="lenguaje[]" value="C++"> C++

  <br><br>

  <label>Nivel:</label>
  <select name="nivel">
    <option value="">Seleccione...</option>
    <option value="Principiante">Principiante</option>
    <option value="Intermedio">Intermedio</option>
    <option value="Avanzado">Avanzado</option>
  </select>

  <label>Correo institucional:</label>
  <input type="text" name="correo">

  <label>Código:</label>
  <input type="text" name="codigo">

  <button type="submit">Enviar</button>

</form>

</body>
</html>