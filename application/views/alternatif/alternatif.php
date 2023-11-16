<!-- Content wrapper -->
<div class="content-wrapper">
	<!-- Content -->
	<div class="container-xxl flex-grow-1 container-p-y">
		<div class="row">
			<div class="col-lg-12 mb-4 order-0">
				<div class="card">
					<div class="card-body">
						<button class="btn btn-primary rounded-pill" onclick="addAlternatif()"><i class="bx bx-plus"></i> Alternatif</button>
						<div class="table-responsive">
							<table id="tableAlternatif" class="table table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>NIK</th>
										<th>Nama</th>
										<th>Tempat Lahir</th>
										<th>Tenggal Lahir</th>
										<th>Jenis Kelamin</th>
										<th>Alamat</th>
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
				<form action="#" id="formAlternatif" class="form-horizontal" enctype="multipart/form-data">
					<div class="modal-body form">
						<input type="hidden" value="" name="id"/> 
						<div class="form-body">
							<div class="mb-3">
								<label for="nik" class="form-label">NIK</label>
								<input type="text" class="form-control" id="nik" name="nik" placeholder="ex : 2023010001" onkeypress="return isNumberKey(this.value)" />
								<small id="msg-nik" class="msg text-danger"></small>
							</div>
							<div class="mb-3">
								<label for="nama" class="form-label">Nama</label>
								<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama"/>
								<small id="msg-nama" class="msg text-danger"></small>
							</div>
							<div class="mb-3">
								<label for="tempatlahir" class="form-label">Tempat Lahir</label>
								<input type="text" class="form-control" id="tempatlahir" name="tempatlahir" placeholder="Tempat Lahir"/>
								<small id="msg-tempatlahir" class="msg text-danger"></small>
							</div>
							<div class="mb-3">
								<label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
								<input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Tempat Lahir"/>
								<small id="msg-tgl_lahir" class="msg text-danger"></small>
							</div>
							<div class="mb-3">
								<label for="jk" class="form-label">Jenis Kelamin</label>
								<select class="form-control" id="jk" name="jk">
									<option value="Pria">Pria</option>
									<option value="Wanita">Wanita</option>
								</select>
								<small id="msg-jk" class="msg text-danger"></small>
							</div>
							<div class="mb-3">
								<label for="alamat" class="form-label">Alamat</label>
								<textarea class="form-control" id="alamat" name="alamat" placeholder="Tempat tinggal"></textarea>
								<small id="msg-alamat" class="msg text-danger"></small>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" id="btnSave" onclick="saveAlternatif()" class="btn btn-primary rounded-pill">Save</button>
						<button type="button" class="btn btn-danger rounded-pill" data-bs-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>


