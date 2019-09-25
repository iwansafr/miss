<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="col-md-12">
	<a href="<?php echo base_url('user/list') ?>" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> kembali</a>
	<hr>
	<?php if (!empty($data['msg'])): ?>
		<?php echo alert($data['status'],$data['msg']) ?>
		<?php if (!empty($data['msgs'])): ?>
			<?php foreach ($data['msgs'] as $key => $value): ?>
					<?php echo alert($data['status'], $value) ?>
				<?php endforeach ?>	
		<?php endif ?>
	<?php endif ?>	
</div>