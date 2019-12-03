<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="col-md-12">
	<?php if (!empty($data['msg'])): ?>
		<?php echo alert($data['status'],$data['msg']) ?>
		<?php if (!empty($data['msgs'])): ?>
			<?php foreach ($data['msgs'] as $key => $value): ?>
					<?php echo alert($data['status'], $value) ?>
				<?php endforeach ?>	
		<?php endif ?>
	<?php endif ?>
	<?php if (!empty($guru_has_mapel)): ?>
			<h4>Kelas (<?php echo @$kelas[$guru_has_mapel['kelas_id']] ?>)</h4>
			<h6>Guru (<?php echo @$guru['nama']; ?>, <?php echo @$mapel[$guru_has_mapel['mapel_id']] ?>, Jam <?php echo @$guru_has_mapel['jam_mulai'] ?> - <?php echo @$guru_has_mapel['jam_selesai'] ?>)</h6>
			<form action="" method="post" enctype="multipart/form-data">
				<div class="panel panel-default card card-default">
					<div class="panel-heading card-header">
						<?php if (empty($check_jurnal)): ?>
						 	tambah
						 	<?php else: ?>
						 	ubah
						 <?php endif ?> jurnal
					</div>
					<div class="panel-body card-body">
						<div class="form-group">
							<label for="materi">materi</label>
							<textarea name="materi" class="form-control" rows="3"><?php echo @$check_jurnal['materi']; ?></textarea>
						</div>
					</div>
					<div class="panel-footer card-footer">
						<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
						<button class="btn btn-warning btn-sm" type="reset"><i class="fa fa-undo"></i> Reset</button>
					</div>
					</div>
				</div>
			</form>
	<?php else: ?>
		Saatnya istirahat
	<?php endif ?>
</div>