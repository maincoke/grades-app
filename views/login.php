<?php
/**
 *  Página de Inicio de Sesión en Sitio de Gestion Academica *
 */

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sitio de Gestión Académica</title>
  <link href="../styles/favicon.ico" rel="shortcut icon" type="image/x-icon">
  <link href="../styles/jquery-ui.min.css" rel="stylesheet">
  <link href="../styles/jquery-ui.theme.min.css" rel="stylesheet">
  <link href="../styles/jquery-ui.structure.min.css" rel="stylesheet">
  <link href="../styles/style.css" rel="stylesheet" type="text/css">
</head>
<body>
  <div>
    <form method="POST" action="../controlers/userLogin.php"> <!-- Controlador -->
      <h2 class="ui-widget-header ui-corner-all">Gestión Académica - Inicio de Sesión</h2>
      <fieldset class="box-login ui-widget-content ui-corner-all">
        <label for="username">Usuario</label>
        <input type="text" name="username" id="username" class="ui-corner-all" />
        <label for="userpass">Contraseña</label>
        <input type="password" name="userpass" id="userpass" class="ui-corner-all" />
        <button type="submit" id="button-login" class="button">Ingresar</button>
      </fieldset>
    </form>
  </div>
  <script src="../styles/external/jquery/jquery.js" type="text/javascript"></script>
  <script src="../styles/jquery-ui.js" type="text/javascript"></script>
  <script>
    $( ".button" ).button();
  </script>
</body>
</html>