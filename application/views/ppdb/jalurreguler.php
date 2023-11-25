<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/frontend/assets/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/frontend/assets/css/wizard.css">

<main id="main">
	<!-- ======= Events Section ======= -->
	<section id="events" class="events">
		<div class="container" data-aos="fade-up">

			<div class="row">
				<!-- MultiStep Form -->
				<div class="container-fluid" id="grad1">
					<div class="row justify-content-center mt-0">
						<div class="col-12 text-center p-0 mb-2">
							<div class="card px-0 pt-4 pb-0 mt-3 mb-3">
								<div class="row">
									<div class="col-md-12 mx-0">
										<form id="msform">
											<!-- progressbar -->
											<ul id="progressbar">
												<li class="checklist active" id="personal"><strong>Data Diri</strong></li>
												<li class="checklist" id="ortu"><strong>Orang Tua</strong></li>
												<li class="checklist" id="sekolahasal"><strong>Sekolah Asal</strong></li>
												<li class="checklist" id="nilaiujiannasional"><strong>Nilai Ujian Nasional</strong></li>
												<!-- <li class="checklist" id="confirm"><strong>Selesai</strong></li> -->
											</ul>
											<!-- fieldsets -->
											<fieldset>
												<div class="form-card">
													<h5><b>Data Diri</b></h5>
													<div class="col-md-12">
														<div class="form-group">
															<label class="mt-2">Nama Lengkap</label>
															<input type="text" name="nama_siswa" class="form-control">
														</div>
														<div class="form-group">
															<label class="mt-2">NISN</label>
															<input type="text" name="nisn" class="form-control">
														</div>
														<div class="form-group">
															<label class="mt-2">Tempat Lahir</label>
															<input type="text" name="tmpl_siswa" class="form-control">
														</div>
														<div class="form-group">
															<label class="mt-2">Tanggal Lahir</label>
															<input type="date" name="tgll_siswa" class="form-control">
														</div>
														<div class="form-group">
															<label class="mt-2">Jenis Kelamin</label>
															<br>
															<div class="form-check form-check-inline">
																<input class="form-check-input" type="radio" name="jk_siswa" id="jk_siswa1" value="Laki - Laki">
																<label class="form-check-label" for="jk_siswa1">Laki - Laki</label>
															</div>
															<div class="form-check form-check-inline">
																<input class="form-check-input" type="radio" name="jk_siswa" id="jk_siswa2" value="Perempuan">
																<label class="form-check-label" for="jk_siswa2">Perempuan</label>
															</div>
															<br>
														</div>
														<div class="form-group">
															<label class="mt-2">Agama</label>
															<br>
															<div class="form-check form-check-inline">
																<input class="form-check-input" type="radio" name="agama_siswa" id="agama_siswa1" value="Islam">
																<label class="form-check-label" for="agama_siswa1">Islam</label>
															</div>
															<div class="form-check form-check-inline">
																<input class="form-check-input" type="radio" name="agama_siswa" id="agama_siswa2" value="Kristen">
																<label class="form-check-label" for="agama_siswa2">Kristen</label>
															</div>
															<div class="form-check form-check-inline">
																<input class="form-check-input" type="radio" name="agama_siswa" id="agama_siswa3" value="Katolik">
																<label class="form-check-label" for="agama_siswa3">Katolik</label>
															</div>
															<div class="form-check form-check-inline">
																<input class="form-check-input" type="radio" name="agama_siswa" id="agama_siswa4" value="Hindu">
																<label class="form-check-label" for="agama_siswa4">Hindu</label>
															</div>
															<div class="form-check form-check-inline">
																<input class="form-check-input" type="radio" name="agama_siswa" id="agama_siswa5" value="Budha">
																<label class="form-check-label" for="agama_siswa5">Budha</label>
															</div>
															<br>
														</div>
														<div class="form-group">
															<label class="mt-2">Alamat</label>
															<textarea class="form-control" name="alamat_siswa"></textarea>
														</div>
													</div>
												</div>
												<input type="button" name="next" class="next action-button" value="Selanjutnya"/>
											</fieldset>
											<fieldset>
												<div class="form-card">
													<div class="row">
														<div class="col-md-6">
															<h5><b>Data Ayah</b></h5>
															<div class="form-group">
																<label class="mt-2">Nama Ayah</label>
																<input type="text" name="nama_ayah" class="form-control">
															</div>
															<div class="form-group">
																<label class="mt-2">Tempat Lahir Ayah</label>
																<input type="text" name="tmpl_ayah" class="form-control">
															</div>
															<div class="form-group">
																<label class="mt-2">Tanggal Lahir Ayah</label>
																<input type="date" name="tgll_ayah" class="form-control">
															</div>
															<div class="form-group">
																<label class="mt-2">Agama Ayah</label>
																<br>
																<div class="form-check form-check-inline">
																	<input class="form-check-input" type="radio" name="agama_ayah" id="agama_ayah1" value="Islam">
																	<label class="form-check-label" for="agama_ayah1">Islam</label>
																</div>
																<div class="form-check form-check-inline">
																	<input class="form-check-input" type="radio" name="agama_ayah" id="agama_ayah2" value="Kristen">
																	<label class="form-check-label" for="agama_ayah2">Kristen</label>
																</div>
																<div class="form-check form-check-inline">
																	<input class="form-check-input" type="radio" name="agama_ayah" id="agama_ayah3" value="Katolik">
																	<label class="form-check-label" for="agama_ayah3">Katolik</label>
																</div>
																<div class="form-check form-check-inline">
																	<input class="form-check-input" type="radio" name="agama_ayah" id="agama_ayah4" value="Hindu">
																	<label class="form-check-label" for="agama_ayah4">Hindu</label>
																</div>
																<div class="form-check form-check-inline">
																	<input class="form-check-input" type="radio" name="agama_ayah" id="agama_ayah5" value="Budha">
																	<label class="form-check-label" for="agama_ayah5">Budha</label>
																</div>
																<br>
															</div>
															<div class="form-group">
																<label class="mt-2">Kewarganeagaraan Ayah</label>
																<input type="text" name="wargan_ayah" class="form-control">
															</div>
															<div class="form-group">
																<label class="mt-2">No Telp Ayah</label>
																<input type="text" name="tlp_ayah" class="form-control">
															</div>
															<div class="form-group">
																<label class="mt-2">Alamat Ayah</label>
																<textarea class="form-control" name="alamat_ayah"></textarea>
															</div>
														</div>
														<div class="col-md-6">
															<h5><b>Data Ibu</b></h5>
															<div class="form-group">
																<label class="mt-2">Nama Ibu</label>
																<input type="text" name="nama_ibu" class="form-control">
															</div>
															<div class="form-group">
																<label class="mt-2">Tempat Lahir Ibu</label>
																<input type="text" name="tmpl_ibu" class="form-control">
															</div>
															<div class="form-group">
																<label class="mt-2">Tanggal Lahir Ibu</label>
																<input type="date" name="tgll_ibu" class="form-control">
															</div>
															<div class="form-group">
																<label class="mt-2">Agama Ibu</label>
																<br>
																<div class="form-check form-check-inline">
																	<input class="form-check-input" type="radio" name="agama_ibu" id="agama_ibu1" value="Islam">
																	<label class="form-check-label" for="agama_ibu1">Islam</label>
																</div>
																<div class="form-check form-check-inline">
																	<input class="form-check-input" type="radio" name="agama_ibu" id="agama_ibu2" value="Kristen">
																	<label class="form-check-label" for="agama_ibu2">Kristen</label>
																</div>
																<div class="form-check form-check-inline">
																	<input class="form-check-input" type="radio" name="agama_ibu" id="agama_ibu3" value="Katolik">
																	<label class="form-check-label" for="agama_ibu3">Katolik</label>
																</div>
																<div class="form-check form-check-inline">
																	<input class="form-check-input" type="radio" name="agama_ibu" id="agama_ibu4" value="Hindu">
																	<label class="form-check-label" for="agama_ibu4">Hindu</label>
																</div>
																<div class="form-check form-check-inline">
																	<input class="form-check-input" type="radio" name="agama_ibu" id="agama_ibu5" value="Budha">
																	<label class="form-check-label" for="agama_ibu5">Budha</label>
																</div>
																<br>
															</div>
															<div class="form-group">
																<label class="mt-2">Kewarganeagaraan Ibu</label>
																<input type="text" name="wargan_ibu" class="form-control">
															</div>
															<div class="form-group">
																<label class="mt-2">No Telp Ibu</label>
																<input type="text" name="tlp_ibu" class="form-control">
															</div>
															<div class="form-group">
																<label class="mt-2">Alamat Ibu</label>
																<textarea class="form-control" name="alamat_ibu"></textarea>
															</div>
														</div>
													</div>
												</div>
												<input type="button" name="previous" class="previous action-button-previous" value="Kembali"/>
												<input type="button" name="next" class="next action-button" value="Selanjutnya"/>
											</fieldset>
											<fieldset>
												<div class="form-card">
													<h5><b>Sekolah Asalah</b></h5>
													<div class="col-md-12">
														<div class="form-group">
															<label class="mt-2">Pilih Sekolah</label>
															<select class="form-control" name="sekolahasal">
																<option value="">-- Pilih Sekolah --</option>
																<?php foreach ($sekolah_asal as $key => $sa): ?>
																	<option value="<?= $sa->id; ?>"><?= $sa->nama_sekolah; ?></option>
																<?php endforeach ?>
															</select>
															<div class="form-group">
																<label class="mt-2">Kota / kabupaten</label>
																<input type="text" name="kota_sekolahasal" class="form-control" value="-" readonly>
															</div>
															<div class="form-group">
																<label class="mt-2">Alamat Sekolah</label>
																<textarea class="form-control" name="alamat_sekolahasal" readonly>-</textarea>
															</div>
														</div>
													</div>
												</div>
												<input type="button" name="previous" class="previous action-button-previous" value="Kembali"/>
												<input type="button" name="next" class="next action-button" value="Selanjutnya"/>
											</fieldset>
											<fieldset>
												<div class="form-card">
													<h5><b>Nilai Ujian Nasional</b></h5>
													<div class="col-md-12">
														<div class="form-group">
															<label class="mt-2">Bahasa Indonesia</label>
															<input type="number" name="bhs_indo" class="form-control nilai" value="0" min="0" max="100">
														</div>
														<div class="form-group">
															<label class="mt-2">Bahasa Inggris</label>
															<input type="number" name="bhs_ingg" class="form-control nilai" value="0" min="0" max="100">
														</div>
														<div class="form-group">
															<label class="mt-2">Matematika</label>
															<input type="number" name="matematika" class="form-control nilai" value="0" min="0" max="100">
														</div>
														<br>
														<div class="form-group">
															<label class="mt-2">Jumlah Nilai UN</label>
															<input type="number" name="jmlnilai" class="form-control" value="0" readonly>
														</div>
														<div class="form-group">
															<label class="mt-2">Nilai Rata-Rata</label>
															<input type="number" name="nilairata" class="form-control" value="0" readonly>
														</div>
														<div class="form-group">
															<label class="mt-2">File scan ijazah atau SKHUN</label>
															<input type="file" name="fileijazah" class="form-control">
														</div>
													</div>
												</div>
												<input type="button" name="previous" class="previous action-button-previous" value="Kembali"/>
												<input type="button" class="action-button" id="btnDaftar" onclick="daftar()" value="Daftar"/>
											</fieldset>
		                            <!-- <fieldset>
		                                <div class="form-card">
		                                    <h2 class="fs-title text-center">Success !</h2>
		                                    <br><br>
		                                    <div class="row justify-content-center">
		                                        <div class="col-3">
		                                            <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image">
		                                        </div>
		                                    </div>
		                                    <br><br>
		                                    <div class="row justify-content-center">
		                                        <div class="col-7 text-center">
		                                            <h5>You Have Successfully Signed Up</h5>
		                                        </div>
		                                    </div>
		                                </div>
		                            </fieldset> -->
		                        </form>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>

	</div>

