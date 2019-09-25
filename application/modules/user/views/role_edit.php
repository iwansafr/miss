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
				edit role
			</div>
			<div class="panel-body card-body">
				<div class="form-group">
					<label for="title">title</label>
					<input type="text" class="form-control" name="title" placeholder="title" value="<?php echo @$data['data']['title'] ?>">
				</div>
				<div class="form-group">
					<label for="description">description</label>
					<textarea name="description" class="form-control" rows="3"><?php echo @$data['data']['description'] ?></textarea>
				</div>
				<div class="form-group">
					<label for="level">level</label>
					<input type="number" name="level" class="form-control" value="<?php echo @$data['data']['level'] ?>">
				</div>
			</div>
			<div class="panel-footer card-footer">
				<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
				<button class="btn btn-warning btn-sm" type="reset"><i class="fa fa-undo"></i> Reset</button>
			</div>
		</div>
	</form>
</div>