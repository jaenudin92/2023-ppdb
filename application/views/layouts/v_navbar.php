<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
  <div class="container d-flex align-items-center">

    <h1 class="logo me-auto"><a href="<?= base_url(); ?>">SMK CIANJUR</a></h1>

    <nav id="navbar" class="navbar order-last order-lg-0">
      <ul>
        <li><a class="<?= ($this->uri->segment(1) == '') ? 'active' : ''; ?>" href="<?= base_url(); ?>">Home</a></li>
        <li><a class="<?= ($this->uri->segment(1) == 'ppdb') ? 'active' : ''; ?>" href="<?= base_url('ppdb'); ?>">PPDB</a></li>
        <li><a class="<?= ($this->uri->segment(1) == 'contact') ? 'active' : ''; ?>" href="<?= base_url('contact'); ?>">Contact</a></li>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

    <a href="<?= base_url("login"); ?>" class="get-started-btn">Login Admin</a>

  </div>
</header>