<?php
/**
 *  Pestaña Docentes del Sitio de Gestion Academica *
 */

?>
<div id="modal-manage-teacher" title="Registrar nuevo Docente">
  <p class="font-italic">Todos los campos son requeridos.</p>
  <form action="../controlers/teacherAdd.php" method="POST" id="teacherForm">
    <fieldset class="modal-fieldset">
      <input type="hidden" name="idteacher" id="idteacher" value="">
      <label for="name">Nombre(s)</label>
      <input type="text" name="name" id="name" value="" placeholder="Primer y segundo nombre..." class="ui-corner-all" required>
      <label for="lastname">Apellido(s)</label>
      <input type="text" name="lastname" id="lastname" value="" placeholder="Primer y segundo apellido..." class="ui-corner-all" required>
      <label for="usermail">Correo Electrónico</label>
      <input type="email" name="usermail" id="usermail" value="" placeholder="nombrecorreo@dominio.com..." class="ui-corner-all" required>
      <label for="username">Usuario</label>
      <input type="text" name="username" id="username" value="" placeholder="nombreUsuario..." class="ui-corner-all" required>
      <label for="userpass">Contraseña</label>
      <input type="password" name="userpass" id="userpass" value="" placeholder="Debe contener 8 caracteres..." class="ui-corner-all" required>
      <label for="userpass">Confirmar contraseña</label>
      <input type="password" name="confirm" id="confirm" value="" placeholder="Debe coincidir con la anterior..." class="ui-corner-all" required>
    </fieldset>
    <button type="submit" id="teacheradd" class="button button-add">Registrar</button>
  </form>
</div>
<div class="container-scroll">
  <button type="button" id="addteacher" class="button button-send modal-action-teacher">Registrar</button>
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
      <td class="ui-state-highlight">Marcela Andrea Castillo Sanchez</td>
      <td class="ui-state-highlight">marcecast</td>
      <td class="ui-state-highlight">marcecastillo@academia.com</td>
      <td class="ui-state-highlight">Activo</td>
      <td class="ui-state-highlight">2019-11-16</td>
      <td>
        <div class="manageUser">
          <button type="button" onclick="" id="studentEdit1" class="modal-action-teacher">Editar</button>
          <button type="button" onclick="" id="studentDisable1">Desactivar</button>
        </div>
      </td>
    </tr>
    <tr>
      <td class="dark-row">Juan Camilo Berrizbetia Matos</td>
      <td class="dark-row">juancabmatos</td>
      <td class="dark-row">jcberrizmatos@academia.com</td>
      <td class="dark-row">Activo</td>
      <td class="dark-row">2019-11-17</td>
      <td>
        <div class="manageUser">
          <button type="button" onclick="" id="studentEdit2" class="modal-action-teacher">Editar</button>
          <button type="button" onclick="" id="studentDisable2">Desactivar</button>
        </div>
      </td>
    </tr>
  </table>
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

$(".modal-action-teacher").click(function(event)  {
  event.preventDefault();
  $('p.font-italic').show();
  if (!$(this).hasClass('button-send')) {
    $('#teacheradd').html('Editar');
    $('p.font-italic').hide();
    $("#modal-manage-teacher").dialog('option', 'title', 'Editar Docente');
    $('#teacherForm').prop('action', '../controlers/teacherEdit.php')
  }
	$("#modal-manage-teacher").dialog("open");
});
</script>
