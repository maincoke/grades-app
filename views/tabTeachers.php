<?php
/**
 *  Pestaña Docentes del Sitio de Gestion Academica *
 */
require_once('../models/Teacher.php');
session_start();
if (isset($_SESSION) && ($_SESSION['PROFILE'] == "Administrador" || $_SESSION['PROFILE'] == "Docente")) {
  $teacher = new Teacher();
  $dataTeacher = $teacher->fetchTeacherData($_SESSION['ID']);
}
?>
<div class="container-scroll">
  <button type="button" id="addteacher" class="button button-send action-teacher">Registrar</button>
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
      $dataTeachers = $teacher->fetchAllTeachers();
      foreach ($dataTeachers as $data) {
    ?>
        <tr>
          <td class=<?php echo $i % 2 == 0 ? "ui-state-highlight" : "dark-row" ?>><?php echo $data['name'].' '.$data['lastname'] ?></td>
          <td class=<?php echo $i % 2 == 0 ? "ui-state-highlight" : "dark-row" ?>><?php echo $data['username'] ?></td>
          <td class=<?php echo $i % 2 == 0 ? "ui-state-highlight" : "dark-row" ?>><?php echo $data['email'] ?></td>
          <td class=<?php echo $i % 2 == 0 ? "ui-state-highlight" : "dark-row" ?>><?php echo $data['state'] ?></td>
          <td class=<?php echo $i % 2 == 0 ? "ui-state-highlight" : "dark-row" ?>><?php echo $data['date_signup'] ?></td>
          <td>
            <div class="manageUser">
              <button type="button" class="action-teacher" value=<?php echo $data['id_user'] ?>>Editar</button>
              <button type="button" class="" value="<?php echo $data['id_teacher'] ?>">Desactivar</button>
            </div>
          </td>
        </tr>
    <?php
        $i++;
      }
    ?>
  </table>
</div>
<div id="modal-manage-teacher">
  <p class="font-italic">Todos los campos son requeridos.</p>
  <form action="../controlers/teacherAdd.php" method="POST" id="teacherForm">
    <fieldset class="modal-fieldset">
      <input type="hidden" name="idteacher" id="idteacher" value="">
      <label for="nameTch">Nombre(s)</label>
      <input type="text" name="nameTch" id="nameTch" value="" placeholder="Primer y segundo nombre..." class="ui-corner-all" required>
      <label for="lastnameTch">Apellido(s)</label>
      <input type="text" name="lastnameTch" id="lastnameTch" value="" placeholder="Primer y segundo apellido..." class="ui-corner-all" required>
      <label for="numdocTch">Identificación</label>
      <input type="text" name="numdocTch" id="numdocTch" value="" placeholder="Número de identificación..." class="ui-corner-all" required>
      <label for="usermailTch">Correo Electrónico</label>
      <input type="email" name="usermailTch" id="usermailTch" value="" placeholder="nombrecorreo@dominio.com..." class="ui-corner-all" required>
      <label for="usernameTch">Usuario</label>
      <input type="text" name="usernameTch" id="usernameTch" value="" placeholder="nombreUsuario..." class="ui-corner-all" required>
      <label for="userpassTch">Contraseña</label>
      <input type="password" name="userpassTch" id="userpassTch" value="" placeholder="Debe contener 8 caracteres..." class="ui-corner-all" required>
      <label for="confirmTch">Confirmar contraseña</label>
      <input type="password" name="confirmTch" id="confirmTch" value="" placeholder="Debe coincidir con la anterior..." class="ui-corner-all" required>
    </fieldset>
    <button type="submit" id="manageteacher" class="button button-manage">Registrar</button>
  </form>
</div>
<script type="text/javascript">
$(".manageUser").controlgroup();
$(".button").button();

$("#modal-manage-teacher").dialog({
	autoOpen: false,
	width: 500,
	modal: true,
	close: function(event) {
		event.preventDefault();
		$('#teacherForm')[0].reset();
	}
});

$(".action-teacher").click(function(event)  {
  event.preventDefault();
  $('p.font-italic').show();
  if (!$(this).hasClass('button-send')) {
    $('p.font-italic').hide();
    $('#teacherForm').prop('action', '../controlers/teacherEdit.php')
    $('#manageteacher').html('Editar');
    $("#modal-manage-teacher").dialog('option', 'title', 'Editar Docente');
    var teacherid = $(this).prop('value');
    $.ajax({ url: '../controlers/getDataTeacher.php',
      method: 'POST',
      dataType: 'json',
      data: { 'id_teacher': teacherid },
      success: function(data) {
        if (data) {
          $('#idteacher').val(data[0].id_teacher);
          $('#nameTch').val(data[0].name);
          $('#lastnameTch').val(data[0].lastname);
          $('#numdocTch').val(data[0].document).prop('disabled', true);
          $('#usermailTch').val(data[0].email);
          $('#usernameTch').val(data[0].username).prop('disabled', true);
          $('#userpassTch').val(data[0].password);
          $('#confirmTch').val(data[0].password);
        } else {
          alert('No existe el registro! Intente de nuevo..!!');
        }
      },
      error: function(err, txt, errt) {
        console.log('Ha ocurrido un error..!!');
      }
    });
  } else {
    $('#usernameTch').prop('disabled', false);
    $('#numdocTch').prop('disabled', false);
    $('#teacherForm').prop('action', '../controlers/teacherAdd.php');
    $('#manageteacher').html('Registrar');
    $("#modal-manage-teacher").dialog('option', 'title', 'Registrar nuevo Docente');
  }
	$("#modal-manage-teacher").dialog("open");
});

$('#teacherForm').submit(function(event) {
  var validEmail = (/[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/gi)
                  .test($('#usermailTch').val());
  var validPword = $('#userpassTch').val() == $('#confirmTch').val() ? true : false;
  return validPword && validEmail;
});
</script>
