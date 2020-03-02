<div class="col-md-12">
	<?php
	foreach ($data as $key => $value) {
		foreach ($value as $vkey => $vvalue) {
			?>
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<td>Kelas</td>
						<td>Mapel</td>
						<td>Mulai</td>
						<td>Selesai</td>
						<td style="width: 90px;">Edit</td>
					</tr>
					<?php foreach ($vvalue as $vvkey => $vvvalue): ?>
						<tr>
							<td><?php echo $vvvalue['nama'] ?></td>
							<td><?php echo $vvvalue['mapel'] ?></td>
							<td><?php echo $vvvalue['jam_mulai'] ?></td>
							<td><?php echo $vvvalue['jam_selesai'] ?></td>
							<td><a href="<?php echo base_url('guru_mapel/mapel_edit/'.$vvvalue['id']);?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i> edit</a></td>
						</tr>
					<?php endforeach ?>
				</table>
			</div>
			<?php
		}
	}?>
</div>