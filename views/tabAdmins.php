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
              <button type="button" class="active-admin" value=<?php echo $data['id_admin'] ?>><?php echo $data['state'] === "Activo" ? 'Desactivar' : 'Activar'; ?></button>
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
      <label for="nameAdm">Nombre(s)</label>
      <input type="text" name="nameAdm" id="nameAdm" value="" placeholder="Primer y segundo nombre..." class="ui-corner-all" required>
      <label for="lastnameAdm">Apellido(s)</label>
      <input type="text" name="lastnameAdm" id="lastnameAdm" value="" placeholder="Primer y segundo apellido..." class="ui-corner-all" required>
      <label for="numdocAdm">Identificación</label>
      <input type="text" name="numdocAdm" id="numdocAdm" value="" placeholder="Número de identificación..." class="ui-corner-all" required>
      <label for="usermailAdm">Correo Electrónico</label>
      <input type="email" name="usermailAdm" id="usermailAdm" value="" placeholder="nombrecorreo@dominio.com..." class="ui-corner-all" required>
      <label for="usernameAdm">Usuario</label>
      <input type="text" name="usernameAdm" id="usernameAdm" value="" placeholder="nombreUsuario..." class="ui-corner-all" required>
      <label for="userpassAdm">Contraseña</label>
      <input type="password" name="userpassAdm" id="userpassAdm" value="" placeholder="Debe contener 8 caracteres..." class="ui-corner-all" required>
      <label for="confirmAdm">Confirmar contraseña</label>
      <input type="password" name="confirmAdm" id="confirmAdm" value="" placeholder="Debe coincidir con la anterior..." class="ui-corner-all" required>
    </fieldset>
    <button type="submit" id="manageadmin" class="button button-manage">Registrar</button>
  </form>
</div>
<div id="modal-active-admin" title="Desactivar Administrador">
  <input type="hidden" name="adminId" id="adminId" value="">
  <p>
    <span class="ui-icon" style="float:left; margin:12px 12px 20px 0;" id="activeIcon"></span>
    Este usuario Administrador: <span id="adminName"></span> será <span id="adminState"></span>.!!
  </p>
  <p>¿Está usted seguro?</p>
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
          $('#nameAdm').val(data[0].name);
          $('#lastnameAdm').val(data[0].lastname);
          $('#numdocAdm').val(data[0].document).prop('disabled', true);
          $('#usermailAdm').val(data[0].email);
          $('#usernameAdm').val(data[0].username).prop('disabled', true);
          $('#userpassAdm').val(data[0].password);
          $('#confirmAdm').val(data[0].password);
        } else {
          alert('No existe el registro! Intente de nuevo..!!');
        }
      },
      error: function(err, txt, errt) { alert('Ha ocurrido un error..!!'); }
    });
  } else {
    $('#adminForm').prop('action', '../controlers/adminAdd.php');
    $('#manageadmin').html('Registrar');
    $("#modal-manage-admin").dialog('option', 'title', 'Registrar nuevo Administrador');
  }
  $("#modal-manage-admin").dialog("open");
});

$('#adminForm').submit(function(event) {
  $('#usernameAdm').prop('disabled', false);
  $('#numdocAdm').prop('disabled', false);
  var validEmail = (/[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/gi)
                  .test($('#usermailAdm').val());
  var validPword = $('#userpassAdm').val() == $('#confirmAdm').val() ? true : false;
  return validPword && validEmail;
});

$("#modal-active-admin").dialog({
  resizable: false,
  autoOpen: false,
  width: 400,
  modal: true,
  height: "auto",
  buttons: [{
    text: "",
    click: function(event) {
      event.preventDefault();
      var adminidsw = parseInt($('#adminId').val());
      $.ajax({ url: '../controlers/adminDisable.php',
        method: 'POST',
        dataType: 'json',
        data: { 'id_admin': adminidsw },
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

$(".active-admin").click(function(event) {
  event.preventDefault();
  var adminid = $(this).prop('value');
  var adminStateSw = $(this).html() == "Desactivar" ? "Activar": "Desactivar";
  $.ajax({ url: '../controlers/getDataAdmin.php',
    method: 'POST',
    dataType: 'json',
    data: { 'id_admin': adminid },
    success: function(data) {
      if (data) {
        $('#modal-active-admin').dialog('option', 'title', (adminStateSw == "Activar" ? "Desactivar" : "Activar") + " Administrador");
        $('#adminId').val(data[0].id_user);
        $('#adminName').text(data[0].name + " " + data[0].lastname);
        $('#adminState').text(adminStateSw == "Activar" ? "desactivado" : "activado");
        adminStateSw == "Activar" ? $('#activeIcon').removeClass('ui-icon-circle-arrow-n').addClass('ui-icon-circle-arrow-s') :
        $('#activeIcon').removeClass('ui-icon-circle-arrow-s').addClass('ui-icon-circle-arrow-n');
        $('.ui-dialog > .ui-dialog-buttonpane > .ui-dialog-buttonset').children('.ui-button:nth-child(1)').text(adminStateSw == "Activar" ? "Desactivar" : "Activar");
      } else {
        alert('No existe el registro! Intente de nuevo..!!');
      }
    },
    error: function(err, txt, errt) { alert('Ha ocurrido un error..!!'); }
  });
  $("#modal-active-admin").dialog("open");
});
</script>