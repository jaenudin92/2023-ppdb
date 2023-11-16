<!-- Content wrapper -->
<div class="content-wrapper">
	<!-- Content -->
	<div class="container-xxl flex-grow-1 container-p-y">
		<div class="row">
			<div class="col-lg-12 mb-4 order-0">
				<div class="card">
					<div class="card-body">
						
						<div class="row">
								<div class="col-md-6 text-left">
									<strong style="font-size:18pt;"><span class="fa fa-table"></span>Hasil Semua Perbandingan Kriteria </strong>
								</div>
							</div>
					<?php
					$arr_data = array();
					foreach ($data_id as $key_data => $data_id) {
						$arr_data[$key_data] = $data_id->kriteria;
						//echo $arr_data[$key_data];
					}
					foreach ($kriteria as $key_kriteria => $kriteria) {
						foreach ($arr_data as $key => $value_data) {
							if($arr_data[$key] == $kriteria->id){
								?>
					<form action="<?php echo site_url('Perbandingan/ins_prioritas');?>" method="post" enctype="muultipart/form-data">
						<div class="row">
								<div class="col-md-6 text-left mt-4 mb-3">
									<strong style="font-size:16pt;"><span class="fa fa-bank"></span><?php echo $kriteria->kriteria;?> </strong>
								</div>
							</div>
						<table class="table table-striped table-bordered">
						<tr>
							<th></th>
							<?php
							foreach ($alke as $key => $value) {
								echo "<th>$value->nama</th>";
							}
							?>
						</tr>
						<tr>
							<?php
							
							foreach ($alke as $key_alk => $value) {

								echo '<tr>';
								echo "<td>$value->nama</td>";
								foreach ($ahp1['hasil'][$kriteria->id][$key_alk] as $key_ahp1 => $v_ahp1) {
									echo "<td>$v_ahp1</td>";
								}
								echo '</tr>';
							}

							echo '<tr class="table-success"><td>Jumlah</td>';
							foreach ($ahp1['total_bawah'][$kriteria->id] as $key => $value_tahp1) {
								echo '<td>'.$value_tahp1.'</td>';
							}
							echo '</tr>';
							?>
						</tr>
						</table>

						<table class="table table-bordered table-striped mt-4">
						<tr>
							<th></th>
							<?php
							foreach ($alke as $key => $value) {
								echo "<th>$value->nama</th>";
							}
							?>
							<th class="info">Prioritas</th>
						</tr>
						<tr>
							<?php
							foreach ($alke as $key_alk => $value) {
								echo '<tr>';
								echo "<td>$value->nama</td>";
								//echo '<input type="hidden" name="kriteria[]" value=".'$kriteria->nama.'">';
								echo "<input type='hidden' name='kriteria[]' value='".$kriteria->id."'>";
								echo "<input type='hidden' name='alternatif[]' value='$value->nik'>";
								foreach ($ahp2['hasil'][$kriteria->id][$key_alk] as $key_ahp1 => $v_ahp1) {
									echo "<td>$v_ahp1</td>";
								}
								echo '<td class="table-info">'.$ahp2['prioritas'][$kriteria->id][$key_alk].'</td>';
								echo "<input type='hidden' name='prioritas[]' value='".$ahp2['prioritas'][$kriteria->id][$key_alk]."'>";
								echo '</tr>';
							}

							echo '<tr><td>Jumlah</td>';
								foreach ($ahp2['total'][$kriteria->id] as $key => $value_tahp2) {
									echo "<td>$value_tahp2</td>";
								}
							echo '</tr>';

							?>
						</tr>
						</table>

								<?php
							}
						}
					}
					?>	
						
						<div class="col-md-6 text-left mt-4 mb-3">
							<label>Periode</label>
							<?php
							echo "<select name='periode' class='form-control'>";
							$now = date('Y');
							for ($i=$now; $i >= ($now) ; $i--) { 
								echo "<option value='$i'>$i</option>";
							}
							echo "</select>";
							?>
							<input type="submit" class="btn btn-primary mt-4" value="Simpan Bobot">
						</div>
						
					</form>

					</div>
				</div>
			</div>
		</div>
		<!--/ Expense Overview -->
	</div>
</div>
	<!-- / Content -->


