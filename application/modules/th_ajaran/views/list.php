<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-md-3">
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
				<?php if (empty($data['th_ajaran'])) : ?>
					tambah
				<?php else : ?>
					ubah
				<?php endif ?> th_ajaran
			</div>
			<div class="panel-body card-body">
				<div class="form-group">
					<label for="title">title</label>
					<input type="text" class="form-control" name="title" placeholder="title" value="<?php echo @$data['th_ajaran']['title'] ?>">
				</div>
			</div>
			<div class="panel-footer card-footer">
				<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
				<button class="btn btn-warning btn-sm" type="reset"><i class="fa fa-undo"></i> Reset</button>
			</div>
		</div>
	</form>
</div>
<div class="col-md-9">
	<div class="card">
		<div class="card-header">
			<i class="fas fa-table"></i>
			Data th_ajaran
			<a href="<?php echo base_url('th_ajaran/download_template') ?>" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-download"></i> template</a>
			<a href="<?php echo base_url('th_ajaran/upload') ?>" class="btn btn-success btn-sm"><i class="fa fa-upload"></i> upload</a>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" class="datatable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>id</th>
							<th>title</th>
							<th>action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>No</th>
							<th>id</th>
							<th>title</th>
							<th>action</th>
						</tr>
					</tfoot>
					<tbody>
						<?php $i = 1; ?>
						<?php if (!empty($data['data'])) : ?>
							<?php foreach ($data['data'] as $key => $value) : ?>
								<tr>
									<td><?php echo $i ?></td>
									<td><?php echo $value['id'] ?></td>
									<td><?php echo $value['title'] ?></td>
									<td>
										<a href="<?php echo base_url('th_ajaran/edit/' . $value['id']) ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i> edit</a>
										|
										<a href="<?php echo base_url('th_ajaran/delete/' . $value['id']) ?>" onclick="if(confirm('apakah anda yakin ingin menghapus <?php echo $value['title'] ?>')){}else{return false;};" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> delete</a>
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