<?php 
	$id = $this->session->userdata('id');
	$datauser = $this->db->query("select nama_lengkap,level,foto from tbl_user where id = '$id' ")->row_array();
 ?>

<body>
	<input type="hidden" id="levellogin" value="<?= $datauser['level']; ?>">
	<!-- Layout wrapper -->
	<div class="layout-wrapper layout-content-navbar">
		<div class="layout-container">
			<!-- Menu -->

			<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
				<div class="app-brand demo">
					<a href="<?= base_url('dashboard'); ?>" class="app-brand-link">
						<span class="app-brand-logo demo">
							<img src="<?= base_url(); ?>assets/img/favicon/favicon.ico" alt="Logo" style="width: 3.5vw;">
						</span>
						<span class="app-brand-text demo menu-text fw-bolder ms-2 text-uppercase" style="font-size: 1.2vw;">SMK Bakti Idhata</span>
					</a>
				</div>

				<div class="menu-inner-shadow"></div>
				<ul class="menu-inner py-1">
					<!-- Dashboard -->
					<li class="menu-item" id="menu-a">
						<a href="<?= base_url('dashboard'); ?>" class="menu-link">
							<i class="menu-icon tf-icons bx bx-home-circle"></i>
							<div data-i18n="Analytics">Dashboard</div>
						</a>
					</li>
					<!-- MENU -->
					<li class="menu-header small text-uppercase"><span class="menu-header-text">MENU</span></li>
					<!-- Cards -->
					<?php if ($datauser['level'] == 'Administrator') { ?>
					<li class="menu-item" id="menu-b">
						<a href="<?= base_url('User'); ?>" class="menu-link">
							<i class="menu-icon tf-icons bx bx-user"></i>
							<div data-i18n="Boxicons">Users</div>
						</a>
					</li>
					<li class="menu-item" id="menu-c">
						<a href="<?= base_url('Kriteria'); ?>" class="menu-link">
							<i class="menu-icon tf-icons bx bx-user-pin"></i>
							<div data-i18n="Boxicons">Kriteria</div>
						</a>
					</li>
					<li class="menu-item" id="menu-d">
						<a href="<?= base_url('Alternatif'); ?>" class="menu-link">
							<i class="menu-icon tf-icons bx bx-notepad"></i>
							<div data-i18n="Boxicons">Alternatif</div>
						</a>
					</li>
					<li class="menu-item" id="menu-e">
						<a href="<?= base_url('Penilaian'); ?>" class="menu-link">
							<i class="menu-icon tf-icons bx bx-calendar-edit"></i>
							<div data-i18n="Boxicons">Penilaian</div>
						</a> 
					</li>
					<?php };?>
					<?php if ($datauser['level'] == 'Administrator' || $datauser['level'] == 'HR') { ?>
					<li class="menu-item" id="menu-g">
		              <a href="javascript:void(0);" class="menu-link menu-toggle">
		                <i class="menu-icon tf-icons bx bx-calculator"></i>
		                <div data-i18n="Layouts">Perbandingan</div>
		              </a>

		              <ul class="menu-sub">
		              	<li class="menu-item" id="menu-ga">
		                  <a href="<?= base_url('Perbandingan/kriteria'); ?>" class="menu-link">
		                    <div data-i18n="Without navbar">Kriteria</div>
		                  </a>
		                </li>
		                <li class="menu-item" id="menu-gb">
		                  <a href="<?= base_url('Perbandingan/alternatif'); ?>" class="menu-link">
		                    <div data-i18n="Without menu">Alternatif</div>
		                  </a>
		                </li>
		                <li class="menu-item" id="menu-gc">
		                  <a href="<?= base_url('Perbandingan/perbandingan_alternatif'); ?>" class="menu-link">
		                    <div data-i18n="Without menu">Perbandingan Alternatif Kriteria</div>
		                  </a>
		                </li>
		              </ul>
		            </li>
		            <?php };?>
		            <?php if ($datauser['level'] == 'Administrator' || $datauser['level'] == 'HR' || $datauser['level'] == 'Manager') { ?>
		            <li class="menu-item" id="menu-f">
						<a href="<?= base_url('Laporan'); ?>" class="menu-link">
							<i class="menu-icon tf-icons bx bx-file"></i>
							<div data-i18n="Boxicons">Laporan</div>
						</a> 
					</li>
					<?php };?>
					<li class="menu-item">
						<a href="<?= base_url('dashboard/logout'); ?>" class="menu-link">
							<i class="menu-icon tf-icons bx bx-power-off text-danger"></i>
							<div data-i18n="Boxicons" class="text-danger"><span class="fa fa-plus"></span> Logout</div>
						</a>
					</li>
				</ul>
			</aside>
			<!-- / Menu -->

			<!-- Layout container -->
			<div class="layout-page">
				<!-- Navbar -->

				<nav
				class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
				id="layout-navbar"
				>
				<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
					<a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
						<i class="bx bx-menu bx-sm"></i>
					</a>
				</div>

				<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
					<!-- Search -->
					<!-- <div class="navbar-nav align-items-center">
						<a href="javascript:void(0)" onclick="modalSett()" title="Setting Masa Expired">
							<i class="menu-icon bx bx-cog"></i>
						</a>
					</div> -->
					<!-- /Search -->
					
					<ul class="navbar-nav flex-row align-items-center ms-auto">
						<!-- Place this tag where you want the button to render. -->
						<li class="nav-item lh-1 me-3">
							<?= $datauser['nama_lengkap']; ?>
						</li>

						<!-- User -->
						<li class="nav-item navbar-dropdown dropdown-user dropdown">
							<a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
								<div class="avatar avatar-online">
									<img src="<?= base_url(); ?>assets/img/avatars/<?= $datauser['foto']; ?>" alt class="w-px-40 h-auto rounded-circle" />
								</div>
							</a>
							<ul class="dropdown-menu dropdown-menu-end">
								<li>
									<a class="dropdown-item" href="#">
										<div class="d-flex">
											<div class="flex-shrink-0 me-3">
												<div class="avatar avatar-online">
													<img src="<?= base_url(); ?>assets/img/avatars/<?= $datauser['foto']; ?>" alt class="w-px-40 h-auto rounded-circle" />
												</div>
											</div>
											<div class="flex-grow-1">
												<span class="fw-semibold d-block"><?= $datauser['nama_lengkap']; ?></span>
												<small class="text-muted"><?= $datauser['level']; ?></small>
											</div>
										</div>
									</a>
								</li>
								<li>
									<div class="dropdown-divider"></div>
								</li>
								<li>
									<a class="dropdown-item" href="<?= base_url('dashboard/logout'); ?>">
										<i class="bx bx-power-off me-2"></i>
										<span class="align-middle">Log Out</span>
									</a>
								</li>
							</ul>
						</li>
						<!--/ User -->
					</ul>
				</div>
			</nav>

			<!-- / Navbar -->