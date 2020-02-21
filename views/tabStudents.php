<?php
/**
 *  Pestaña Estudiantes del Sitio de Gestion Academica *
 */
require_once('../models/Student.php');
require_once('../models/Subject.php');
require_once('../models/Teacher.php');
session_start();
if (isset($_SESSION) && ($_SESSION['PROFILE'] == "Administrador" || $_SESSION['PROFILE'] == "Docente") || $_SESSION['PROFILE'] == "Estudiante") {
  $student = new Student();
  $subjects = new Subject();
  $teachers = new Teacher();
  $dataStudent = $student->fetchStudentData($_SESSION['ID']);
}
?>
<div class="container-scroll">
<?php if($_SESSION['PROFILE'] !== "Estudiante") { ?>
  <button type="button" id="addstudent" class="button button-send action-student">Registrar</button>
<?php } ?>
  <table>
    <tr>
      <th width="36%"><h3>Nombre(s) y Apellido(s)</h3></th>
      <th width="14%"><h3>Usuario</h3></th>
      <th width="30%"><h3>Correo Electronico</h3></th>
      <th width="8%"><h3>Estado</h3></th>
      <th width="12%"><h3>Fecha Registro</h3></th>
      <th><h3>Acciones</h3></th>
    </tr>
    <?php
      $i = 0;
      $dataStudents = $student->fetchAllstudents();
      foreach ($dataStudents as $data) {
    ?>
        <tr>
          <td class=<?php echo $i % 2 == 0 ? "ui-state-highlight" : "dark-row" ?>><?php echo $data['name'].' '.$data['lastname'] ?></td>
          <td class=<?php echo $i % 2 == 0 ? "ui-state-highlight" : "dark-row" ?>><?php echo $data['username'] ?></td>
          <td class=<?php echo $i % 2 == 0 ? "ui-state-highlight" : "dark-row" ?>><?php echo $data['email'] ?></td>
          <td class=<?php echo $i % 2 == 0 ? "ui-state-highlight" : "dark-row" ?>><?php echo $data['state'] ?></td>
          <td class=<?php echo $i % 2 == 0 ? "ui-state-highlight" : "dark-row" ?>><?php echo $data['date_signup'] ?></td>
          <td>
          <?php if($_SESSION['PROFILE'] !== "Estudiante" || $_SESSION['ID'] == $data['id_user']) { ?>
            <div class="manageUser">
              <button type="button" class="action-student" value=<?php echo $data['id_user'] ?>>Editar</button>
            <?php if($_SESSION['PROFILE'] !== "Estudiante") { ?>
              <button type="button" class="active-student" value=<?php echo $data['id_student'] ?>><?php echo $data['state'] === "Activo" ? 'Desactivar' : 'Activar'; ?></button>
            <?php } ?>
            </div>
          <?php } ?>
          </td>
        </tr>
    <?php
        $i++;
      }
    ?>
  </table>
</div>
<div id="modal-manage-student">
  <p class="font-italic">Todos los campos son requeridos.</p>
  <form action="../controlers/studentAdd.php" method="POST" id="studentForm">
    <fieldset class="modal-fieldset">
      <input type="hidden" name="idstudent" id="idstudent" value="">
      <label for="nameStd">Nombre(s)</label>
      <input type="text" name="nameStd" id="nameStd" value="" placeholder="Primer y segundo nombre..." class="ui-corner-all" required>
      <label for="lastnameStd">Apellido(s)</label>
      <input type="text" name="lastnameStd" id="lastnameStd" value="" placeholder="Primer y segundo apellido..." class="ui-corner-all" required>
      <label for="numdocStd">Identificación</label>
      <input type="text" name="numdocStd" id="numdocStd" value="" placeholder="Número de identificación..." class="ui-corner-all" required>
      <label for="usermailStd">Correo Electrónico</label>
      <input type="email" name="usermailStd" id="usermailStd" value="" placeholder="nombrecorreo@dominio.com..." class="ui-corner-all" required>
      <label for="usernameStd">Usuario</label>
      <input type="text" name="usernameStd" id="usernameStd" value="" placeholder="nombreUsuario..." class="ui-corner-all" required>
      <label for="userpassStd">Contraseña</label>
      <input type="password" name="userpassStd" id="userpassStd" value="" placeholder="Debe contener 8 caracteres..." class="ui-corner-all" required>
      <label for="confirmStd">Confirmar contraseña</label>
      <input type="password" name="confirmStd" id="confirmStd" value="" placeholder="Debe coincidir con la anterior..." class="ui-corner-all" required>
    </fieldset>
    <button type="submit" id="managestudent" class="button button-manage">Registrar</button>
    <button type="button" id="editsubjects" class="button button-send modal-action-subject">
      <?php echo $_SESSION['PROFILE'] != 'Estudiante' ? 'Gestionar' : 'Consultar'; ?> Materias
    </button>
  </form>
