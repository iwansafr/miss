<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-md-12">
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
				<?php if (empty($data['data'])) : ?>
					tambah
				<?php else : ?>
					ubah
				<?php endif ?> guru
			</div>
			<div class="panel-body card-body">
				<div class="form-group">
					<label for="nama">nama</label>
					<input type="text" class="form-control" name="nama" placeholder="nama" value="<?php echo @$data['data']['nama'] ?>">
				</div>
				<div class="form-group">
					<label for="kode">kode</label>
					<input type="text" class="form-control" name="kode" placeholder="kode" value="<?php echo @$data['data']['kode'] ?>">
				</div>
				<div class="form-group">
					<label for="gender">gender</label>
					<select name="gender" class="form-control">
						<?php if (!empty($gender)) : ?>
							<?php foreach ($gender as $key => $value) : ?>
								<?php $selected = ''; ?>
								<?php if (in_array($value['id'], $data['user_role'])) : ?>
									<?php $selected = 'selected'; ?>
								<?php endif ?>
								<option value="<?php echo $value['id'] ?>" <?php echo $selected ?>><?php echo $value['title'] ?></option>
							<?php endforeach ?>
						<?php endif ?>
					</select>
				</div>
				<div class="form-group">
					<label for="alamat">alamat</label>
					<input type="text" class="form-control" name="alamat" placeholder="alamat" value="<?php echo @$data['data']['alamat'] ?>">
				</div>
				<div class="form-group">
					<label for="hp">telepon</label>
					<input type="number" class="form-control" name="hp" placeholder="nomor telepon" value="<?php echo @$data['data']['hp'] ?>">
				</div>
				<div class="form-group">
					<label for="photo">photo</label>
					<input type="file" class="form-control" name="photo" placeholder="photo" value="<?php echo @$data['data']['photo'] ?>">
				</div>
			</div>
			<div class="panel-footer card-footer">
				<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
				<button class="btn btn-warning btn-sm" type="reset"><i class="fa fa-undo"></i> Reset</button>
			</div>
		</div>
	</form>
</div>