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
					<label for="password">password</label>
					<input type="password" class="form-control" name="password" placeholder="password">
				</div>
				<div class="form-group">
					<label for="email">email</label>
					<input type="email" class="form-control" name="email" placeholder="email" value="<?php echo @$data['user']['email'] ?>">
				</div>
			</div>
			<div class="panel-footer card-footer">
				<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
				<button class="btn btn-warning btn-sm" type="reset"><i class="fa fa-undo"></i> Reset</button>
			</div>
		</div>
	</form>
</div>