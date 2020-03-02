<div class="col-md-12">
	<?php if (!empty($data)): ?>
		<form action="" method="post" enctype="multipart/form-data">
			<div class="panel panel-default card card-default">
				<div class="panel-heading card-header">
					<?php if ($is_saved): ?>
						<?php alert('success','data berhasil di perbarui') ?>
					<?php endif ?>
				</div>
				<div class="panel-body card-body">
					<input name="guru_id" type="hidden" value="<?php echo $data['guru_id'] ?>">
					<input name="th_ajaran_id" type="hidden" value="<?php echo $data['th_ajaran_id']; ?>">
					<div class="form-group">
						<label for="mapel">mapel</label>
						<select name="mapel_id" class="form-control">
							<?php if (!empty($mapel)) : ?>
								<?php foreach ($mapel as $key => $value) : ?>
									<?php $selected = ''; ?>
									<?php if ($value['id']==$data['mapel_id']) : ?>
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
									<?php if ($value['id']==$data['kelas_id']) : ?>
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
									<?php if ($value['id']==$data['hari']) : ?>
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
							<input name="jam_mulai" id="timepicker" width="350" value="<?php echo $data['jam_mulai'] ?>" required>
						</div>
						<div class="col-md-6 mb-3">
							<label for="selesai">selesai</label>
							<input name="jam_selesai" id="timepicker2" width="350" value="<?php echo $data['jam_selesai'] ?>" required>
						</div>
					</div>
					<div class="panel-footer card-footer">
						<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
						<button class="btn btn-warning btn-sm" type="reset"><i class="fa fa-undo"></i> Reset</button>
					</div>
				</div>
			</div>
		</form>
	<?php endif ?>
</div>