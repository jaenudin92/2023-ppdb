<!-- Content wrapper -->
<div class="content-wrapper">
	<!-- Content -->
	<div class="container-xxl flex-grow-1 container-p-y">
		<div class="row">
			<div class="col-lg-12 mb-4 order-0">
				<div class="card">
					<div class="card-body">
						
						<div class="row mb-2">
							<div class="col-md-6 text-left">
								<strong style="font-size:16pt;"><span class="fa fa-table"></span> Perbandingan Kriteria</strong>
							</div>
						</div> <!-- end row -->

						<table width="100%" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Antar Kriteria</th>
									<?php
									foreach ($kriteria as $key => $value) {
										echo "<th>$value->kriteria</th>";
									}
									?>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach ($kriteria as $key => $value) {
										echo "<tr>";
										echo "<td><b>$value->kriteria</b></td>";
										foreach ($ahp1['hasil'][$key] as $keys => $values) {
											echo '<td>'.$values.'</td>';
										}
										echo "</tr>";
									}
										echo "<tr class='table-info'>";
											echo "<td><b>Total</b></td>";
											foreach ($ahp1['total_bawah'] as $key => $value) {
												echo "<td><b>$value</b></td>";
											}
										echo "</tr>";
									?>
							</tbody>
						</table>

						<div class="row mb-2 mt-4">
							<div class="col-md-6 text-left">
								<strong style="font-size:16pt;"><span class="fa fa-table"></span> Normalisasi Kriteria</strong>
							</div>
						</div> <!-- end row -->

						<table width="100%" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Antar Kriteria</th>
									<?php
									foreach ($kriteria as $key => $value) {
										echo "<th>$value->kriteria</th>";
									}
									?>
									<th class="info">Jumlah</th>
									<th class="success">Bobot Prioritas</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach ($kriteria as $key => $value) {
									echo "<tr>";
									echo "<td><b>$value->kriteria</b></td>";
										foreach ($ahp2['hasil'][$key] as $keys => $values) {
											echo '<td>'.$values.'</td>';
										}
										echo '<td class="table-info"><b>'.$ahp2['jumlah'][$key].'</b></td>';
											echo '<td class="table-success"><b>'.$ahp2['prioritas'][$key].'</b></td>';
										echo "</tr>";
									}
									echo "<tr class='table-success'>";
										echo "<td><b>Total</b></td>";
										foreach ($ahp2['total'] as $key => $value) {
											echo "<td><b>$value</b></td>";
										}
									echo "</tr>";
									?>
							</tbody>
						</table>

						<div class="row mb-2 mt-4">
							<div class="col-md-6 text-left">
								<strong style="font-size:16pt;"><span class="fa fa-table"></span> Uji Kompetensi </strong>
							</div>
						</div> <!-- end row -->
					<form action="<?php echo site_url('Perbandingan/save_prioritas');?>" method="post" enctype="multipart/form-data">
						<table width="100%" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Antar Kriteria</th>
									<?php
									foreach ($kriteria as $key => $value) {
										echo "<th>$value->kriteria</th>";
										echo '<input type="hidden" name="kriteria[]" value="'.$value->id.'">';
									}
									?>
									<th class="table-info">Prioritas</th>
									<th class="table-success">Vector</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach ($kriteria as $key => $value) {
									echo "<tr>";
									echo "<td><b>$value->kriteria</b></td>";
										foreach ($ahp1['hasil'][$key] as $keys => $values) {
											echo '<td>'.$values.'</td>';
										}
										echo '<td class="table-info"><b>'.$ahp2['prioritas'][$key].'</b></td>';
										echo '<td class="table-success"><b>'.$ahp2['vector'][$key].'</b></td>';
										echo '<input type="hidden" name="prioritas[]" value="'.$ahp2['prioritas'][$key].'">';
										echo "</tr>";
									}
									echo "<tr>";
										echo "<td class='table-warning'><b>Total</b></td>";
										foreach ($ahp1['total_bawah'] as $key => $value) {
											echo "<td class='table-warning'><b>$value</b></td>";
										}
										echo '<td class="table-success"><b>Jumlah Rata Vector</b></td><td class="table-success"><b>'.$ahp3['lamdamax'].'</b></td>';
									echo "</tr>";
									?>
							</tbody>
						</table>

						<div class="row mb-2 mt-4">
							<div class="col-md-6 text-left">
								<strong style="font-size:16pt;"><span class="fa fa-table"></span> Hasil Akhir </strong>
							</div>
						</div> <!-- end row -->
					
						<table width="100%" class="table table-striped table-bordered">
							<tbody>
								<tr>
									<th>Simpan Periode</th>
									<th>
									<?php
									$now = date('Y');
									echo '<select name="periode" class="form-control">';
									for ($i=$now;  $i >= ($now) ; $i--) { 
										echo "<option value='$i'>$i</option>";
									}
									echo '</select>';
									?>
									</th>
								</tr>
								<tr>
									<th>N ( Kriteria )</th>
									<th><?php echo count($ahp2['prioritas']);?></th>
								</tr>
								<tr>
									<th>Lamda MAX</th>
									<Th><?php echo $ahp3['lamdamax'];?></Th>
								</tr>
								<tr>
									<th>CI</th>
									<th><?php echo $ahp3['ci'];?></th>
								</tr>
								<tr>
									<th>CR</th>
									<th><?Php echo $ahp3['cr'];?></th>
								</tr>
							</tbody>
						</table>
						<?php
						if($ahp3['cr'] <= 0.1){
							echo '<p class="info mb-2 mt-4">KONSISTEN</p>';
							echo '<input type="submit" name="" class="btn btn-primary" value="Simpan Hasil">';
						}else{
							echo '<p style="color:red" class="mt-4">TIDAK KONSISTEN</p>';
							echo "<a href='".site_url('Perbandingan/analisa')."' class='btn btn-danger'>Ulangi Perhitungan</a>";
						}
						?>
						
					</form>

					</div>
				</div>
			</div>
		</div>
		<!--/ Expense Overview -->
	</div>
</div>
	<!-- / Content -->


