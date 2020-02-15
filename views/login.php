<?php
/**
 *  Página de Inicio de Sesión en Sitio de Gestion Academica *
 */
if (isset($_GET['login'])) {
  $loginError = boolval($_GET['login']);
} else {
  $loginError = true;
}
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
    <form method="POST" action="../controlers/userLogin.php" id="loginForm">
      <h2 class="ui-widget-header ui-corner-all">Gestión Académica - Inicio de Sesión</h2>
      <fieldset class="box-login ui-widget-content ui-corner-all">
        <label for="username">Usuario</label>
        <input type="text" name="username" id="username" class="ui-corner-all" required />
        <label for="userpass">Contraseña</label>
        <input type="password" name="userpass" id="userpass" class="ui-corner-all" required/>
        <button type="button" id="button-login">Ingresar</button>
      </fieldset>
    </form>
  </div>
  <div class="ui-state-error ui-corner-all" id="message-error">
    <p>
      <span class="ui-icon ui-icon-alert" style="margin-right: .3em;"></span>
      <?php if ($loginError) { ?>
        <strong>Error en las credenciales de usuario al ingresar..!!</strong>
      <?php } else { ?>
        <strong>Las credenciales de usuario no son válidas..!!</strong>
      <?php } ?>
    </p>
  </div>
  <script src="../styles/external/jquery/jquery.js" type="text/javascript"></script>
  <script src="../styles/jquery-ui.js" type="text/javascript"></script>
  <script>
    $("#message-error").hide();
    $("#button-login").button().click(function(event) {
      if ($("#username").val() != "" && $("#userpass").val() != "") {
        $("#loginForm").submit();
      } else {
        $("#message-error").show().fadeOut(2500);
      }
    });
  </script>
</body>
</html>