<?php
/**
 *  Pestaña Materias del Sitio de Gestion Academica *
 */
require_once('../models/Subject.php');
session_start();
if (isset($_SESSION) && ($_SESSION['PROFILE'] == "Administrador" || $_SESSION['PROFILE'] == "Docente")) {
  $subject = new Subject();
}
?>
<div class="container-scroll">
  <button type="button" id="addsubject" class="button button-send action-subject">Registrar</button>
  <table>
    <tr>
      <th width="80%"><h3>Nombre de Materia</h3></th>
      <th><h3>Acciones</h3></th>
    </tr>
    <?php
      $i = 0;
      $datasubjects = $subject->fetchAllSubjects();
      foreach ($datasubjects as $data) {
    ?>
        <tr>
          <td class=<?php echo $i % 2 == 0 ? "ui-state-highlight" : "dark-row" ?>><?php echo $data['subjectmatter'] ?></td>
          <td>
            <div class="manageUser">
              <button type="button" class="action-subject" value=<?php echo $data['id_subject'] ?>>Editar</button>
            </div>
          </td>
        </tr>
    <?php
        $i++;
      }
    ?>
  </table>
</div>
<div id="modal-manage-subject">
  <p class="font-italic">El nombre de la materia es requerido.</p>
  <form action="../controlers/subjectAdd.php" method="POST" id="subjectForm">
    <fieldset class="modal-fieldset">
      <input type="hidden" name="idsubject" id="idsubject" value="">
      <label for="subjectMatter">Nombre Marteria</label>
      <input type="text" name="subjectMatter" id="subjectMatter" value="" placeholder="Nombre de la materia o asignatura..." class="ui-corner-all" required>
    </fieldset>
    <button type="submit" id="managesubject" class="button button-manage">Registrar</button>
  </form>
</div>
<script type="text/javascript">
$(".manageUser").controlgroup();
$(".button").button();

$("#modal-manage-subject").dialog({
  resizable: false,
	autoOpen: false,
	width: 400,
	modal: true,
	close: function(event) {
		event.preventDefault();
		$('#subjectForm')[0].reset();
	}
});

$(".action-subject").click(function(event) {
  event.preventDefault();
  $('p.font-italic').show();
  if (!$(this).hasClass('button-send')) {
    $('p.font-italic').hide();
    $('#subjectForm').prop('action', '../controlers/subjectEdit.php')
    $('#managesubject').html('Editar');
    $("#modal-manage-subject").dialog('option', 'title', 'Editar Materia');
    var subjectid = $(this).prop('value');
    $.ajax({ url: '../controlers/getDataSubject.php',
      method: 'POST',
      dataType: 'json',
      data: { 'id_subject': subjectid },
      success: function(data) {
        if (data) {
          $('#idsubject').val(data.id_subject);
          $('#subjectMatter').val(data.subjectmatter);
        } else {
          alert('No existe el registro! Intente de nuevo..!!');
        }
      },
      error: function(err, txt, errt) {
        console.log('Ha ocurrido un error..!!');
      }
    });
  } else {
    $('#subjectForm').prop('action', '../controlers/subjectAdd.php');
    $('#managesubject').html('Registrar');
    $("#modal-manage-subject").dialog('option', 'title', 'Registrar nueva Materia');
  }
	$("#modal-manage-subject").dialog("open");
});

$('#subjectForm').submit(function(event) {
  var validSubject = $('#subjectMatter').val().length >= 6 ? true : false;
  return validSubject;
});
</script>
