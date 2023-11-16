<!-- Content wrapper -->
<div class="content-wrapper">
	<!-- Content -->
	<div class="container-xxl flex-grow-1 container-p-y">
		<div class="row">
			<div class="col-lg-12 mb-4 order-0">
				<div class="card">
					<div class="card-body">
						<button class="btn btn-primary rounded-pill" onclick="addPenilaian()"><i class="bx bx-plus"></i> Penilaian</button>
						<!-- <button class="btn btn-secondary rounded-pill" onclick="penilaianUlang()"><i class='bx bx-reset'></i> Penilaian ulang</button> -->
						<!-- <button class="btn btn-secondary rounded-pill" onclick="reloadTablePenilaian()"><i class="bx bx-refresh"></i> Reload</button> -->
						<div class="table-responsive text-nowrap">
							<table id="tablePenilaian" class="table table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>Alternatif</th>
										<th>Nilai</th>
										<th>Keterangan</th>
										<th>Periode</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ Expense Overview -->
	</div>
</div>
	<!-- / Content -->

	<!-- Modal -->
	<div class="modal fade" id="modal_form" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="#" id="formPenilaian" class="form-horizontal" enctype="multipart/form-data">
					<div class="modal-body form">
						<input type="hidden" value="" name="id"/>
						<ul style="list-style-type: none;">
							<li><h6>Periode</h6></li>
							<li>
		                        <select class="form-select" id="tahun" name="tahun">
		                          <option value="<?= date('Y'); ?>"><?= date('Y'); ?></option>
		                        </select>
							</li>
							<li class="mt-4"><h6>Alternatif</h6></li>
	                        <li>
		                        <select class="form-select" id="alternatif" name="nik" required></select>
								<div id="load-soal"></div>
	                        </li>
						</ul>
					</div>
					<div class="modal-footer">
						<button type="button" id="btnSave" onclick="savePenilaian()" class="btn btn-primary rounded-pill">Save</button>
						<button type="button" class="btn btn-danger rounded-pill" data-bs-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>


