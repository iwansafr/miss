<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="col-md-12">
	
	<div class="card mb-3">
	  <div class="card-header">
	    <i class="fas fa-table"></i>
	    Data Siswa</div>
	  <div class="card-body">
	    <div class="table-responsive">
	      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	        <thead>
	          <tr>
	            <th>No</th>
	            <th>nama</th>
	            <th>nis</th>
	            <th>nisn</th>
	            <th>gender</th>
	            <th>tempat lahir</th>
	            <th>tgl lahir</th>
	            <th>alamat</th>
	            <th>action</th>
	          </tr>
	        </thead>
	        <tfoot>
	          <tr>
	            <th>No</th>
	            <th>nama</th>
	            <th>nis</th>
	            <th>nisn</th>
	            <th>gender</th>
	            <th>tempat lahir</th>
	            <th>tgl lahir</th>
	            <th>alamat</th>
	            <th>action</th>
	          </tr>
	        </tfoot>
	        <tbody>
	        	<?php $i = 1; ?>
	        	<?php if (!empty($data)): ?>
		        	<?php foreach ($data as $key => $value): ?>
			          <tr>
			            <td><?php echo $i ?></td>
			            <td><?php echo $value['nama'] ?></td>
			            <td><?php echo $value['nis'] ?></td>
			            <td><?php echo $value['nisn'] ?></td>
			            <td><?php echo $gender[$value['gender']] ?></td>
			            <td><?php echo $value['tmpt_lhr'] ?></td>
			            <td><?php echo $value['tgl_lhr'] ?></td>
			            <td><?php echo $value['alamat'] ?></td>
			            <td>
			            	<a href="<?php echo base_url('siswa/edit/'.$value['id'])?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i> edit</a>
			            	|
			            	<a href="<?php echo base_url('siswa/delete/'.$value['nisn'])?>" onclick="if(confirm('apakah anda yakin ingin menghapus <?php echo $value['nama']?>')){}else{return false;};" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> delete</a>
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