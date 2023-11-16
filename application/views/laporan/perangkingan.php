<!-- Content wrapper -->
<div class="content-wrapper">
	<!-- Content -->
	<div class="container-xxl flex-grow-1 container-p-y">
		<div class="row">
			<div class="col-lg-12 mb-4 order-0">
				<div class="card">
					<div class="card-body">

						 <div class="row">
							<div class="col-lg-12 col-md-12 col-xs-12">
								<div class="row">
									<div class="col-md-10 text-left">
										<strong style="font-size:16pt;"><span class="fa fa-table"></span> Penilaian Pengangkatan Karyawan PT. Albany Corona Lestari</strong>
									</div>
									<div class="col-md-2">
										<a href="<?php echo site_url('Laporan/print_doc');?>" target="_blank" class="btn btn-info pull-right" style="position: absolute;right: 25px;">Print Ranking</a>
										<!-- <button onclick="window.print()" class="btn btn-dark" id="print">Print</button> -->
									</div>
								</div>
								<br><br>
								<table class="table table-striped table-bordered mb-4">
									<tr>
										<th></th>
										<?php
										foreach ($kriteria as $key => $value) {
											echo "<th>$value->kriteria</th>";
										}
										?>
									</tr>
									<?php
										foreach ($nama_alternatif as $key => $value) {
											echo "<tr>
													<td class='table-info'>$value->nama</td>";
													foreach ($nilai as $keys => $values) {
														if($value->nik == $values->alternatif){
															echo "<td class='table-success'>$values->prioritas</td>";	
														}
													}
											echo "</tr>";
										}
										echo "<tr class='table-warning'>";
											echo "<td>Prioritas</td>";
											foreach ($prioritas_kriteria as $key => $value) {
												echo "<td>$value->prioritas</td>";
											}
											echo "</tr>";
									?>
								</table>

								<h5>Hasil Rangking Metode</h5>
								<table class="table table-striped table-bordered mb-4 mt-3">
									<tr>
										<th>Nama</th>
										<th>Nilai</th>
										<th>Ranking</th>
									</tr>
									<?php
									
									foreach ($nama_alternatif as $key => $value) {
										
										echo "<tr>
											 <td class='table-info'>$value->nama</td>";
										echo '<td class="success">'.@$ahp[$key].'</td>';
										echo '<td class="warning">'.@$rank[$key].'</td>';
										echo "</tr>";
									}
									?>
								</table>

								<h5>Hasil Ranking Normal</h5>
								<table class="table table-striped table-bordered mb-4 mt-3">
									<thead>
										<tr style="background-color:white">
											<th>Nama</th>
											<th>Nilai</th>
											<th>Ranking</th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($nilai_awal as $key => $value) {
											echo "<tr>
													<td class='table-info'>$value->nama</td>
													<td class='table-success'>$value->nilai</td>
													<td class='table-warning'>$rank_awal[$key]</td>
												</tr>";
										}
										?>
									</tbody>
								</table>
								
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


