<!-- Content wrapper -->
<div class="content-wrapper">
	<!-- Content -->
	<div class="container-xxl flex-grow-1 container-p-y">
		<div class="row">
			<div class="col-lg-12 mb-4 order-0">
				<div class="card">
					<div class="card-body">
						
						<h4>Perbandingan Antar alternatif --> <?php echo $kriteria->kriteria;?> <-- </h4>
							<h5 class="mt-4">Bobot</h5>
						<form action="<?php echo site_url('Perbandingan/ins_nilai_alternatif');?>" method="post" enctype="multipart/form-data">
								<table width="100%" class="table table-striped table-bordered table-resposive">
									<thead>
										<tr>
											<th>Antar Alternatif</th>
											<input type="hidden" name="kriteria" value="<?php echo $input;?>">
											<?php
											foreach ($alke as $key => $value) {
												foreach ($alke as $keys => $values) {
													if($key < $keys){
														echo '<input type="hidden" name="alternatif1['.$key.']['.$keys.']" value="'.$value->nik.'">';
														echo "<input type='hidden' name='alternatif2[$key][$keys]' value='$values->nik'>";
														echo '<input type="hidden" name="bobot['.$key.']['.$keys.']" value="'.$ahp1['bobot'][$key][$keys].'">';
													}
												}
											}
											foreach ($alke as $key => $value) {
												echo "<th>$value->nama</th>";
												
											}
											?>
										</tr>
									</thead>
									<tbody>
										<?php
											foreach ($alke as $key => $value) {
												echo "<tr><td>$value->nama</td>";
												
												foreach ($ahp1['hasil'] as $keys => $value_ahp1) {
													echo '<td>'.$ahp1['hasil'][$key][$keys].'</td>';
												}
												echo '<tr>';
											}
										?>
									</tbody>
								</table>

								<h5 class="mt-4">Normalisasi</h5>
								<table width="100%" class="table table-striped table-bordered table-resposive">
									<thead>
										<tr>
											<th>Antar Alternatif</th>
											<?php
											foreach ($alke as $key => $value) {
												echo "<th>$value->nama</th>";
											}
											?>
											<th class="table-info">Jumlah</th>
											<th class="table-warning">Prioritas</th>
										</tr>
									</thead>
									<tbody>
										<?php
											foreach ($alke as $key => $value) {
												echo "<tr><td>$value->nama</td>";
												foreach ($ahp2['hasil'] as $keys => $value_ahp1) {
													echo '<td>'.$ahp2['hasil'][$key][$keys].'</td>';
												}
												echo '<td class="table-info">'.$ahp2['jumlah'][$key].'</td>';
												echo '<td class="table-warning">'.$ahp2['prioritas'][$key].'</td>
												<tr>';
											}
											echo '
												<tr class="table-success">
													<td>Total</td>';
													foreach ($ahp2['total'] as $key => $value) {
														echo "<td>$value</td>";
													}
											echo'</tr>';
										?>
									</tbody>
								</table>
								<input type="submit" value="Simpan Bobot dan Periode" class="btn btn-primary mt-4">
						</form>

					</div>
				</div>
			</div>
		</div>
		<!--/ Expense Overview -->
	</div>
</div>


