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
	<form action="" method="post" enctype="multipart/form-data">
		<div class="panel panel-default card card-default">
			<div class="panel-heading card-header">
				<?php if (empty($data['data'])): ?>
				 	tambah
				 	<?php else: ?>
				 	ubah
				 <?php endif ?> siswa
			</div>
			<div class="panel-body card-body">
				<div class="form-group">
					<label for="nama">nama</label>
					<input type="text" class="form-control" name="nama" placeholder="nama" value="<?php echo @$data['data']['nama'] ?>">
				</div>
				<div class="form-group">
					<label for="nis">nis</label>
					<input type="text" class="form-control" name="nis" placeholder="nis" value="<?php echo @$data['data']['nis'] ?>">
				</div>
				<div class="form-group">
					<label for="nisn">nisn</label>
					<input type="text" class="form-control" name="nisn" placeholder="nisn" value="<?php echo @$data['data']['nisn'] ?>">
				</div>
				<div class="form-group">
					<label for="gender">gender</label>
					<select name="gender" class="form-control">
						<?php if (!empty($gender)): ?>
						  <?php foreach ($gender as $key => $value): ?>
						  	<?php $selected = ''; ?>
						  	<?php if (in_array($value['id'], $data['user_role'])): ?>
						  		<?php $selected = 'selected'; ?>
						  	<?php endif ?>
								<option value="<?php echo $value['id'] ?>" <?php echo $selected ?>><?php echo $value['title'] ?></option>
						  <?php endforeach ?>
						<?php endif ?>
					</select>
				</div>
				<div class="form-group">
					<label for="th_ajaran">angkatan</label>
					<select name="th_ajaran" class="form-control">
						<?php if (!empty($th_ajaran)): ?>
						  <?php foreach ($th_ajaran as $key => $value): ?>
						  	<?php $selected = ''; ?>
						  	<?php if (in_array($value['id'], $data['title'])): ?>
						  		<?php $selected = 'selected'; ?>
						  	<?php endif ?>
								<option value="<?php echo $value['id'] ?>" <?php echo $selected ?>><?php echo $value['title'] ?></option>
						  <?php endforeach ?>
						<?php endif ?>
					</select>
				</div>
				<div class="form-group">
					<label for="kelas">kelas</label>
					<select name="kelas" class="form-control">
						<?php if (!empty($kelas)): ?>
						  <?php foreach ($kelas as $key => $value): ?>
						  	<?php $selected = ''; ?>
						  	<?php if (in_array($value['id'], $data['nama'])): ?>
						  		<?php $selected = 'selected'; ?>
						  	<?php endif ?>
								<option value="<?php echo $value['id'] ?>" <?php echo $selected ?>><?php echo $value['nama'] ?></option>
						  <?php endforeach ?>
						<?php endif ?>
					</select>
				</div>
				<div class="form-group">
					<label for="photo">photo</label>
					<input type="file" class="form-control" name="photo" placeholder="photo" value="<?php echo @$data['data']['photo'] ?>">
				</div>
				<div class="form-group">
					<label for="tmpt_lhr">tempat lahir</label>
					<input type="text" class="form-control" name="tmpt_lhr" placeholder="tempat lahir" value="<?php echo @$data['data']['tmpt_lhr'] ?>">
				</div>
				<div class="form-group">
					<label for="tgl_lhr">tgl lahir</label>
					<input type="date" class="form-control" name="tgl_lhr" placeholder="tgl lahir" value="<?php echo @$data['data']['tgl_lhr'] ?>">
				</div>
				<div class="form-group">
					<label for="alamat">alamat</label>
					<textarea name="alamat" class="form-control" rows="3"><?php echo @$data['data']['alamat'] ?></textarea>
				</div>
			</div>
			<div class="panel-footer card-footer">
				<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
				<button class="btn btn-warning btn-sm" type="reset"><i class="fa fa-undo"></i> Reset</button>
			</div>
		</div>
	</form>
</div>