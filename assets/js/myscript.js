var save_method;
var tableuser;

function getBaseUrl()
{
	var url = location.href;
	var index = url.search("index.php");
	var base_url = url.substr(0,index);
	return base_url;
}
var href = 'http://localhost/' + window.location.pathname.split('/')[1] +'/'+ window.location.pathname.split('/')[2];
// Number only
function isNumberKey(e) {
    if(event.which !=8 && isNaN(String.fromCharCode(event.which))){
		event.preventDefault();
	}
}

// menu =================================================================================
if ($(".bg-menu-theme .menu-inner > #menu-a > a").prop('href') == href) {
	$(".bg-menu-theme .menu-inner > #menu-a").addClass("active");
}else if ($(".bg-menu-theme .menu-inner > #menu-b > a").prop('href') == href) {
	$(".bg-menu-theme .menu-inner > #menu-b").addClass("active");
}else if ($(".bg-menu-theme .menu-inner > #menu-c > a").prop('href') == href) {
	$(".bg-menu-theme .menu-inner > #menu-c").addClass("active");
}else if ($(".bg-menu-theme .menu-inner > #menu-d > a").prop('href') == href) {
	$(".bg-menu-theme .menu-inner > #menu-d").addClass("active");
}else if ($(".bg-menu-theme .menu-inner > #menu-e > a").prop('href') == href) {
	$(".bg-menu-theme .menu-inner > #menu-e").addClass("active");
}else if ($(".bg-menu-theme .menu-inner > #menu-f > a").prop('href') == href) {
	$(".bg-menu-theme .menu-inner > #menu-f").addClass("active");
}else {
	$(".bg-menu-theme .menu-inner > #menu-g").addClass("active open");
}

// Function untuk kelola data user ======================================================
$(document).ready(function(){

	tableuser = $('#userTable').DataTable({ 

		"lengthChange": false,
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax": {
			"url": getBaseUrl()+"User/list_user",
			"type": "POST"
		},
		"columnDefs": [
		{ 
	            "targets": [ -1 ], //last column
	            "orderable": false, //set not orderable
	        },
	        ],

	});
})
function reloadTableUser()
{
	tableuser.ajax.reload(null,false);
}
function addUser()
{
	save_method = 'add';
	$('#formuser')[0].reset();
	$('.msg').html('');
	$('#username').attr('readonly',false);
	$('#modal_form').modal('show');
	$('.modal-title').text('Add User');
	$('#labelfoto').text('foto (tidak wajib)');
	$('#labelpassword').text('Password');
}
function saveUser()
{

	$('#btnSave').text('saving...');
	$('#btnSave').attr('disabled',true);
	var url;

	if(save_method == 'add') {
		url = getBaseUrl()+"User/add_user";
	} else {
		url = getBaseUrl()+"User/update_user";
	}

	var form = $('#formuser')[0];
	var data = new FormData(form);

	$.ajax({
		url : url,
		type: "POST",
		data: data,
		dataType: "JSON",
		enctype: 'multipart/form-data',
		processData: false,
		contentType: false,
		success: function(response)
		{

			if(response.success)
			{
				$('#btnSave').text('save');
				$('#btnSave').attr('disabled',false);
				$('#formuser')[0].reset();
				$('#modal_form').modal('hide');
				Swal.fire({
					icon: 'success',
					title: 'Saved!',
					showConfirmButton: false,
					timer: 1200
				})
				reloadTableUser();
			}
			if (response.error) {
				if (response.fullname_error != '') {
					$("#msg-fullname").html(response.fullname_error);
				}else{
					$("#msg-fullname").html("");
				}
				if (response.username_error != '') {
					$("#msg-username").html(response.username_error);
				}else{
					$("#msg-username").html("");
				}
				if (response.password_error != '') {
					$("#msg-password").html(response.password_error);
				}else{
					$("#msg-password").html("");
				}
				if (response.confirmpassword_error != '') {
					$("#msg-confirmpassword").html(response.confirmpassword_error);
				}else{
					$("#msg-confirmpassword").html("");
				}
				if (response.level_error != '') {
					$("#msg-level").html(response.level_error);
				}else{
					$("#msg-level").html("");
				}
			}
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
        	Swal.fire({
        		icon: 'error',
        		text: 'Error adding / update data!',
        		showConfirmButton: false,
        		timer: 1200
        	})
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}
function editUser(id)
{
	save_method = 'update';
	$('#formuser')[0].reset();
	$('.msg').html('');
	$('#modal_form').modal('show');
	$('#username').attr('readonly',true);
	$('.modal-title').text('Edit User');
	$('#labelfoto').text('Ganti Foto (tidak wajib)');
	$('#labelpassword').text('Ganti Password');
	$.ajax({
		url : getBaseUrl()+"User/edit_user/"+id,
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{

			$('[name="id"]').val(data.id);
			$('[name="fullname"]').val(data.nama_lengkap);
			$('[name="username"]').val(data.username);
			$('[name="level"]').val(data.level);

		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			alert('Error get data from ajax');
		}
	});
}
function deleteUser(id)
{

	Swal.fire({
		text: 'Are you sure delete this data?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#696CFF',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url : getBaseUrl()+"User/delete_user/"+id,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					Swal.fire({
						icon: 'success',
						text: 'Your data has been deleted',
						showConfirmButton: false,
						timer: 1200
					})
					reloadTableUser();
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					Swal.fire({
						icon: 'error',
						text: 'Error deleting data!',
						showConfirmButton: false,
						timer: 1500
					})
				}
			});
		}
	})
}
// End function kelola data user ============================================================

