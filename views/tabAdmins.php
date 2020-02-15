<?php
/**
 *  Pestaña Administradores del Sitio de Gestion Academica *
 */
require_once('../models/Admin.php');
session_start();
if (isset($_SESSION) && $_SESSION['PROFILE'] == "Administrador") {
  $admin = new Admin();
  $dataAdmin = $admin->fetchAdminData($_SESSION['ID']);
}
?>
<div class="container-scroll">
  <button type="button" id="addadmin" class="button button-send action-admin">Registrar</button>
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
      $dataAdmins = $admin->fetchAllAdmins();
      foreach ($dataAdmins as $data) {
    ?>
        <tr>
          <td class=<?php echo $i % 2 == 0 ? "ui-state-highlight" : "dark-row" ?>><?php echo $data['name'].' '.$data['lastname'] ?></td>
          <td class=<?php echo $i % 2 == 0 ? "ui-state-highlight" : "dark-row" ?>><?php echo $data['username'] ?></td>
          <td class=<?php echo $i % 2 == 0 ? "ui-state-highlight" : "dark-row" ?>><?php echo $data['email'] ?></td>
          <td class=<?php echo $i % 2 == 0 ? "ui-state-highlight" : "dark-row" ?>><?php echo $data['state'] ?></td>
          <td class=<?php echo $i % 2 == 0 ? "ui-state-highlight" : "dark-row" ?>><?php echo $data['date_signup'] ?></td>
          <td>
            <div class="manageUser">
              <button type="button" class="action-admin" value=<?php echo $data['id_user'] ?>>Editar</button>
              <button type="button" class="" value="<?php echo $data['id_admin'] ?>">Desactivar</button>
            </div>
          </td>
        </tr>
    <?php
        $i++;
      }
    ?>
  </table>
</div>
<div id="modal-manage-admin">
  <p class="font-italic">Todos los campos son requeridos.</p>
  <form action="../controlers/adminAdd.php" method="POST" id="adminForm">
    <fieldset class="modal-fieldset">
      <input type="hidden" name="idadmin" id="idadmin" value="">
      <label for="name">Nombre(s)</label>
      <input type="text" name="name" id="name" value="" placeholder="Primer y segundo nombre..." class="ui-corner-all" required>
      <label for="lastname">Apellido(s)</label>
      <input type="text" name="lastname" id="lastname" value="" placeholder="Primer y segundo apellido..." class="ui-corner-all" required>
      <label for="numdocadm">Identificación</label>
      <input type="text" name="numdocadm" id="numdocadm" value="" placeholder="Número de identificación..." class="ui-corner-all" required>
      <label for="usermail">Correo Electrónico</label>
      <input type="email" name="usermail" id="usermail" value="" placeholder="nombrecorreo@dominio.com..." class="ui-corner-all" required>
      <label for="username">Usuario</label>
      <input type="text" name="username" id="username" value="" placeholder="nombreUsuario..." class="ui-corner-all" required>
      <label for="userpass">Contraseña</label>
      <input type="password" name="userpass" id="userpass" value="" placeholder="Debe contener 8 caracteres..." class="ui-corner-all" required>
      <label for="userpass">Confirmar contraseña</label>
      <input type="password" name="confirm" id="confirm" value="" placeholder="Debe coincidir con la anterior..." class="ui-corner-all" required>
    </fieldset>
    <button type="submit" id="manageadmin" class="button button-manage">Registrar</button>
  </form>
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

$(".action-admin").click(function(event)  {
  event.preventDefault();
  $('p.font-italic').show();
  if (!$(this).hasClass('button-send')) {
    $('p.font-italic').hide();
    $('#adminForm').prop('action', '../controlers/adminEdit.php');
    $('#manageadmin').html('Editar');
    $("#modal-manage-admin").dialog('option', 'title', 'Editar Administrador');
    var adminid = $(this).prop('value');
    $.ajax({ url: '../controlers/getDataAdmin.php',
      method: 'POST',
      dataType: 'json',
      data: { 'id_admin': adminid },
      success: function(data) {
        if (data) {
          $('#idadmin').val(data[0].id_admin);
          $('#name').val(data[0].name);
          $('#lastname').val(data[0].lastname);
          $('#numdocadm').val(data[0].document).prop('disabled', true);
          $('#usermail').val(data[0].email);
          $('#username').val(data[0].username).prop('disabled', true);
          $('#userpass').val(data[0].password);
          $('#confirm').val(data[0].password);
          $("#modal-manage-admin").dialog("open");
        } else {
          alert('No existe el registro! Intente de nuevo..!!');
        }
      },
      error: function(err, txt, errt) {
        console.log('Ha ocurrido un error..!!');
      }
    });
  } else {
    $('#username').prop('disabled', false);
    $('#numdocadm').prop('disabled', false);
    $('#adminForm').prop('action', '../controlers/adminAdd.php');
    $('#manageadmin').html('Registrar');
    $("#modal-manage-admin").dialog('option', 'title', 'Registrar nuevo Administrador');
    $("#modal-manage-admin").dialog("open");
  }
});
</script>