<main id="main">
  <!-- ======= Breadcrumbs ======= -->
  <div class="breadcrumbs" data-aos="fade-in">
    <div class="container">
      <h2><?= $title; ?></h2>
      <p>PPDB online merupakan sistem layanan yang dirancang untuk memfasilitasi otomasi pelaksanaan Penerimaan Peserta Didik Baru yang berbasis waktu nyata (real time) melalui Internet. Layanan PPDB online ini mencakup proses pendaftaran, seleksi, hingga pengumuman hasil seleksi</p>
    </div>
  </div><!-- End Breadcrumbs -->

  <!-- ======= Events Section ======= -->
  <section id="events" class="events">
    <div class="container" data-aos="fade-up">

      <div class="row">
        
       <div class="col-md-12">
        <center>
          <?php if ($reguler != null) { ?>
            <a href="<?= base_url('ppdb/jalurreguler'); ?>" class="btn btn-primary">Jalur Reguler</a>
          <?php }else{ ?>
            <a href="javascript::void(0)" onclick="alert('Pendaftaran belum dibuat')" class="btn btn-scondary">Jalur Reguler</a>
          <?php } ?>
          <?php if ($prestasi != null) { ?>
            <a href="<?= base_url('ppdb/jalurprestasi'); ?>" class="btn btn-warning">Jalur Prestasi</a>
          <?php }else{ ?>
            <a href="javascript::void(0)" onclick="alert('Pendaftaran belum dibuat')" class="btn btn-secondary">Jalur Prestasi</a>
          <?php } ?>
          
        </center>
      </div>

      <div class="mt-5">
        <section id="counts" class="counts section-bg">
          <div class="container" style="padding:40px">
            <div class="row counters">
              <center>
                <h5><b>Informasi Pendaftaran</b></h5>
              </center>
              <p>PPDB online merupakan sistem layanan yang dirancang untuk memfasilitasi otomasi pelaksanaan Penerimaan Peserta Didik Baru yang berbasis waktu nyata (real time) melalui Internet. Layanan PPDB online ini mencakup proses pendaftaran, seleksi, hingga pengumuman hasil seleksi</p>
            </div>
          </div>
        </section>
      </div>

    </div>

  </div>
</section>
</main>