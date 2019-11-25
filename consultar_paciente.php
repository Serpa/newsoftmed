<?php
include_once "header.php";

include_once "dao/conexao.php";
$result_consultaPaciente = "SELECT *
FROM paciente";
$resultado_consultaPaciente = mysqli_query($con, $result_consultaPaciente);

?>
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Consultar Pacientes</h4>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="basic-datatables" class="display table table-striped table-hover">
									<thead>
										<tr>
											<th>Nome</th>
											<th>Cidade</th>
											<th>Telefone</th>
											<th>Celular</th>
											<th>E-mail</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Nome</th>
											<th>Cidade</th>
											<th>Telefone</th>
											<th>Celular</th>
											<th>E-mail</th>
										</tr>
									</tfoot>
									<tbody>

										<?php while ($rows_consultaPaciente = mysqli_fetch_assoc($resultado_consultaPaciente)) {
											?>
											<tr>
												<td><?php echo $rows_consultaPaciente['nomePaciente']; ?></td>
												<td><?php echo $rows_consultaPaciente['cidade']."-".$rows_consultaPaciente['estado']; ?></td>
												<td><?php echo $rows_consultaPaciente['telefone']; ?></td>
												<td><?php echo $rows_consultaPaciente['celular']; ?></td>
												<td><?php echo $rows_consultaPaciente['email']; ?></td>

												<td>
													<?php echo "<a class='btn btn-primary' href='consultar_cargo.php?id=" . $rows_consultaPaciente['idPaciente'] . "' data-toggle='modal' data-target='#ModalAlterar" . $rows_consultaPaciente['idPaciente'] . "'>" ?>Alterar<?php echo "</a>"; ?>


													<!-- Modal-->

													<div class="modal fade" id="ModalAlterar<?php echo $rows_consultaPaciente['idPaciente']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="exampleModalLabel">Alterar Cargo</h5>
																	<button class="close" type="button" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">×</span>
																	</button>
																</div>
																<div class="modal-body">
																	<form action="AlterarCargo.php" method="POST">

																		<input type="text" hidden name="idCargo" class="form-control" value="<?php echo $rows_consultaPaciente['idCargo']; ?>">


																		<label>Descrição</label>
																		<input type="text" class="form-control" name="descricao" value="<?php echo $rows_consultaPaciente['descricao']; ?>">

																</div>
																<div class="modal-footer">
																	<button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
																	<input type="submit" name="enviar" class="btn btn-success" value="Salvar">
																	</form>

																</div>
															</div>
														</div>
													</div>
												</td>

												</td>
											</tr>
										<?php } ?>
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