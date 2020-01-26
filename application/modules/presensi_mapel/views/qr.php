<?php defined('BASEPATH') OR exit('No direct script access allowed');

foreach ($kelas as $key => $value) 
{
	$link = base_url('presensi_mapel/edit/'.$value['id']);
	?>
	<div class="col-md-3" style="margin-bottom: 1px;">
		<a href="<?php echo base_url('presensi_mapel/qrcode/'.$value['id']) ?>" target="_blank" class="btn btn-success">QR CODE kelas <?php echo $value['nama'] ?></a>
	</div>
	<?php
}
