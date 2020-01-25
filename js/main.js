
/**
 *  Scripts en Jquery para la carga de Elementos //**
 */
$(".manageUser").controlgroup();
$(".button").button();

$("#modal-manage-admin, #modal-manage-teacher, #modal-manage-student").dialog({
	autoOpen: false,
	width: 500,
	modal: true,
	close: function(event) {
		event.preventDefault();
		if ($(this).prop('id') == 'modal-manage-admin') {
			$('#adminForm')[0].reset();
		} else if ($(this).prop('id') == 'modal-manage-teacher') {
			$('#teacherForm')[0].reset();
		} else if ($(this).prop('id') == 'modal-manage-student') {
			$('#studentForm')[0].reset();
		}
	}
});

$(".modal-action-admin, .modal-action-teacher, .modal-action-student").click(function(event)  {
	event.preventDefault();
	if ($(this).hasClass('modal-action-admin')) {
		$("#modal-manage-admin").dialog("open");
	} else if ($(this).hasClass('modal-action-teacher')) {
		$("#modal-manage-teacher").dialog("open");
	} else if ($(this).hasClass('modal-action-student')) {
		$("#modal-manage-student").dialog("open");
	}
});

/*$( "#radioset" ).buttonset();

$( "#controlgroup" ).controlgroup();

$( "#tabs" ).tabs();

$( "#dialog" ).dialog({
	autoOpen: false,
	width: 400,
	buttons: [
		{
			text: "Ok",
			click: function() {
				$( this ).dialog( "close" );
			}
		},
		{
			text: "Cancel",
			click: function() {
				$( this ).dialog( "close" );
			}
		}
	]
});

// Link to open the dialog
$( "#dialog-link" ).click(function( event ) {
	$( "#dialog" ).dialog( "open" );
	event.preventDefault();
});

$( "#datepicker" ).datepicker({
	inline: true
});

$( "#progressbar" ).progressbar({
	value: 20
});

$( "#tooltip" ).tooltip();

// Hover states on the static widgets
$( "#dialog-link, #icons li" ).hover(
	function() {
		$( this ).addClass( "ui-state-hover" );
	},
	function() {
		$( this ).removeClass( "ui-state-hover" );
	}*/