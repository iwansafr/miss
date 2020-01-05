<?php defined('BASEPATH') or exit('No direct script access allowed');

?>
<div class="col-md-12">
	<a href="<?php echo base_url('guru/download_template') ?>" target="_blank" class="btn btn-warning btn-sm"><i class="fa fa-download"></i> Download Template</a>
	<hr>
	<div class="panel panel-default card card-default">
		<div class="panel panel-heading card card-header">
			upload data guru
		</div>
		<form action="" method="post" enctype="multipart/form-data" id="guru_form">
			<div class="panel panel-body card card-body">
				<div class="form-group">
					<label for="">upload excel</label>
					<input type="file" name="doc" class="form-control">
				</div>
			</div>
			<div class="panel panel-footer card card-footer">
				<div class="form-group">
					<button type="submit" class="btn btn-success"><i class="fa fa-upload"></i>Upload</button>
				</div>
			</div>
		</form>
	</div>
	<hr>
	<div class="progress progress-md active hidden" id="guru_load">
		<div id="guru_pro" class="progress-bar bg-warning progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
			<span class="sr-only" id="guru_span">0% Complete</span>
		</div>
	</div>
	<hr>
	<div class="progress progress-md active hidden" id="guru_success_load">
		<div id="guru_success_pro" class="progress-bar bg-success progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
			<span class="sr-only" id="guru_span">0% Complete</span>
		</div>
	</div>
	<div id="error"></div>
	<hr>
</div>