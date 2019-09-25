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
				<?php if (empty($data['user'])): ?>
				 	tambah
				 	<?php else: ?>
				 	ubah
				 <?php endif ?> user
			</div>
			<div class="panel-body card-body">
				<div class="form-group">
					<label for="username">username</label>
					<input type="text" class="form-control" name="username" placeholder="username" value="<?php echo @$data['user']['username'] ?>">
				</div>
				<div class="form-group">
					<label for="password">password</label>
					<input type="password" class="form-control" name="password" placeholder="password">
				</div>
				<div class="form-group">
					<label for="photo">photo</label>
					<input type="file" class="form-control" placeholder="photo" name="photo">
				</div>
				<div class="form-group">
					<label for="nama">nama</label>
					<input type="text" class="form-control" name="nama" placeholder="nama" value="<?php echo @$data['user']['nama'] ?>">
				</div>
				<div class="form-group">
					<label for="email">email</label>
					<input type="email" class="form-control" name="email" placeholder="email" value="<?php echo @$data['user']['email'] ?>">
				</div>
				<div class="form-group">
					<label for="role">role</label>
					<select class="custom-select" name="role[]" multiple>
						<?php if (!empty($role)): ?>
						  <?php foreach ($role as $key => $value): ?>
						  	<?php $selected = ''; ?>
						  	<?php if (in_array($value['id'], $data['user_role'])): ?>
						  		<?php $selected = 'selected'; ?>
						  	<?php endif ?>
								<option value="<?php echo $value['id'] ?>" <?php echo $selected ?>><?php echo $value['title'] ?></option>
						  <?php endforeach ?>
						<?php endif ?>
					</select>
				</div>
			</div>
			<div class="panel-footer card-footer">
				<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
				<button class="btn btn-warning btn-sm" type="reset"><i class="fa fa-undo"></i> Reset</button>
			</div>
		</div>
	</form>
</div>