</div>
<div id="modal-active-student" title="Desactivar Estudiante">
  <input type="hidden" name="studentId" id="studentId" value="">
  <p>
    <span class="ui-icon" style="float:left; margin:12px 12px 20px 0;" id="activeIcon"></span>
    Este usuario Estudiante: <span id="studentName"></span> será <span id="studentState"></span>.!!
  </p>
  <p>¿Está usted seguro?</p>
</div>
<div id="modal-subjects" title="<?php echo $_SESSION['PROFILE'] != 'Estudiante' ? 'Gestionar' : 'Consultar'; ?> Materias">
<?php if ($_SESSION['PROFILE'] != 'Estudiante') { ?>
  <p id="messageSubject" class="font-italic">Actualización de Materias del Estudiante.</p>
<?php } ?>
  <form action="../controlers/studentEditSubject.php" method="POST" id="subjectForm">
    <input type="hidden" name="idStudent" id="idStudent" value="">
    <table>
      <tr>
        <th>Materia</th>
        <th>Nota</th>
        <th>Docente</th>
      </tr>
    <?php if ($_SESSION['PROFILE'] != 'Estudiante') {
      $allSubjects = $subjects->fetchAllSubjects();
      $allTeachers = $teachers->fetchAllTeachers();
    ?>
      <tr>
        <td>
          <select name="subject" id="subject" class="ui-corner-all" style="width: 200px;">
            <option value="">Seleccionar...</option>
          <?php foreach($allSubjects as $subject) { ?>
            <option value="<?php echo $subject['id_subject'] ?>"><?php echo $subject['subjectmatter'] ?></option>
          <?php } ?>
          </select>
        </td>
        <td><input type="number" name="grade" id="grade" value="10" class="ui-corner-all" style="width: 50px;"></td>
        <td>
          <select name="teachers" id="teachers" class="ui-corner-all" style="width: 200px;">
            <option value="">Seleccionar...</option>
          <?php foreach($allTeachers as $teacher) { 
            $teacherShortName = substr($teacher['name'], 0, strpos($teacher['name'], " ")).' '.substr($teacher['lastname'], 0, strpos($teacher['lastname'], " "));
          ?>
            <option value="<?php echo $teacher['id_teacher'] ?>"><?php echo $teacherShortName; ?></option>
          <?php } ?>
          </select>
        </td>
      </tr>
    <?php } //** -------------------------------------------------------------------------------------------------------------------- */
      $studentGrades = $_SESSION['PROFILE'] != 'Estudiante' ? $dataStudent : $student->fetchGradesStudent($_SESSION['ID']); //***** */
      foreach ($studentGrades as $gradeStd) {
        $teacherShortName = substr($gradeStd['nametch'], 0, strpos($gradeStd['nametch'], " ")).' '.substr($gradeStd['lnametch'], 0, strpos($gradeStd['lnametch'], " "));
    ?>
      <tr>
        <td><?php echo $gradeStd['sbjname'] ?></td>
        <td class=<?php echo $gradeStd['grade'] < 49 ? "fail-grade-font" : ""; ?>><?php echo $gradeStd['grade'] ?>%</td>
        <td><?php echo $teacherShortName ?></td>
      </tr>
    <?php } ?>
    </table>
  <?php if ($_SESSION['PROFILE'] != 'Estudiante') { ?>
    <button type="submit" id="subjectsUpdate" class="button button-manage">Actualizar</button>
  <?php } ?>
  </form>
</div>
<script type="text/javascript">
$(".manageUser").controlgroup();
$(".button").button();

$("#modal-manage-student").dialog({
  resizable: false,
	autoOpen: false,
	width: 500,
	modal: true,
	close: function(event) {
		event.preventDefault();
		$('#studentForm')[0].reset();
	}
});

