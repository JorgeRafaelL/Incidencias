$(function() {
	$('#select-project').on('change', onSelectProjectChange);

	$('[data-projectuser]').on('click', editProjectUserModal);
	$('#select-projectuser').on('change', onSelectProjectUserChange);
});

function onSelectProjectChange(){
	var project_id = $(this).val();

	if (! project_id) 
	{
		$('#select-level').html('<option value="">Seleccione nivel</option>')
		return;
	}

	//AJAX
	$.get('/api/proyecto/'+ project_id +'/niveles', function (data) {
		var html_select = '<option value="">Seleccione nivel</option>';
		for (var i = 0; i < data.length; i++) 
		{
			html_select += '<option value="'+ data[i].id +'">'+ data[i].name +'</option>';
		}
		$('#select-level').html(html_select);
		
	});
}

function onSelectProjectUserChange(){
	var project_id = $(this).val();

	if (! project_id) 
	{
		$('#select-leveluser').html('<option value="">Seleccione nivel</option>')
		return;
	}

	//AJAX
	$.get('/api/proyecto/'+ project_id +'/niveles', function (data) {
		var html_select = '<option value="">Seleccione nivel</option>';
		for (var i = 0; i < data.length; i++) 
		{
			html_select += '<option value="'+ data[i].id +'">'+ data[i].name +'</option>';
		}
		$('#select-leveluser').html(html_select);
		
	});
}
//projectuser
function editProjectUserModal(){
	//id
	//var level_id = $(this).data('level');
	//$('#level_id').val(level_id);
	//name
	//var level_name = $(this).parent().prev().text();
	//$('#level_name').val(level_name);


	
	//show
	$('#modalEditProjectUser').modal('show');
}



