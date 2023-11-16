<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Laporan Hasil Perangkingan</title>
  </head>
  <body>
    <h4 class="text-center mb-5">Laporan Hasil Perangkingan Dengan Metode Weighted Product</h4>

    <div class="row">
				<div class="col-md-12">
					<div class="text-center">
						<h3><b>Penilaian Pengangkatan Karyawan</b></h3><br><h4><b>PT. Albany Corona Lestari</b></h4>
					</div>
				</div>
				<!-- <div class="col-md-8 text-left">
					<strong style="font-size:18pt;">Penilaian Karyawan Tenaga Harian Lepas (THL)</strong>
				</div> -->
				<table class="table table-bordered mt-5">
					<thead>
							<tr>
							<th>Nama</th>
							<th>Nilai</th>
							<th>Ranking</th>
						</tr>
					</thead>
					<tbody>
						<?php

						foreach ($nama_alternatif as $key => $value) {
							
							echo "<tr>
								 <td>$value->nama</td>";
							echo '<td>'.$ahp[$key].'</td>';
							echo '<td>'.$rank[$key].'</td>';
							echo "</tr>";
						}
						?>
					</tbody>
				</table>

				<div class="col-md-12">
					<div class="text-right">
						Yang bertanggung Jawab
						<br><br><br><br>
						<?php echo $nama;?>
					</div>
				</div>

			</div>

			<script type="text/javascript">
				window.print();
			</script>
  </body>
</html>