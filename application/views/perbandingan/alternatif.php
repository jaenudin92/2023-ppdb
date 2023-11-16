<!-- Content wrapper -->
<div class="content-wrapper">
	<!-- Content -->
	<div class="container-xxl flex-grow-1 container-p-y">
		<div class="row">
			<div class="col-lg-12 mb-4 order-0">
				<div class="card">
					<div class="card-body">
						<h5>Perbandingan Alternatif</h5>
						<hr>
						<div class="panel panel-default">
							<div class="panel-body">
								<form method="post" action="<?php echo site_url('Perbandingan/perbandingan_alternatif_single');?>">
									<div class="row">
										<div class="col-xs-12 col-md-3">
											
											<div class="form-group">
												<p style="padding:10px 0;"><label><b>Pilih Kriteria
												</b></label></p>
											</div>
										</div>
										<div class="col-xs-12 col-md-9">
											<div class="form-group">
												<select name="kriteria" class="form-control" onclick="get_kriteria()" id="kriteria">
													<?php
													foreach ($kriteria as $key => $value) {
														echo '<option value="'.$value->id.'">'.$value->kriteria.'</option>';
													}
													?>
												</select>
											</div>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-xs-12 col-md-3">
											<div class="form-group">
												<label><b>Kriteria Pertama</b></label>
											</div>
										</div>
										<div class="col-xs-12 col-md-6">
											<div class="form-group">
												<label><b>Penilaian</b></label>
											</div>
										</div>
										<div class="col-xs-12 col-md-3">
											<div class="form-group">
												<label><b>Kriteria Kedua</b></label>
											</div>
										</div>
									</div>

									<div id="bobot"></div>

								</form>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<!--/ Expense Overview -->
	</div>
</div>
	<!-- / Content -->
<script src="<?= base_url(); ?>assets/js/jquery-3.6.1.min.js"></script>
<script type="text/javascript">
	function get_kriteria(){
		var id = $("#kriteria").val();
		$.ajax({
			type 	: "POST",
			url 	: "<?php echo base_url('Perbandingan/get_kriteria');?>",
			data 	: "kriteria="+id,
				success:function(msg){
					$("#bobot").html(msg);
				}
		});
	}

	// $(document).ready(function(){
    //     $('#modalNilaiDetail').on('show.bs.modal', function(e){
    //         var rowid = $(e.relatedTarget).data('id');
    //         //ambil data
    //         $.ajax({
    //            type :'POST',
    //         url : '<?php echo site_url('alternatif/nilai_detail');?>',
    //             data : 'rowid='+rowid,
    //             success : function(data){
    //                 $('.fetched-data').html(data);//tampil data di modal.
    //             }

    //         });
    //     });
    // });
</script>