// Function kelola data karyawan ============================================================
$(document).ready(function(){

	tableAlternatif = $('#tableAlternatif').DataTable({ 

		"lengthChange": false,
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax": {
			"url": getBaseUrl()+"Alternatif/list_alternatif",
			"type": "POST"
		},
		"columnDefs": [
		{ 
	            "targets": [ -1 ], //last column
	            "orderable": false, //set not orderable
	        },
	        ],

	});
})
function reloadTableAlternatif()
{
	tableAlternatif.ajax.reload(null,false);
}
function addAlternatif()
{
	save_method = 'add';
	$('#formAlternatif')[0].reset();
	$('.msg').html('');
	$('#nik').attr('readonly',false);
	$('#modal_form').modal('show');
	$('.modal-title').text('Add Alternatif');
}
function saveAlternatif()
{

	$('#btnSave').text('saving...');
	$('#btnSave').attr('disabled',true);
	var url;

	if(save_method == 'add') {
		url = getBaseUrl()+"Alternatif/add_alternatif";
	} else {
		url = getBaseUrl()+"Alternatif/update_alternatif";
	}

	var form = $('#formAlternatif')[0];
	var data = new FormData(form);

	$.ajax({
		url : url,
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		dataType: "JSON",
		success: function(response)
		{

			if(response.success)
			{
				$('#btnSave').text('save');
				$('#btnSave').attr('disabled',false);
				$('#formAlternatif')[0].reset();
				$('#modal_form').modal('hide');
				Swal.fire({
					icon: 'success',
					title: 'Saved!',
					showConfirmButton: false,
					timer: 1200
				})
				reloadTableAlternatif();
			}
			if (response.error) {
				if (response.nik_error != '') {
					$("#msg-nik").html(response.nik_error);
				}else{
					$("#msg-nik").html("");
				}
				if (response.nama_error != '') {
					$("#msg-nama").html(response.nama_error);
				}else{
					$("#msg-nama").html("");
				}
				if (response.tempatlahir_error != '') {
					$("#msg-tempatlahir").html(response.tempatlahir_error);
				}else{
					$("#msg-tempatlahir").html("");
				}
				if (response.alamat_error != '') {
					$("#msg-alamat").html(response.alamat_error);
				}else{
					$("#msg-alamat").html("");
				}
			}
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
        	Swal.fire({
        		icon: 'error',
        		text: 'Error adding / update data!',
        		showConfirmButton: false,
        		timer: 1200
        	})
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}
function editAlternatif(id)
{
	save_method = 'update';
	$('#formAlternatif')[0].reset();
	$('.msg').html('');
	$('#modal_form').modal('show');
	$('#nik').attr('readonly',true);
	$('.modal-title').text('Edit Alternatif');
	$.ajax({
		url : getBaseUrl()+"Alternatif/edit_alternatif/"+id,
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{
			$('[name="nik"]').val(data.nik);
			$('[name="nama"]').val(data.nama);
			$('[name="tempatlahir"]').val(data.tempat_lahir);
			$('[name="tgl_lahir"]').val(data.tgl_lahir);
			$('[name="jk"]').val(data.kelamin);
			$('[name="alamat"]').val(data.alamat);

		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			alert('Error get data from ajax');
		}
	});
}
function deleteAlternatif(id)
{

	Swal.fire({
		text: 'Are you sure delete this data?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#696CFF',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url : getBaseUrl()+"Alternatif/delete_alternatif/"+id,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					Swal.fire({
						icon: 'success',
						text: 'Your data has been deleted',
						showConfirmButton: false,
						timer: 1200
					})
					reloadTableAlternatif();
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					Swal.fire({
						icon: 'error',
						text: 'Error deleting data!',
						showConfirmButton: false,
						timer: 1500
					})
				}
			});
		}
	})
}
// End function kelola data Alternatif ============================================================
// Function kelola data kriteria ============================================================
$(document).ready(function(){

	tableKriteria = $('#tableKriteria').DataTable({ 

		"lengthChange": false,
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax": {
			"url": getBaseUrl()+"Kriteria/list_kriteria",
			"type": "POST"
		},
		"columnDefs": [
		{ 
	            "targets": [ -1 ], //last column
	            "orderable": false, //set not orderable
	        },
	        ],

	});
})
function reloadTableKriteria()
{
	tableKriteria.ajax.reload(null,false);
}
// Sub Kriteria
$(document).ready(function(){
	var idkriteria = $('input[name="idkriteria"]').val();
	tableSubKriteria = $('#tableSubKriteria').DataTable({ 
		"lengthChange": false,
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax": {
			"url": href+"/list_subkriteria",
			"type": "POST",
			"data": {
                    idkriteria:idkriteria
                }
		},
		"columnDefs": [
		{ 
	            "targets": [ -1 ], //last column
	            "orderable": false, //set not orderable
	        },
	        ],

	});
});
function reloadTableSubKriteria()
{
	tableSubKriteria.ajax.reload(null,false);
}
function addKriteria()
{
	save_method = 'add';
	$('#formKriteria')[0].reset();
	$('.msg').html('');
	$('#modal_form').modal('show');
	$('.modal-title').text('Add Kriteria');
}
function addSubKriteria()
{
	save_method = 'add';
	$('#formSubKriteria')[0].reset();
	$('.msg').html('');
	$('#modal_form').modal('show');
	$('.modal-title').text('Add Sub Kriteria');
}
function saveKriteria()
{

	$('#btnSave').text('saving...');
	$('#btnSave').attr('disabled',true);
	var url;

	if(save_method == 'add') {
		url = getBaseUrl()+"Kriteria/add_kriteria";
	} else {
		url = getBaseUrl()+"Kriteria/update_kriteria";
	}

	var form = $('#formKriteria')[0];
	var data = new FormData(form);

	$.ajax({
		url : url,
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		dataType: "JSON",
		success: function(response)
		{

			if(response.success)
			{
				$('#btnSave').text('save');
				$('#btnSave').attr('disabled',false);
				$('#formKriteria')[0].reset();
				$('#modal_form').modal('hide');
				Swal.fire({
					icon: 'success',
					title: 'Saved!',
					showConfirmButton: false,
					timer: 1200
				})
				reloadTableKriteria();
			}
			if (response.error) {
				if (response.kriteria_error != '') {
					$("#msg-kriteria").html(response.kriteria_error);
				}else{
					$("#msg-kriteria").html("");
				}
			}
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
        	Swal.fire({
        		icon: 'error',
        		text: 'Error adding / update data!',
        		showConfirmButton: false,
        		timer: 1200
        	})
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}
function saveSubKriteria()
{

	$('#btnSave').text('saving...');
	$('#btnSave').attr('disabled',true);
	var url;

	if(save_method == 'add') {
		url = href+"/add_subkriteria";
	} else {
		url = href+"/update_subkriteria";
	}

	var form = $('#formSubKriteria')[0];
	var data = new FormData(form);

	$.ajax({
		url : url,
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		dataType: "JSON",
		success: function(response)
		{

			if(response.success)
			{
				$('#btnSave').text('save');
				$('#btnSave').attr('disabled',false);
				$('#formSubKriteria')[0].reset();
				$('#modal_form').modal('hide');
				Swal.fire({
					icon: 'success',
					title: 'Saved!',
					showConfirmButton: false,
					timer: 1200
				})
				reloadTableSubKriteria();
			}
			if (response.error) {
				if (response.subkriteria_error != '') {
					$("#msg-subkriteria").html(response.subkriteria_error);
				}else{
					$("#msg-subkriteria").html("");
				}
			}
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
        	Swal.fire({
        		icon: 'error',
        		text: 'Error adding / update data!',
        		showConfirmButton: false,
        		timer: 1200
        	})
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}
function editKriteria(id)
{
	save_method = 'update';
	$('#formKriteria')[0].reset();
	$('.msg').html('');
	$('#modal_form').modal('show');
	$('.modal-title').text('Edit Kriteria');
	$.ajax({
		url : getBaseUrl()+"Kriteria/edit_kriteria/"+id,
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{

			$('[name="id"]').val(data.id);
			$('[name="kriteria"]').val(data.kriteria);

		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			alert('Error get data from ajax');
		}
	});
}
function editSubKriteria(id)
{
	save_method = 'update';
	$('#formSubKriteria')[0].reset();
	$('.msg').html('');
	$('#modal_form').modal('show');
	$('.modal-title').text('Edit Sub Kriteria');
	$.ajax({
		url : href+"/edit_subkriteria/"+id,
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{

			$('[name="id"]').val(data.id);
			$('[name="subkriteria"]').val(data.subkriteria);

		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			alert('Error get data from ajax');
		}
	});
}
function deleteKriteria(id)
{

	Swal.fire({
		text: 'Are you sure delete this data?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#696CFF',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url : getBaseUrl()+"Kriteria/delete_kriteria/"+id,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					Swal.fire({
						icon: 'success',
						text: 'Your data has been deleted',
						showConfirmButton: false,
						timer: 1200
					})
					reloadTableKriteria();
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					Swal.fire({
						icon: 'error',
						text: 'Error deleting data!',
						showConfirmButton: false,
						timer: 1500
					})
				}
			});
		}
	})
}
function deleteSubKriteria(id)
{

	Swal.fire({
		text: 'Are you sure delete this data?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#696CFF',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url : href+"/delete_subkriteria/"+id,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					Swal.fire({
						icon: 'success',
						text: 'Your data has been deleted',
						showConfirmButton: false,
						timer: 1200
					})
					reloadTableSubKriteria();
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					Swal.fire({
						icon: 'error',
						text: 'Error deleting data!',
						showConfirmButton: false,
						timer: 1500
					})
				}
			});
		}
	})
}
// End Function kelola data kriteria ============================================================
// Function kelola data penilaian ============================================================
$(document).ready(function(){

	tablePenilaian = $('#tablePenilaian').DataTable({ 

		"lengthChange": false,
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax": {
			"url": getBaseUrl()+"Penilaian/list_penilaian",
			"type": "POST"
		},
		"columnDefs": [
		{ 
	            "targets": [ -1 ], //last column
	            "orderable": false, //set not orderable
	        },
	        ],

	});
})
function reloadTablePenilaian()
{
	tablePenilaian.ajax.reload(null,false);
}
function addPenilaian()
{
	save_method = 'add';
	$('#formPenilaian')[0].reset();
	$('.msg').html('');
	$('#kodec').val('');
	$('#modal_form').modal('show');
	$('.modal-title').text('Add Penilaian');

	$.ajax({
		url : getBaseUrl()+"Penilaian/getform",
		method : "POST",
		async : true,
		dataType : 'json',
		success: function(data){

			$('#load-soal').html(data.result.html);

			var dta = '<option value=""> -- Pilih Alternatif -- </option>';
			var i;
			for(i=0; i < data.result.alternatif.length; i++){
				dta += "<option value='"+data.result.alternatif[i].nik+"'>"+data.result.alternatif[i].nik+" - "+data.result.alternatif[i].nama+"</option>";
			}
			$('#alternatif').html(dta).removeAttr('disabled');

		}
	});
}

