<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="col-md-12">
	
	<div class="card mb-3">
	  <div class="card-header">
	    <i class="fas fa-table"></i>
	    Data User</div>
	  <div class="card-body">
	    <div class="table-responsive">
	      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	        <thead>
	          <tr>
	            <th>No</th>
	            <th>username</th>
	            <th>email</th>
	            <th>nama</th>
	            <th>action</th>
	          </tr>
	        </thead>
	        <tfoot>
	          <tr>
	            <th>No</th>
	            <th>username</th>
	            <th>email</th>
	            <th>nama</th>
	            <th>action</th>
	          </tr>
	        </tfoot>
	        <tbody>
	        	<?php $i = 1; ?>
	        	<?php if (!empty($data)): ?>
		        	<?php foreach ($data as $key => $value): ?>
			          <tr>
			            <td><?php echo $i ?></td>
			            <td><?php echo $value['username'] ?></td>
			            <td><?php echo $value['email'] ?></td>
			            <td><?php echo $value['nama'] ?></td>
			            <td>
			            	<a href="<?php echo base_url('user/edit/'.$value['id'])?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i> edit</a>
			            	|
			            	<a href="<?php echo base_url('user/delete/'.$value['id'])?>" onclick="if(confirm('apakah anda yakin ingin menghapus <?php echo $value['username']?>')){}else{return false;};" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> delete</a>
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