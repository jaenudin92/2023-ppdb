<!-- Content wrapper -->
<div class="content-wrapper">
	<!-- Content -->
	<div class="container-xxl flex-grow-1 container-p-y">
		<div class="row">
			<div class="col-lg-12 mb-4 order-0">
				<div class="card">
					<div class="card-body">
						<a href="<?= base_url('Kriteria'); ?>" class="btn btn-secondary rounded-pill"><i class='bx bx-left-arrow-alt'></i> Kembali</a>
						<button class="btn btn-primary rounded-pill" onclick="addSubKriteria()"><i class="bx bx-plus"></i> Sub Kriteria</button>
						<div class="table-responsive text-nowrap">
							<table id="tableSubKriteria" class="table table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>Kriteria</th>
										<th>Sub Kriteria</th>
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
			<form action="#" id="formSubKriteria" class="form-horizontal" enctype="multipart/form-data">
				<div class="modal-body form">
					<input type="hidden" value="" name="id"/>
					<input type="hidden" value="<?= $idkriteria; ?>" name="idkriteria"/>
					<div class="form-body">
						<div class="mb-3">
							<label for="subkriteria" class="form-label">Sub Kriteria</label>
							<input type="text" class="form-control" id="subkriteria" name="subkriteria" placeholder="Sub Kriteria"/>
							<small id="msg-subkriteria" class="msg text-danger"></small>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" id="btnSave" onclick="saveSubKriteria()" class="btn btn-primary rounded-pill">Save</button>
					<button type="button" class="btn btn-danger rounded-pill" data-bs-dismiss="modal">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>


