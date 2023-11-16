<!-- Content wrapper -->
<div class="content-wrapper">
	<!-- Content -->
	<div class="container-xxl flex-grow-1 container-p-y">
		<div class="row">
			<div class="col-lg-12 mb-4 order-0">
				<div class="card">
					<div class="card-body">
						<h5>Perbandingan Kriteria</h5>
						<hr>
						<form action="<?php echo site_url('perbandingan/ins_nilai_kriteria');?>" method="post" enctype="multipart/form-data">

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

						<?php
						foreach ($kriteria as $key => $value) {
							foreach ($kriteria as $keys => $values) {
								
								if($key < $keys){

									echo '<div class="row mt-3">';

									echo '<div class="col-xs-12 col-md-3">
											<div class="form-group">
												<input type="text" class="form-control" readonly value="'.$value->kriteria.'">
												<input type="hidden" class="form-control" readonly value="'.$value->id.'" name="kriteria1['.$key.']['.$keys.']">
											</div>
										  </div>';

									echo '<div class="col-xs-12 col-md-6">
											<div class="form-group">';
									echo "<select name='bobot[$key][$keys]' class='form-control'>";

									$cek = $this->db->query('select * from tbl_hasil_kriteria where kriteria1 = ? and kriteria2 = ?',array($value->id, $values->id))->row();
									if($cek->bobot == 1){
				
										echo "<option value='$cek->bobot'>$cek->bobot-Sama Penting</option>";

									}elseif ($cek->bobot == 2) {
										echo "<option value='$cek->bobot'>$cek->bobot-Mendekati Sedikit Lebih Penting</option>";
									}elseif($cek->bobot == 3){
										echo "<option value='$cek->bobot'>$cek->bobot-Sedikit Lebih Penting</option>";
									}elseif($cek->bobot == 4){
										echo "<option value='$cek->bobot'>$cek->bobot-Mendekati Lebih Penting</option>";
									}elseif($cek->bobot == 5){
										echo "<option value='$cek->bobot'>$cek->bobot-Lebih Penting</option>";
									}elseif ($cek->bobot == 6) {
										echo "<option value='$cek->bobot'>$cek->bobot-Mendekati Lebih Penting</option>";
									}elseif($cek->bobot == 7){
										echo "<option value='$cek->bobot'>$cek->bobot-Sangat Penting</option>";
									}elseif($cek->bobot == 8){
										echo "<option value='$cek->bobot'>$cek->bobot-Mendekati Mutlak</option>";
									}else{
										echo "<option value='$cek->bobot'>$cek->bobot-Mutlak Sangat Penting</option>";
									}

									foreach ($bobot as $keyb => $valueb) {
										if($cek->bobot == $keyb){
											
										}else{
											echo "<option value='$keyb'>$keyb-$valueb</option>";
										}
									}

										#echo "<option value='$keyb'>$keyb-$valueb</option>";
									
									echo '</select></div>
										</div>';

									echo '<div class="col-xs-12 col-md-3">
											<div class="form-group">
											<input type="text" class="form-control" readonly value="'.$values->kriteria.'">
												<input type="hidden" class="form-control" readonly value="'.$values->id.'" name="kriteria2['.$key.']['.$keys.']">
											</div>
										 </div>';

									echo '</div>'; //end row
								} // end if

							} // end keys
						} // end key
					?>
						<input type="submit" class="btn btn-primary mt-4" value="Selanjutnya"><span class="fa fa-arrow-right"></span>
					</form>

					</div>
				</div>
			</div>
		</div>
		<!--/ Expense Overview -->
	</div>
</div>
	<!-- / Content -->


