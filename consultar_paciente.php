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
											<th></th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Nome</th>
											<th>Cidade</th>
											<th>Telefone</th>
											<th>Celular</th>
											<th>E-mail</th>
											<th></th>
										</tr>
									</tfoot>
									<tbody>

										<?php while ($rows_consultaPaciente = mysqli_fetch_array($resultado_consultaPaciente)) {
											?>
											<tr>
												<td><?php echo $rows_consultaPaciente['nomePaciente']; ?></td>
												<td><?php echo $rows_consultaPaciente['cidade'] . "-" . $rows_consultaPaciente['estado']; ?></td>
												<td><?php echo $rows_consultaPaciente['telefone']; ?></td>
												<td><?php echo $rows_consultaPaciente['celular']; ?></td>
												<td><?php echo $rows_consultaPaciente['email']; ?></td>

												<td>
													<?php echo "<a class='btn btn-primary' href='consultar_cargo.php?id=" . $rows_consultaPaciente['idPaciente'] . "' data-toggle='modal' data-target='#ModalAlterar" . $rows_consultaPaciente['idPaciente'] . "'>" ?>Alterar<?php echo "</a>"; ?>
													<?php echo "<a class='btn btn-primary' href='consultar_cargo.php?id=" . $rows_consultaPaciente['idPaciente'] . "' data-toggle='modal' data-target='#ModalMaisInfo" . $rows_consultaPaciente['idPaciente'] . "'>" ?><i class="fas fa-plus-square"></i><?php echo "</a>"; ?>


													<!-- Modal-->

													<div class="modal fade" id="ModalAlterar<?php echo $rows_consultaPaciente['idPaciente']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="exampleModalLabel">Alterar Paciente</h5>
																	<button class="close" type="button" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">×</span>
																	</button>
																</div>
																<div class="modal-body">
																	<form action="AlterarCargo.php" method="POST">

																		<label>Nome</label>
																		<input type="text" class="form-control" name="nomePaciente" value="<?php echo $rows_consultaPaciente['nomePaciente']; ?>">

																		<label>RG</label>
																		<input type="text" class="form-control" name="rg" value="<?php echo $rows_consultaPaciente['rg']; ?>">

																		<label>CPF</label>
																		<input type="text" class="form-control" name="cpf" required="required" onkeyup="mascara('###.###.###-##',this,event,true)" value="<?php echo $rows_consultaPaciente['cpf']; ?>">

																		<label>Data de Nascimento</label>
																		<input type="date" class="form-control" name="dtNascimento" value="<?php echo $rows_consultaPaciente['dtNascimento']; ?>">

																		<label>Nome da Mãe</label>
																		<input type="text" class="form-control" name="mae" value="<?php echo $rows_consultaPaciente['nomeMae']; ?>">

																		<label>Nome do Pai</label>
																		<input type="text" class="form-control" name="pai" value="<?php echo $rows_consultaPaciente['nomePai']; ?>">

																		<label>CEP</label>
																		<input type="text" class="form-control" id="cep" name="cep" value="<?php echo $rows_consultaPaciente['cep']; ?>" onkeyup="mascara('##.###-###',this,event,true)">

																		<label>Estado</label>
																		<select class="form-control" id="estado" name="estado" onchange="buscaCidades(this.value)">
																			<option value="">Selecione o Estado</option>
																			<option value="AC" <?php if ($rows_consultaPaciente['estado'] == 'AC') echo 'selected'; ?>>Acre</option>
																			<option value="AL" <?php if ($rows_consultaPaciente['estado'] == 'AL') echo 'selected'; ?>>Alagoas</option>
																			<option value="AM" <?php if ($rows_consultaPaciente['estado'] == 'AM') echo 'selected'; ?>>Amazonas</option>
																			<option value="AP" <?php if ($rows_consultaPaciente['estado'] == 'AP') echo 'selected'; ?>>Amapá</option>
																			<option value="BA" <?php if ($rows_consultaPaciente['estado'] == 'BA') echo 'selected'; ?>>Bahia</option>
																			<option value="CE" <?php if ($rows_consultaPaciente['estado'] == 'CE') echo 'selected'; ?>>Ceará</option>
																			<option value="DF" <?php if ($rows_consultaPaciente['estado'] == 'DF') echo 'selected'; ?>>Distrito Federal</option>
																			<option value="ES" <?php if ($rows_consultaPaciente['estado'] == 'ES') echo 'selected'; ?>>Espírito Santo</option>
																			<option value="GO" <?php if ($rows_consultaPaciente['estado'] == 'GO') echo 'selected'; ?>>Goiás</option>
																			<option value="MA" <?php if ($rows_consultaPaciente['estado'] == 'MA') echo 'selected'; ?>>Maranhão</option>
																			<option value="MG" <?php if ($rows_consultaPaciente['estado'] == 'MG') echo 'selected'; ?>>Minas Gerais</option>
																			<option value="MS" <?php if ($rows_consultaPaciente['estado'] == 'MS') echo 'selected'; ?>>Mato Grosso do Sul</option>
																			<option value="MT" <?php if ($rows_consultaPaciente['estado'] == 'MT') echo 'selected'; ?>>Mato Grosso</option>
																			<option value="PA" <?php if ($rows_consultaPaciente['estado'] == 'PA') echo 'selected'; ?>>Pará</option>
																			<option value="PB" <?php if ($rows_consultaPaciente['estado'] == 'PB') echo 'selected'; ?>>Paraíba</option>
																			<option value="PE" <?php if ($rows_consultaPaciente['estado'] == 'PE') echo 'selected'; ?>>Pernambuco</option>
																			<option value="PI" <?php if ($rows_consultaPaciente['estado'] == 'PI') echo 'selected'; ?>>Piauí</option>
																			<option value="PR" <?php if ($rows_consultaPaciente['estado'] == 'PR') echo 'selected'; ?>>Paraná</option>
																			<option value="RJ" <?php if ($rows_consultaPaciente['estado'] == 'RJ') echo 'selected'; ?>>Rio de Janeiro</option>
																			<option value="RN" <?php if ($rows_consultaPaciente['estado'] == 'RN') echo 'selected'; ?>>Rio Grande do Norte</option>
																			<option value="RO" <?php if ($rows_consultaPaciente['estado'] == 'RO') echo 'selected'; ?>>Rondônia</option>
																			<option value="RR" <?php if ($rows_consultaPaciente['estado'] == 'RR') echo 'selected'; ?>>Roraima</option>
																			<option value="RS" <?php if ($rows_consultaPaciente['estado'] == 'RS') echo 'selected'; ?>>Rio Grande do Sul</option>
																			<option value="SC" <?php if ($rows_consultaPaciente['estado'] == 'SC') echo 'selected'; ?>>Santa Catarina</option>
																			<option value="SE" <?php if ($rows_consultaPaciente['estado'] == 'SE') echo 'selected'; ?>>Sergipe</option>
																			<option value="SP" <?php if ($rows_consultaPaciente['estado'] == 'SP') echo 'selected'; ?>>São Paulo</option>
																			<option value="TO" <?php if ($rows_consultaPaciente['estado'] == 'TO') echo 'selected'; ?>>Tocantins</option>
																		</select>

																		<label>Cidade</label>
																		<input type="text" class="form-control" name="cidade" id="cidade" value="<?php echo $rows_consultaPaciente['cidade']; ?>">

																		<label>Rua</label>
																		<input type="text" class="form-control" name="rua" id="rua" value="<?php echo $rows_consultaPaciente['rua']; ?>">

																		<label>Número</label>
																		<input type="text" class="form-control" name="numero" value="<?php echo $rows_consultaPaciente['numero']; ?>">

																		<label>Bairro</label>
																		<input type="text" class="form-control" id="bairro" name="bairro" required="required" value="<?php echo $rows_consultaPaciente['bairro']; ?>">

																		<label>Telefone</label>
																		<input type="text" class="form-control" name="telefone" value="<?php echo $rows_consultaPaciente['telefone']; ?>">

																		<label>Celular</label>
																		<input type="text" class="form-control" name="celular" value="<?php echo $rows_consultaPaciente['celular']; ?>">

																		<label>Email</label>
																		<input type="text" class="form-control" name="email" value="<?php echo $rows_consultaPaciente['email']; ?>">

																		<label>Tipo Sanguíneo</label>
																		<select class="form-control" name="tipoSanguineo" required="required">
																			<option value="">Selecione o Tipo Sanguíneo</option>
																			<option value="O-" <?php if ($rows_consultaPaciente['tipoSanguineo'] == 'O-') echo "selected"; ?>>O-</option>
																			<option value="O+" <?php if ($rows_consultaPaciente['tipoSanguineo'] == 'O+') echo "selected"; ?>>O+</option>
																			<option value="A-" <?php if ($rows_consultaPaciente['tipoSanguineo'] == 'A-') echo "selected"; ?>>A-</option>
																			<option value="A+" <?php if ($rows_consultaPaciente['tipoSanguineo'] == 'A+') echo "selected"; ?>>A+</option>
																			<option value="B-" <?php if ($rows_consultaPaciente['tipoSanguineo'] == 'B-') echo "selected"; ?>>B-</option>
																			<option value="B+" <?php if ($rows_consultaPaciente['tipoSanguineo'] == 'B+') echo "selected"; ?>>B+</option>
																			<option value="AB-" <?php if ($rows_consultaPaciente['tipoSanguineo'] == 'AB-') echo "selected"; ?>>AB-</option>
																			<option value="AB+" <?php if ($rows_consultaPaciente['tipoSanguineo'] == 'AB+') echo "selected"; ?>>AB+</option>
																		</select>

																		<label>Altura</label>
																		<input type="number" class="form-control" id="altura" name="altura" min="50" max="250" required="required" value="<?php echo $rows_consultaPaciente['altura']; ?>">
																		<span>*Em centimetros</span>

																		<label>Peso</label>
																		<input type="number" class="form-control" id="peso" name="peso" min="2" max="250" required="required" value="<?php echo $rows_consultaPaciente['peso']; ?>">
																		<span>*Em Quilogramas</span>
																</div>
																<div class="modal-footer">
																	<button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
																	<input type="submit" name="enviar" class="btn btn-success" value="Salvar">
																	</form>
																</div>
															</div>
														</div>
													</div>
													<div class="modal fade" id="ModalMaisInfo<?php echo $rows_consultaPaciente['idPaciente']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="exampleModalLabel">Mais Informações</h5>
																	<button class="close" type="button" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">×</span>
																	</button>
																</div>
																<div class="modal-body">
																	<form>
																		<label>Nome</label>
																		<input type="text" disabled class="form-control" name="nomePaciente" value="<?php echo $rows_consultaPaciente['nomePaciente']; ?>">

																		<label>RG</label>
																		<input type="text" disabled class="form-control" name="rg" value="<?php echo $rows_consultaPaciente['rg']; ?>">

																		<label>CPF</label>
																		<input type="text" disabled class="form-control" name="cpf" value="<?php echo $rows_consultaPaciente['cpf']; ?>">

																		<label>Data de Nascimento</label>
																		<input type="text" disabled class="form-control" name="dtNascimento" value="<?php echo $rows_consultaPaciente['dtNascimento']; ?>">

																		<label>Nome da Mãe</label>
																		<input type="text" disabled class="form-control" name="mae" value="<?php echo $rows_consultaPaciente['cpf']; ?>">

																		<label>Nome do Pai</label>
																		<input type="text" disabled class="form-control" name="pai" value="<?php echo $rows_consultaPaciente['cpf']; ?>">

																		<label>Rua</label>
																		<input type="text" disabled class="form-control" name="ruaa" value="<?php echo $rows_consultaPaciente['rua']; ?>">

																		<label>Número</label>
																		<input type="text" disabled class="form-control" name="numeroa" value="<?php echo $rows_consultaPaciente['numero']; ?>">

																		<label>Bairro</label>
																		<input type="text" disabled class="form-control" name="bairroa" value="<?php echo $rows_consultaPaciente['bairro']; ?>">

																		<label>Cidade</label>
																		<input type="text" disabled class="form-control" name="cidadea" value="<?php echo $rows_consultaPaciente['cidade']; ?>">

																		<label>Estado</label>
																		<input type="text" disabled class="form-control" name="estadoa" value="<?php echo $rows_consultaPaciente['estado']; ?>">

																		<label>CEP</label>
																		<input type="text" disabled class="form-control" name="cepa" value="<?php echo $rows_consultaPaciente['cep']; ?>">

																		<label>Telefone</label>
																		<input type="text" disabled class="form-control" name="telefone" value="<?php echo $rows_consultaPaciente['telefone']; ?>">

																		<label>Celular</label>
																		<input type="text" disabled class="form-control" name="celular" value="<?php echo $rows_consultaPaciente['celular']; ?>">

																		<label>Email</label>
																		<input type="text" disabled class="form-control" name="email" value="<?php echo $rows_consultaPaciente['email']; ?>">

																		<label>Tipo Sanguíneo</label>
																		<input type="text" disabled class="form-control" name="tipoSanguineo" value="<?php echo $rows_consultaPaciente['tipoSanguineo']; ?>">

																		<label>Altura</label>
																		<input type="number" disabled class="form-control" id="altura" name="altura" min="50" max="250" required="required" value="<?php echo $rows_consultaPaciente['altura']; ?>">
																		<span>*Em centimetros</span>

																		<label>Peso</label>
																		<input type="number" disabled class="form-control" id="peso" name="peso" min="2" max="250" required="required" value="<?php echo $rows_consultaPaciente['peso']; ?>">
																		<span>*Em Quilogramas</span>
																</div>
																<div class="modal-footer">
																	<button class="btn btn-danger" type="button" data-dismiss="modal">Fechar</button>
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

	<script src="jquery/jquery-3.4.1.min.js"></script>
	<script src="js/states.js"></script>
	<script src="js/mascaras.js"></script>

	<?php
	include_once "footer.php"
	?>
	<script>
		$(document).ready(function() {
			$('#basic-datatables').DataTable({});
		});
	</script>