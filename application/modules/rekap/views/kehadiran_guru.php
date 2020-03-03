<div class="col-md-12">
	<?php
	$hari = [1=>'Senin',2=>'Selasa',3=>'Rabu',4=>'Kamis',5=>'Jumat'];
	$current_hour = date('H:i');
	foreach ($data as $key => $value) {
		foreach ($value as $vkey => $vvalue) {
			?>
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
							<th colspan="5"><?php echo 'Jadwal Hari '.$hari[$vvalue[0]['hari']] ?> <?php echo $vvalue[0]['nama'] ?></th>
					</thead>
					<tbody>
							<th>Mapel</th>
							<th>Mulai</th>
							<th>Selesai</th>
							<th>status</th>
							<th style="width: 90px;">Edit</th>
						<?php foreach ($vvalue as $vvkey => $vvvalue): ?>
							<?php 
							if($current_hour>=$vvvalue['jam_mulai']){
								$status = 'Kosong';
								$jam = '';
								$alert = 'danger';
							}else{
								$status = 'Belum Mulai';
								$jam = '';
								$alert = 'warning';
							}
							foreach ($presensi as $pkey => $pvalue) 
							{
								if($pvalue['kelas_id'] == $vvvalue['kelas_id'] && $pvalue['mapel_id'] == $vvvalue['mapel_id']){
									$status = 'Hadir';
									$jam = $pvalue['jam'];
									$alert = 'success';
								}
							}
							?>
							<tr>
								<td><span class="badge"><?php echo $vvvalue['mapel'].' | '.$vvvalue['guru'] ?></span></td>
								<td><?php echo $vvvalue['jam_mulai'] ?></td>
								<td><?php echo $vvvalue['jam_selesai'] ?></td>
								<td><span class="badge badge-<?php echo $alert ?>"><?php echo $status.' '.$jam ?></span></td>
								<td><a href="<?php echo base_url('guru_mapel/mapel_edit/'.$vvvalue['id']);?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i> edit</a></td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<?php
		}
	}?>
</div>