function savePenilaian()
{

	$('#btnSave').text('saving...');
	$('#btnSave').attr('disabled',true);
	var url;

	if(save_method == 'add') {
		url = getBaseUrl()+"Penilaian/add_penilaian";
	} else {
		url = getBaseUrl()+"Penilaian/add_penilaian";
	}

	var form = $('#formPenilaian')[0];
	var data = new FormData(form);

	$.ajax({
		url : url,
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		dataType: "JSON",
		success: function(response)
		{

			if(response.success)
			{
				$('#btnSave').text('save');
				$('#btnSave').attr('disabled',false);
				$('#formPenilaian')[0].reset();
				$('#modal_form').modal('hide');
				Swal.fire({
					icon: 'success',
					title: 'Saved!',
					showConfirmButton: false,
					timer: 1200
				})
				reloadTablePenilaian();
			}
			if (response.errors.error) {
				Swal.fire({
					icon: 'warning',
					title: 'Periksa pilihan alternatif atau soal!',
					text: 'Pastikan semua soal telah terisi',
					confirmButtonText: 'Close'
				})
			}
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
        	Swal.fire({
        		icon: 'error',
        		text: 'Error adding / update data!',
        		showConfirmButton: false,
        		timer: 1200
        	})
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

function editPenilaian(nik,periode)
{
	save_method = 'update';
	$('#formPenilaian')[0].reset();
	$('.msg').html('');
	$('#modal_form').modal('show');
	$('.modal-title').text('Edit Penilaian');
	$.ajax({
		url : getBaseUrl()+"Penilaian/edit_penilaian/"+nik+'/'+periode,
		type: "POST",
		dataType: "JSON",
		success: function(data)
		{

			$('#load-soal').html(data.result.html);

			var dta = '';
			var i;
			for(i=0; i < data.result.alternatif.length; i++){
				dta += "<option value='"+data.result.alternatif[i].nik+"' selected>"+data.result.alternatif[i].nik+" - "+data.result.alternatif[i].nama+"</option>";
			}
			$('#alternatif').html(dta);

		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			alert('Error get data from ajax');
		}
	});
}
function deletePenilaian(id)
{

	Swal.fire({
		text: 'Are you sure delete this data?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#696CFF',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url : getBaseUrl()+"Penilaian/delete_penilaian/"+id,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					Swal.fire({
						icon: 'success',
						text: 'Your data has been deleted',
						showConfirmButton: false,
						timer: 1200
					})
					reloadTablePenilaian();
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					Swal.fire({
						icon: 'error',
						text: 'Error deleting data!',
						showConfirmButton: false,
						timer: 1500
					})
				}
			});
		}
	})
}

