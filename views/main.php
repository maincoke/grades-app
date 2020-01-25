<?php
/**
 *  Página Principal del Sitio de Gestion Academica *
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
    <h2 class="ui-widget-header ui-corner-all title-content">Gestión Académica - Notas de Materias</h2>
  </div>
  <div id="mainTabs" class="">
    <ul>
      <li><a href="tabAdmins.php">Administradores</a></li>
      <li><a href="tabTeachers.php">Docentes</a></li>
      <li><a href="tabStudents.php">Estudiantes</a></li>
      <li><a href="tabSubjects.php">Materias</a></li>
    </ul>
  </div>
  <script src="../styles/external/jquery/jquery.js" type="text/javascript"></script>
  <script src="../styles/jquery-ui.js" type="text/javascript"></script>
  <script>
    $("#mainTabs").tabs();
  </script>
</body>
</html>