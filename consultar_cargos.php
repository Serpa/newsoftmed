<?php
include_once "header.php"
?>
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title"></h4>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">Cargos</h4>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="basic-datatables" class="display table table-striped table-hover">
									<thead>
										<tr>
											<th>Descrição</th>
											<th></th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Descrição</th>
											<th></th>
										</tr>
									</tfoot>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
include_once "footer.php"
?>
<script>
	$(document).ready(function() {
		$('#basic-datatables').DataTable({});
	});
</script>