<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-md-12">

	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-table"></i>
			Data siswa
			<a href="<?php echo base_url('siswa/download_template') ?>" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-download"></i> template</a>
			<a href="<?php echo base_url('siswa/upload') ?>" class="btn btn-success btn-sm"><i class="fa fa-upload"></i> upload</a>
			<a href="<?php echo base_url('siswa') ?>" class="btn btn-success btn-sm">all</a>
			<?php if (!$this->input->get('k')) : ?>
				<div style="padding-top:2%;">
					<select class="custom-select" size="3">
						<?php foreach ($kelas as $key => $value) : ?>
							<option onclick="window.location='<?php echo base_url('siswa/list?id_k=') ?><?= $value['id']; ?>'"><?= $value['nama']; ?></option>
						<?php endforeach ?>
					</select>
				</div>
			<?php endif ?>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>nama</th>
							<th>gender</th>
							<th>kelas</th>
							<th>agama</th>
							<th>action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>No</th>
							<th>nama</th>
							<th>gender</th>
							<th>kelas</th>
							<th>agama</th>
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
									<td><?php echo $gender[$value['gender']] ?></td>
									<td><?php echo $kelas_o[$value['kelas_id']] ?></td>
									<td><?php echo $agama[$value['agama']] ?></td>
									<td>
										<div class="dropdown">
											<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
												Action
											</button>
											<div class="dropdown-menu">
												<a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profil</a>
												<a href="<?php echo base_url('siswa/edit/' . $value['id']) ?>" class="dropdown-item"><i class="fa fa-pencil-alt"></i> edit</a>
												<a href="<?php echo base_url('siswa/delete/' . $value['nisn']) ?>" onclick="if(confirm('apakah anda yakin ingin menghapus <?php echo $value['nama'] ?>')){}else{return false;};" class="dropdown-item"><i class="fa fa-trash"></i> delete</a>
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