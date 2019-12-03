<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-md-12" style="padding-bottom: 20px;">
	<?php if (!empty($data['msg'])) : ?>
		<?php echo alert($data['status'], $data['msg']) ?>
		<?php if (!empty($data['msgs'])) : ?>
			<?php foreach ($data['msgs'] as $key => $value) : ?>
				<?php echo alert($data['status'], $value) ?>
			<?php endforeach ?>
		<?php endif ?>
	<?php endif ?>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="panel panel-default card card-default">
			<div class="panel-heading card-header">
				<?php foreach ($guru as $key => $value) {
					$nama = $value['nama'];
					$id = $value['user_id'];
				} ?>
				<?php if (empty($data['data'])) : ?>
					tambah
				<?php else : ?>
					ubah
				<?php endif ?> mapel guru (<?= $nama; ?>)
			</div>
			<div class="panel-body card-body">
				<input name="guru_id" type="hidden" value="<?= $id; ?>">
				<div class="form-group">
					<label for="th_ajaran_id">th_ajaran</label>
					<input name="th_ajaran_id" type="hidden" value="<?= $th_ajaran['id']; ?>">
					<input type="text" class="form-control" value="<?= $th_ajaran['title']; ?>" readonly>
				</div>
				<div class="form-group">
					<label for="mapel">mapel</label>
					<select name="mapel_id" class="form-control">
						<?php if (!empty($mapel)) : ?>
							<?php foreach ($mapel as $key => $value) : ?>
								<?php $selected = ''; ?>
								<?php if (in_array($value['id'], $data['nama'])) : ?>
									<?php $selected = 'selected'; ?>
								<?php endif ?>
								<option value="<?php echo $value['id'] ?>" <?php echo $selected ?>><?php echo $value['nama'] ?></option>
							<?php endforeach ?>
						<?php endif ?>
					</select>
				</div>
				<div class="form-group">
					<label for="kelas">kelas</label>
					<select name="kelas_id" class="form-control">
						<?php if (!empty($kelas)) : ?>
							<?php foreach ($kelas as $key => $value) : ?>
								<?php $selected = ''; ?>
								<?php if (in_array($value['id'], $data['nama'])) : ?>
									<?php $selected = 'selected'; ?>
								<?php endif ?>
								<option value="<?php echo $value['id'] ?>" <?php echo $selected ?>><?php echo $value['nama'] ?></option>
							<?php endforeach ?>
						<?php endif ?>
					</select>
				</div>
				<div class="form-group">
					<label for="hari">hari</label>
					<select name="hari" class="form-control">
						<?php if (!empty($hari)) : ?>
							<?php foreach ($hari as $key => $value) : ?>
								<?php $selected = ''; ?>
								<?php if (in_array($value['id'], $data['nama'])) : ?>
									<?php $selected = 'selected'; ?>
								<?php endif ?>
								<option value="<?php echo $value['id'] ?>" <?php echo $selected ?>><?php echo $value['nama'] ?></option>
							<?php endforeach ?>
						<?php endif ?>
					</select>
				</div>
				<div class="form-row">
					<div class="col-md-6 mb-3">
						<label for="mulai">mulai</label>
						<input name="jam_mulai" id="timepicker" width="350" value="<?= set_value('jam_selesai'); ?>" required>
					</div>
					<div class="col-md-6 mb-3">
						<label for="selesai">selesai</label>
						<input name="jam_selesai" id="timepicker2" width="350" value="" required>
					</div>
				</div>
				<div class="panel-footer card-footer">
					<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
					<button class="btn btn-warning btn-sm" type="reset"><i class="fa fa-undo"></i> Reset</button>
				</div>
			</div>
		</div>
	</form>
</div>
<div class="col-md-12" style="padding-bottom: 20px;">
	<div class="card">
		<div class="card-header">
			<i class="fas fa-table"></i>
			Data mapel guru (<?= $nama; ?>)
			<!-- <a href="<?php echo base_url('guru_mapel/download_template') ?>" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-download"></i> template</a>
			<a href="<?php echo base_url('guru_mapel/upload') ?>" class="btn btn-success btn-sm"><i class="fa fa-upload"></i> upload</a> -->
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" class="datatable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>mapel</th>
							<th>kelas</th>
							<th>tahun ajaran</th>
							<th>hari</th>
							<th>jam pelajaran</th>
							<th>action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>No</th>
							<th>mapel</th>
							<th>kelas</th>
							<th>tahun ajaran</th>
							<th>hari</th>
							<th>jam pelajaran</th>
							<th>action</th>
						</tr>
					</tfoot>
					<tbody>
						<?php $i = 1; ?>
						<?php if (!empty($data_guru)) : ?>
							<?php foreach ($data_guru as $key => $value) : ?>
								<tr>
									<td><?php echo $i ?></td>
									<td><?= $o_mapel[$value['mapel_id']] ?></td>
									<td><?= $o_kelas[$value['kelas_id']] ?></td>
									<td><?= $o_th_ajaran[$value['th_ajaran_id']] ?></td>
									<td><?php echo $o_hari[$value['hari']] ?></td>
									<td><?= $value['jam_mulai'] ?> - <?= $value['jam_selesai'] ?></td>
									<td>
										<a href="<?php echo base_url('guru_mapel/delete/' . $value['id']) ?>" onclick="if(confirm('apakah anda yakin ingin menghapus?')){}else{return false;};" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> delete</a>
									</td>
								</tr>
								<?php $i++; ?>
							<?php endforeach ?>
						<?php endif ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
	</div>
</div>