</div>
</section>
</main>

<script src="<?= base_url(); ?>assets/js/jquery-3.6.1.min.js"></script>
<script src="<?= base_url(); ?>assets/frontend/assets/js/sweetalert2@11.js"></script>

<script type="text/javascript">
	$(document).ready(function(){

	var current_fs, next_fs, previous_fs; //fieldsets
	var opacity;

	$(".next").click(function(){

		current_fs = $(this).parent();
		next_fs = $(this).parent().next();

		if (validateFields(current_fs)) {

		    //Add Class Active
			$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

		    //show the next fieldset
			next_fs.show(); 
		    //hide the current fieldset with style
			current_fs.animate({opacity: 0}, {
				step: function(now) {
		            // for making fielset appear animation
					opacity = 1 - now;

					current_fs.css({
						'display': 'none',
						'position': 'relative'
					});
					next_fs.css({'opacity': opacity});
				}, 
				duration: 600
			});
		}
	});


	$("input[type=number]").on("change", function () {
		var valbhsindo = parseFloat($('input[name="bhs_indo"]').val()) || 0;
		var valbhsingg = parseFloat($('input[name="bhs_ingg"]').val()) || 0;
		var valmtk = parseFloat($('input[name="matematika"]').val()) || 0;

		if (valbhsindo != 0) {
			$('input[name="bhs_indo"]').css("border", "");
		}
		if (valbhsingg != 0) {
			$('input[name="bhs_ingg"]').css("border", "");
		}
		if (valmtk != 0) {
			$('input[name="matematika"]').css("border", "");
		}

		var tot_nilai = valbhsindo + valbhsingg + valmtk;
		var rata_2 = parseFloat((Math.ceil((tot_nilai /3) * 1000) / 1000).toFixed(3));
		$('input[name="jmlnilai"]').val(tot_nilai);
		$('input[name="nilairata"]').val(rata_2);
	})

	function validateFields(fieldset) {
        // Add your validation logic here
		var isValid = true;

		fieldset.find("input[type=text], input[type=date], input[type=radio],input[type=number],select, textarea, input[type=file]").each(function () {
		// fieldset.find("input[type=number].nilai,input[type=file]").each(function () {
			if ($(this).is(':radio')) {
	            // Check if at least one radio button in the group is checked
				if ($('input[name="' + $(this).attr('name') + '"]:checked').length === 0) {
					isValid = false;
					$(this).css("border", "1px solid red");
				} else {
					$(this).css("border", "");
				}
			}else if ($(this).is(':file')) {
            // Check if a file has been selected
				if ($(this).get(0).files.length === 0) {
					isValid = false;
					$(this).css("border", "1px solid red");
				} else {
					$(this).css("border", "");
				}
			} else {
				if ($(this).val().trim() === "") {
					isValid = false;
					$(this).css("border", "1px solid red");
				} else {
					$(this).css("border", "");
				}
			}
		});

		return isValid;
	}

	$(".previous").click(function(){

		current_fs = $(this).parent();
		previous_fs = $(this).parent().prev();

	    //Remove class active
		$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

	    //show the previous fieldset
		previous_fs.show();

	    //hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
			step: function(now) {
	            // for making fielset appear animation
				opacity = 1 - now;

				current_fs.css({
					'display': 'none',
					'position': 'relative'
				});
				previous_fs.css({'opacity': opacity});
			}, 
			duration: 600
		});
	});

	$('.radio-group .radio').click(function(){
		$(this).parent().find('.radio').removeClass('selected');
		$(this).addClass('selected');
	});

	$(".submit").click(function(){
		return false;
	});

	$('select[name="sekolahasal"]').change(function () {
		var id = $(this).val();
		if (id == '') {
			$('input[name="kota_sekolahasal"]').val('-');
			$('textarea[name="alamat_sekolahasal"]').val('-');
		}else{
			$.ajax({
				url:"<?= base_url('ppdb/getsekolahasal'); ?>",
				method:"POST",
				data:{id:id},
				dataType:"Json",
				success:function (response) {
					$('input[name="kota_sekolahasal"]').val(response[0].kota);
					$('textarea[name="alamat_sekolahasal"]').val(response[0].alamat);
				}
			})
		}
		
	})
});

	function daftar(){
		var btnDaftar = $("#btnDaftar");
		var form = $('#msform')[0];
		var data = new FormData(form);

		console.log(form);
		$.ajax({
			url:"<?= base_url('ppdb/prosesreguler'); ?>",
			method:"POST",
			data:data,
			dataType:"json",
			enctype: 'multipart/form-data',
			processData: false,
			contentType: false,
			beforeSend: function(){
				btnDaftar.val('Proses...').attr('disabled', true);
			},
			success:function (response) {
				console.log(response);
				btnDaftar.val('Daftar').attr('disabled', false);
				if (response.status === true ) {
					Swal.fire({
						title: "Good job!",
						text: "Terima kasih telah mendaftar!",
						icon: "success",
						showConfirmButton: false,
						timer: 15000,
						willClose: () => {
							window.location.href = "<?= base_url('ppdb'); ?>";
						}
					});
				}else{
					if (response.error == 'upload') {
						$('input[name="fileijazah"]').css("border", "1px solid red");
					}
				}
			}
		})
	}
</script>