$(".action-student").click(function(event)  {
  event.preventDefault();
  $('p.font-italic').show();
  if (!$(this).hasClass('button-send')) {
    $('p.font-italic').hide();
    $('#studentForm').prop('action', '../controlers/studentEdit.php')
    $('#managestudent').html('Editar');
    $("#modal-manage-student").dialog('option', 'title', 'Editar Estudiante');
    var studentid = $(this).prop('value');
    $.ajax({ url: '../controlers/getDatastudent.php',
      method: 'POST',
      dataType: 'json',
      data: { 'id_student': studentid },
      success: function(data) {
        if (data) {
          $('#idstudent').val(data[0].id_student);
          $('#nameStd').val(data[0].name);
          $('#lastnameStd').val(data[0].lastname);
          $('#numdocStd').val(data[0].document).prop('disabled', true);
          $('#usermailStd').val(data[0].email);
          $('#usernameStd').val(data[0].username).prop('disabled', true);
          $('#userpassStd').val(data[0].password);
          $('#confirmStd').val(data[0].password);
        } else {
          alert('No existe el registro! Intente de nuevo..!!');
        }
      },
      error: function(err, txt, errt) {
        console.log('Ha ocurrido un error..!!');
      }
    });
  } else {
    $('#usernameStd').prop('disabled', false);
    $('#numdocStd').prop('disabled', false);
    $('#studentForm').prop('action', '../controlers/studentAdd.php');
    $('#managestudent').html('Registrar');
    $("#modal-manage-student").dialog('option', 'title', 'Registrar nuevo Estudiante');
  }
	$("#modal-manage-student").dialog("open");
});

$('#studentForm').submit(function(event) {
  var validEmail = (/[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/gi)
                  .test($('#usermailStd').val());
  var validPword = $('#userpassStd').val() == $('#confirmStd').val() ? true : false;
  return validPword && validEmail;
});

$("#modal-active-student").dialog({
  resizable: false,
  autoOpen: false,
  width: 400,
  modal: true,
  height: "auto",
  buttons: [{
    text: "",
    click: function(event) {
      event.preventDefault();
      var studentidsw = parseInt($('#studentId').val());
      $.ajax({ url: '../controlers/studentDisable.php',
        method: 'POST',
        dataType: 'json',
        data: { 'id_student': studentidsw },
        success: function(data) {
          if (data) {
            alert("Se modificó el estado del usuario con éxito!!");
            window.location = '../views/main.php';
          }
        },
        error: function(err, txt, errt) { alert('Ha ocurrido un error..!!'); }
      });
    }
  },{
    text: "Cancelar",
    click: function(event) { $(this).dialog("close"); }
  }]
});

$(".active-student").click(function(event) {
  event.preventDefault();
  var studentid = $(this).prop('value');
  var studentStateSw = $(this).html() == "Desactivar" ? "Activar": "Desactivar";
  $.ajax({ url: '../controlers/getDatastudent.php',
    method: 'POST',
    dataType: 'json',
    data: { 'id_student': studentid },
    success: function(data) {
      if (data) {
        $('#modal-active-student').dialog('option', 'title', (studentStateSw == "Activar" ? "Desactivar" : "Activar") + " Estudiante");
        $('#studentId').val(data[0].id_user);
        $('#studentName').text(data[0].name + " " + data[0].lastname);
        $('#studentState').text(studentStateSw == "Activar" ? "desactivado" : "activado");
        studentStateSw == "Activar" ? $('#activeIcon').removeClass('ui-icon-circle-arrow-n').addClass('ui-icon-circle-arrow-s') :
        $('#activeIcon').removeClass('ui-icon-circle-arrow-s').addClass('ui-icon-circle-arrow-n');
        $('.ui-dialog > .ui-dialog-buttonpane > .ui-dialog-buttonset').children('.ui-button:nth-child(1)').text(studentStateSw == "Activar" ? "Desactivar" : "Activar");
      } else {
        alert('No existe el registro! Intente de nuevo..!!');
      }
    },
    error: function(err, txt, errt) { alert('Ha ocurrido un error..!!'); }
  });
  $("#modal-active-student").dialog("open");
});

$("#modal-subjects").dialog({
  resizable: false,
  autoOpen: false,
  width: 560,
  maxHeight: 400,
	modal: true,
	close: function(event) {
		event.preventDefault();
		$('#subjectForm')[0].reset();
	}
});

$(".modal-action-subject").click(function(event)  {
	event.preventDefault();
  $('p#messageSubject.font-italic').show();
  $('#idStudent').prop('value', $('#idstudent').prop('value'));
	$("#modal-subjects").dialog("open");
});
</script>
