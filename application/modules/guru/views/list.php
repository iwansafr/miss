<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-md-12">

	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-table"></i>
			Data Guru</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>nama</th>
							<th>kode</th>
							<th>gender</th>
							<th>alamat</th>
							<th>hp</th>
							<th>action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>No</th>
							<th>nama</th>
							<th>kode</th>
							<th>gender</th>
							<th>alamat</th>
							<th>hp</th>
							<th>action</th>
						</tr>
					</tfoot>
					<tbody>
						<?php $i = 1; ?>
						<?php if (!empty($data)) : ?>
							<?php foreach ($data as $key => $value) : ?>
								<tr>
									<td><?php echo $i ?></td>
									<td><?php echo $value['nama'] ?></td>
									<td><?php echo $value['kode'] ?></td>
									<td><?php echo $gender[$value['gender']] ?></td>
									<td><?php echo $value['alamat'] ?></td>
									<td><?php echo $value['hp'] ?></td>
									<td>
										<div class="dropdown">
											<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
												Action
											</button>
											<div class="dropdown-menu">
												<a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profil</a>
												<a href="<?php echo base_url('guru/edit/' . $value['id']) ?>" class="dropdown-item"><i class="fa fa-pencil-alt"></i> edit</a>
												<a class="dropdown-item" href="<?php echo base_url('guru_mapel/edit/?id=' . $value['id']) ?>"><i class="fa fa-bookmark"></i> Mapel</a>
												<a href="<?php echo base_url('guru/delete/' . $value['id']) ?>" onclick="if(confirm('apakah anda yakin ingin menghapus <?php echo $value['nama'] ?>')){}else{return false;};" class="dropdown-item"><i class="fa fa-trash"></i> delete</a>
											</div>
										</div>
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