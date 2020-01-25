<?php
/**
 *  Pestaña Estudiantes del Sitio de Gestion Academica *
 */

?>
<div id="modal-manage-student" title="Registrar nuevo Estudiante">
  <p class="font-italic">Todos los campos son requeridos.</p>
  <form action="../controlers/studentAdd.php" method="POST" id="studentForm">
    <fieldset class="modal-fieldset">
      <input type="hidden" name="idstudent" id="idstudent" value="">
      <label for="name">Nombre(s)</label>
      <input type="text" name="name" id="name" value="" placeholder="Primer y segundo nombre..." class="ui-corner-all" required>
      <label for="lastname">Apellido(s)</label>
      <input type="text" name="lastname" id="lastname" value="" placeholder="Primer y segundo apellido..." class="ui-corner-all" required>
      <label for="usermail">Correo Electrónico</label>
      <input type="email" name="usermail" id="usermail" value="" placeholder="nombrecorreo@dominio.com..." class="ui-corner-all" required>
      <label for="username">Usuario</label>
      <input type="text" name="username" id="username" value="" placeholder="nombreUsuario..." class="ui-corner-all" required>
      <label for="userpass">Contraseña</label>
      <input type="password" name="userpass" id="userpass" value="" placeholder="Debe contener mínimo 8 caracteres..." class="ui-corner-all" required>
      <label for="userpass">Confirmar contraseña</label>
      <input type="password" name="confirm" id="confirm" value="" placeholder="Debe coincidir con la anterior..." class="ui-corner-all" required>
    </fieldset>
    <button type="submit" id="studentadd" class="button button-add">Registrar</button>
    <button type="button" id="editsubjects" class="button button-send modal-action-subject">Gestionar Materias</button>
  </form>
</div>
<div id="modal-subjects" title="Gestionar Materias">
  <p id="messageSubject" class="font-italic">Actualización de Materias del Estudiante.</p>
  <form action="../controlers/studentEditSubject.php" method="POST" id="subjectForm">
    <input type="hidden" name="idstudent" id="idstudent" value="">
    <table>
      <tr>
        <th>Materia</th>
        <th>Nota</th>
        <th>Docente</th>
      </tr>
      <tr>
        <td>
          <select name="subject" id="subject" class="ui-corner-all" style="width: 200px;">
            <option value="">Seleccionar...</option>
            <option value="1">Matematicas</option>
            <option value="2">Ciencias</option>
            <option value="3">Fisica</option>
            <option value="4">Quimica</option>
            <option value="5">ingles</option>
          </select>
        </td>
        <td><input type="number" name="grade" id="grade" value="10" class="ui-corner-all" style="width: 50px;"></td>
        <td>
          <select name="teachers" id="teachers" class="ui-corner-all" style="width: 200px;">
            <option value="">Seleccionar...</option>
            <option value="1">Marcela Castillo</option>
            <option value="2">Juan Berrizbetia</option>
            <option value="3">Francisco Alarcon</option>
            <option value="4">Pablo Quiroga</option>
            <option value="5">Vicente Angulo</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>Fisica</td>
        <td>75%</td>
        <td>Juan Berrizbetia</td>
      </tr>
      <tr>
        <td>Quimica</td>
        <td>85%</td>
        <td>Pablo Quiroga</td>
      </tr>
    </table>
    <button type="submit" id="subjectsupdate" class="button button-add">Actualizar</button>
  </form>
</div>
<div class="container-scroll">
  <button type="button" id="addstudent" class="button button-send modal-action-student">Registrar</button>
  <table>
    <tr>
      <th width="36%"><h3>Nombre(s) y Apellido(s)</h3></th>
      <th width="14%"><h3>Usuario</h3></th>
      <th width="30%"><h3>Correo Electronico</h3></th>
      <th width="8%"><h3>Estado</h3></th>
      <th width="12%"><h3>Fecha Registro</h3></th>
      <th><h3>Acciones</h3></th>
    </tr>
    <tr>
      <td class="ui-state-highlight">Juan Antonio Urbina Castillo</td>
      <td class="ui-state-highlight">juantoniuc</td>
      <td class="ui-state-highlight">jtoniurbinac@academia.com</td>
      <td class="ui-state-highlight">Activo</td>
      <td class="ui-state-highlight">2019-10-19</td>
      <td>
        <div class="manageUser">
          <button type="button" onclick="" id="studentEdit1" class="modal-action-student">Editar</button>
          <button type="button" onclick="" id="studentDisable1">Desactivar</button>
        </div>
      </td>
    </tr>
    <tr>
      <td class="dark-row">Andrea Maria Castellano Ruiz</td>
      <td class="dark-row">andreacastellano</td>
      <td class="dark-row">andreamcr@academia.com</td>
      <td class="dark-row">Activo</td>
      <td class="dark-row">2019-09-27</td>
      <td>
        <div class="manageUser">
          <button type="button" onclick="" id="studentEdit2" class="modal-action-student">Editar</button>
          <button type="button" onclick="" id="studentDisable2">Desactivar</button>
        </div>
      </td>
    </tr>
  </table>
</div>
<script type="text/javascript">
$(".manageUser").controlgroup();
$(".button").button();

$("#modal-manage-student").dialog({
	autoOpen: false,
	width: 500,
	modal: true,
	close: function(event) {
		event.preventDefault();
		$('#studentForm')[0].reset();
	}
});

$(".modal-action-student").click(function(event)  {
	event.preventDefault();
  $('p.font-italic').show();
  $('#editsubjects').hide();
  if (!$(this).hasClass('button-send')) {
    $('#editsubjects').show();
    $('#studentadd').html('Editar');
    $('p.font-italic').hide();
    $("#modal-manage-student").dialog('option', 'title', 'Editar Estudiante');
    $('#studentForm').prop('action', '../controlers/studentEdit.php')
  }
	$("#modal-manage-student").dialog("open");
});

$("#modal-subjects").dialog({
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
	$("#modal-subjects").dialog("open");
});

</script>
