<?php
/**
 *  Pestaña Administradores del Sitio de Gestion Academica *
 */

?>
<div id="modal-manage-admin" title="Registrar nuevo Administrador">
  <p class="font-italic">Todos los campos son requeridos.</p>
  <form action="../controlers/adminAdd.php" method="POST" id="adminForm">
    <fieldset class="modal-fieldset">
      <input type="hidden" name="idadmin" id="idadmin" value="">
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
    <button type="submit" id="adminadd" class="button button-add">Registrar</button>
  </form>
</div>
<div class="container-scroll">
  <button type="button" id="addadmin" class="button button-send modal-action-admin">Registrar</button>
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
      <td class="ui-state-highlight">Luciano Carlos Alamo Planchart</td>
      <td class="ui-state-highlight">lucalamo</td>
      <td class="ui-state-highlight">lucianoaplt@academia.com</td>
      <td class="ui-state-highlight">Activo</td>
      <td class="ui-state-highlight">2019-09-28</td>
      <td>
        <div class="manageUser">
          <button type="button" id="adminEdit1" class="modal-action-admin">Editar</button>
          <button type="button" id="adminDisable1">Desactivar</button>
        </div>
      </td>
    </tr>
    <tr>
      <td class="dark-row">Miguel Angel Ramos Alvarado</td>
      <td class="dark-row">mikeramos</td>
      <td class="dark-row">mikeramos29@academia.com</td>
      <td class="dark-row">Activo</td>
      <td class="dark-row">2019-10-12</td>
      <td>
        <div class="manageUser">
          <button type="button" id="adminEdit2" class="modal-action-admin">Editar</button>
          <button type="button" id="adminDisable2">Desactivar</button>
        </div>
      </td>
    </tr>
  </table>
</div>
<script type="text/javascript">
$(".manageUser").controlgroup();
$(".button").button();

$("#modal-manage-admin").dialog({
	autoOpen: false,
	width: 500,
	modal: true,
	close: function(event) {
		event.preventDefault();
	  $('#adminForm')[0].reset();
	}
});

$(".modal-action-admin").click(function(event)  {
  event.preventDefault();
  $('p.font-italic').show();
  if (!$(this).hasClass('button-send')) {
    $('#adminadd').html('Editar');
    $('p.font-italic').hide();
    $("#modal-manage-admin").dialog('option', 'title', 'Editar Administrador');
    $('#adminForm').prop('action', '../controlers/adminEdit.php')
  }
	$("#modal-manage-admin").dialog("open");
});
</script>