function penilaianUlang(){

	Swal.fire({
		text: 'Penilaian ulang akan menghapus semua data penilaian?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#696CFF',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Ya, Lakukan!'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url : getBaseUrl()+"penilaian/truncatepenilaian",
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					Swal.fire({
						icon: 'success',
						text: 'Your data has been deleted',
						showConfirmButton: false,
						timer: 1200
					})
					reloadTablePenilaian();
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					Swal.fire({
						icon: 'error',
						text: 'Error deleting data!',
						showConfirmButton: false,
						timer: 1500
					})
				}
			});
		}
	})

}

function funcPerhitungan(){
	$.ajax({
		url : getBaseUrl()+"Laporan/perhitungan",
		method : 'POST',
		// dataType: "JSON",
		success:function(result){
			// console.log(result);
			if (result == 'false') {
				Swal.fire({
	        		icon: 'error',
	        		text: 'Maaf data penilaian masih kosong, Anda tidak dapat melakukan perhitungan!',
	        		showConfirmButton: false,
	        		timer: 2000
	        	});
			}else{
				$("#load-perhitungan").html(result);
			}
		}
	})
}

function cetakHasil(){
	$.ajax({
		url : getBaseUrl()+"Laporan/cetakhasil",
		method : 'POST',
		success : function(result){
			var link=document.createElement('a');
			link.href=window.URL = getBaseUrl()+"hasilperankingan.pdf";
			link.download=result.nombre_archivo;
  			link.click();
  			// hideLoad();
		}
	});
}