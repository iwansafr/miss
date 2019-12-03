<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="<?php echo base_url(); ?>assets/vendor/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url(); ?>assets/js/sb-admin.min.js"></script>

<?php if ($this->uri->rsegments[1] . '/' . $this->uri->rsegments[2] == 'presensi/edit' || 'presensi_mapel/edit') : ?>
  <script src="<?php echo base_url(); ?>assets/js/demo/data-tables.js"></script>
<!-- Demo scripts for this page-->
<?php else: ?>
  <script src="<?php echo base_url(); ?>assets/js/demo/datatables-demo.js"></script>
<?php endif ?>

<?php if ($this->uri->rsegments[1] . '/' . $this->uri->rsegments[2] == 'kelas/upload') : ?>
  <script src="<?php echo base_url(); ?>assets/js/modules/kelas/script.js"></script>
<?php endif ?>

<?php if ($this->uri->rsegments[1] . '/' . $this->uri->rsegments[2] == 'siswa/upload') : ?>
  <script src="<?php echo base_url(); ?>assets/js/modules/siswa/script.js"></script>
<?php endif ?>

<?php if ($this->uri->rsegments[1] . '/' . $this->uri->rsegments[2] == 'mapel/upload') : ?>
  <script src="<?php echo base_url(); ?>assets/js/modules/mapel/script.js"></script>
<?php endif ?>

<?php if ($this->uri->rsegments[1] . '/' . $this->uri->rsegments[2] == 'th_ajaran/upload') : ?>
  <script src="<?php echo base_url(); ?>assets/js/modules/th_ajaran/script.js"></script>
<?php endif ?>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script>
  $('#timepicker').timepicker({
    use24hours: true,
    // format: 'HH:mm'
  });
  $('#timepicker2').timepicker({
    use24hours: true,
    // format: 'HH:mm'
  });
</script>