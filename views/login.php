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
  <script src="../styles/external/jquery/jquery.js" type="text/javascript"></script>
  <script src="../styles/jquery-ui.js" type="text/javascript"></script>
</head>
<body>
<?php
if (isset($_GET['login'])) {
  $loginError = boolval($_GET['login']);
  echo '<script>$("#message-error").show().fadeOut(2500);</script>';
}
?>
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
      <?php if (isset($loginError) && $loginError == 0) { ?>
        <strong>Error en las credenciales de usuario al ingresar..!!</strong>
      <?php } else if (isset($loginError) && $loginError == 1) { ?>
        <strong>La cuenta se encuentra Inactiva..!!</strong><br><strong>Comuniquese con un Administrador.</strong>
      <?php } else { ?>
        <strong>Las credenciales de usuario no son válidas..!!</strong>
      <?php } ?>
    </p>
  </div>
  <script>
    if (urlParam('login') == null) {
      $("#message-error").hide();
    }
    $("#button-login").button().click(function(event) {
      if ($("#username").val() != "" && $("#userpass").val() != "") {
        $("#loginForm").submit();
      } 
      $("#message-error").show().fadeOut(2500);
    });
    function urlParam(name) {
      var urlParse = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
      return urlParse == null ? null : urlParse[1] || 0;
    }
  </script>
</body>
</html>