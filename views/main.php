<?php
/**
 *  Página Principal del Sitio de Gestion Academica *
 */
session_start();
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
  <div class="title-content">
    <h2 class="ui-widget-header ui-corner-all" style="width:90%">Gestión Académica - Notas de Materias</h2>
    <a id="button-logout" class="ui-widget ui-button" style="width:10%;" href="../controlers/userLogout.php">Salir</a>
  </div>
  <div id="mainTabs">
    <ul>
      <?php if ($_SESSION['PROFILE'] == "Administrador") { ?>
        <li><a href="tabAdmins.php" id="adminstab">Administradores</a></li>
      <?php } ?>
      <?php if ($_SESSION['PROFILE'] == "Docente" || $_SESSION['PROFILE'] == "Administrador") { ?>
        <li><a href="tabTeachers.php" id="teacherstab">Docentes</a></li>
      <?php } ?>
      <li><a href="tabStudents.php" id="studentstab">Estudiantes</a></li>
      <?php if ($_SESSION['PROFILE'] == "Docente" || $_SESSION['PROFILE'] == "Administrador") { ?>
        <li><a href="tabSubjects.php" id="subjectstab">Materias</a></li>
      <?php } ?>
    </ul>
  </div>
  <script src="../styles/external/jquery/jquery.js" type="text/javascript"></script>
  <script src="../styles/jquery-ui.js" type="text/javascript"></script>
  <script>
    $("#mainTabs").tabs();
    $("#button-logout.ui-widget").button();
  </script>
</body>
</html>