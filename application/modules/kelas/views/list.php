<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="col-md-3">
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
				<?php if (empty($data['kelas'])): ?>
				 	tambah
				 	<?php else: ?>
				 	ubah
				 <?php endif ?> kelas
			</div>
			<div class="panel-body card-body">
				<div class="form-group">
					<label for="nama">nama</label>
					<input type="text" class="form-control" name="nama" placeholder="nama" value="<?php echo @$data['kelas']['nama'] ?>">
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
	    Data Kelas
	    <a href="<?php echo base_url('kelas/download_template') ?>" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-download"></i> template</a>
	    <a href="<?php echo base_url('kelas/upload') ?>" class="btn btn-success btn-sm"><i class="fa fa-upload"></i> upload</a>
	  </div>
	  <div class="card-body">
	    <div class="table-responsive">
	      <table class="table table-bordered" id="dataTable" class="datatable" width="100%" cellspacing="0">
	        <thead>
	          <tr>
	            <th>No</th>
	            <th>nama</th>
	            <th>action</th>
	          </tr>
	        </thead>
	        <tfoot>
	          <tr>
	            <th>No</th>
	            <th>nama</th>
	            <th>action</th>
	          </tr>
	        </tfoot>
	        <tbody>
	        	<?php $i = 1; ?>
	        	<?php if (!empty($data['data'])): ?>
		        	<?php foreach ($data['data'] as $key => $value): ?>
			          <tr>
			            <td><?php echo $i ?></td>
			            <td><?php echo $value['nama'] ?></td>
			            <td>
			            	<a href="<?php echo base_url('kelas/edit/'.$value['id'])?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i> edit</a>
			            	|
			            	<a href="<?php echo base_url('kelas/delete/'.$value['id'])?>" onclick="if(confirm('apakah anda yakin ingin menghapus <?php echo $value['nama']?>')){}else{return false;};" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> delete</a>
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