<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view('sb-admin/meta') ?>
</head>

<body id="page-top">
  <?php if (is_root() || is_admin() || is_petugas()): ?>
    <?php $this->load->view('sb-admin/nav-menu') ?>
  <?php endif ?>
  <div id="wrapper">
    <?php if (is_root() || is_admin() || is_petugas()): ?>
      <?php $this->load->view('sb-admin/sidebar') ?>
    <?php endif ?>
    <div id="content-wrapper">
      <div class="container-fluid">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active"><?php echo $this->uri->rsegments[1]; ?></li>
        </ol>
        <div class="row">
          <?php
          $this->load->view($this->uri->rsegments[1] . '/' . $this->uri->rsegments[2]);
          ?>
        </div>
      </div>
      <?php if (is_admin() || is_root()): ?>
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © SMK N 1 BANGSRI 2019</span>
            </div>
          </div>
        </footer>
      <?php endif ?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?php echo base_url('logout') ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('sb-admin/js') ?>

</body>

</html>