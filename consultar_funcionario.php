<?php
include_once "header.php";

include_once "dao/conexao.php";
$result_consultaFuncionario = "SELECT F.idFuncionario,
F.nomeFuncionario,
F.rg,
F.cpf,
F.dtNascimento,
F.dtAdmissao,
F.dtDesligamento,
F.rua,
F.numero,
F.bairro,
F.cidade,
F.estado,
F.email,
F.cep,
F.telefone,
F.celular,
F.idCargo,
C.descricao
from funcionario F, cargo C
where F.idCargo = C.idCargo";
$resultado_consultaFuncionario = mysqli_query($con, $result_consultaFuncionario);
?>

<div class="main-panel">
  <div class="content">
    <div class="page-inner">
      <div class="page-header">
        <h4 class="page-title">Consultar Funcionário</h4>
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
                      <th>Email</th>
                      <th>Data de Nascimento</th>
                      <th>Cargo</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Nome</th>
                      <th>Email</th>
                      <th>Data de Nascimento</th>
                      <th>Cargo</th>
                      <th></th>
                    </tr>
                  </tfoot>
                  <tbody>

                    <?php while ($rows_consultaFuncionario = mysqli_fetch_assoc($resultado_consultaFuncionario)) {
                      ?>
                      <tr>
                        <td><?php echo $rows_consultaFuncionario['nomeFuncionario']; ?></td>
                        <td><?php echo $rows_consultaFuncionario['email']; ?></td>
                        <td><?php echo $rows_consultaFuncionario['dtNascimento']; ?></td>
                        <td><?php echo $rows_consultaFuncionario['descricao']; ?></td>

                        <td>
                          <?php echo "<a class='btn btn-default' href='consultar_cargo.php?id=" . $rows_consultaFuncionario['idFuncionario'] . "' data-toggle='modal' data-target='#ModalAlterar" . $rows_consultaFuncionario['idFuncionario'] . "'>" ?><i class="fas fa-edit"></i><?php echo "</a>"; ?>
                          <?php echo "<a class='btn btn-default' href='consultar_cargo.php?id=" . $rows_consultaFuncionario['idFuncionario'] . "' data-toggle='modal' data-target='#ModalMaisInfo" . $rows_consultaFuncionario['idFuncionario'] . "'>" ?><i class="fas fa-plus-square"></i><?php echo "</a>"; ?>


                          <!-- Modal-->

                          <div class="modal fade" id="ModalAlterar<?php echo $rows_consultaFuncionario['idFuncionario']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Alterar Funcionário</h5>
                                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form action="alterar_funcionario.php" method="POST">

                                    <input type="text" readonly hidden name="idFuncionario" class="form-control" value="<?php echo $rows_consultaFuncionario['idFuncionario']; ?>">

                                    <label>Nome</label>
                                    <input type="text" class="form-control" required name="nomeFuncionario" value="<?php echo $rows_consultaFuncionario['nomeFuncionario']; ?>">

                                    <label>RG</label>
                                    <input type="text" class="form-control" required name="rg" value="<?php echo $rows_consultaFuncionario['rg']; ?>">

                                    <label>CPF</label>
                                    <input type="text" class="form-control" required name="cpf" value="<?php echo $rows_consultaFuncionario['cpf']; ?>" onkeyup="mascara('###.###.###-##',this,event,true)">

                                    <label>Data de Nascimento</label>
                                    <input type="date" class="form-control" required name="dtNascimento" value="<?php echo $rows_consultaFuncionario['dtNascimento']; ?>">

                                    <label>Data de Admissão</label>
                                    <input type="date" class="form-control" required name="dtAdmissao" value="<?php echo $rows_consultaFuncionario['dtAdmissao']; ?>">

                                    <label>Data de Desligamento</label>
                                    <input type="date" class="form-control" name="dtDesligamento" value="<?php echo $rows_consultaFuncionario['dtDesligamento']; ?>">

                                    <label>CEP</label>
                                    <input type="text" class="form-control" required id="cep" name="cep" value="<?php echo $rows_consultaFuncionario['cep']; ?>" onkeyup="mascara('##.###-###',this,event,true)">

                                    <label>Estado</label>
                                    <select class="form-control" required id="estado" name="estado" onchange="buscaCidades(this.value)">
                                      <option value="">Selecione o Estado</option>
                                      <option value="AC" <?php if ($rows_consultaFuncionario['estado'] == 'AC') echo 'selected'; ?>>Acre</option>
                                      <option value="AL" <?php if ($rows_consultaFuncionario['estado'] == 'AL') echo 'selected'; ?>>Alagoas</option>
                                      <option value="AM" <?php if ($rows_consultaFuncionario['estado'] == 'AM') echo 'selected'; ?>>Amazonas</option>
                                      <option value="AP" <?php if ($rows_consultaFuncionario['estado'] == 'AP') echo 'selected'; ?>>Amapá</option>
                                      <option value="BA" <?php if ($rows_consultaFuncionario['estado'] == 'BA') echo 'selected'; ?>>Bahia</option>
                                      <option value="CE" <?php if ($rows_consultaFuncionario['estado'] == 'CE') echo 'selected'; ?>>Ceará</option>
                                      <option value="DF" <?php if ($rows_consultaFuncionario['estado'] == 'DF') echo 'selected'; ?>>Distrito Federal</option>
                                      <option value="ES" <?php if ($rows_consultaFuncionario['estado'] == 'ES') echo 'selected'; ?>>Espírito Santo</option>
                                      <option value="GO" <?php if ($rows_consultaFuncionario['estado'] == 'GO') echo 'selected'; ?>>Goiás</option>
                                      <option value="MA" <?php if ($rows_consultaFuncionario['estado'] == 'MA') echo 'selected'; ?>>Maranhão</option>
                                      <option value="MG" <?php if ($rows_consultaFuncionario['estado'] == 'MG') echo 'selected'; ?>>Minas Gerais</option>
                                      <option value="MS" <?php if ($rows_consultaFuncionario['estado'] == 'MS') echo 'selected'; ?>>Mato Grosso do Sul</option>
                                      <option value="MT" <?php if ($rows_consultaFuncionario['estado'] == 'MT') echo 'selected'; ?>>Mato Grosso</option>
                                      <option value="PA" <?php if ($rows_consultaFuncionario['estado'] == 'PA') echo 'selected'; ?>>Pará</option>
                                      <option value="PB" <?php if ($rows_consultaFuncionario['estado'] == 'PB') echo 'selected'; ?>>Paraíba</option>
                                      <option value="PE" <?php if ($rows_consultaFuncionario['estado'] == 'PE') echo 'selected'; ?>>Pernambuco</option>
                                      <option value="PI" <?php if ($rows_consultaFuncionario['estado'] == 'PI') echo 'selected'; ?>>Piauí</option>
                                      <option value="PR" <?php if ($rows_consultaFuncionario['estado'] == 'PR') echo 'selected'; ?>>Paraná</option>
                                      <option value="RJ" <?php if ($rows_consultaFuncionario['estado'] == 'RJ') echo 'selected'; ?>>Rio de Janeiro</option>
                                      <option value="RN" <?php if ($rows_consultaFuncionario['estado'] == 'RN') echo 'selected'; ?>>Rio Grande do Norte</option>
                                      <option value="RO" <?php if ($rows_consultaFuncionario['estado'] == 'RO') echo 'selected'; ?>>Rondônia</option>
                                      <option value="RR" <?php if ($rows_consultaFuncionario['estado'] == 'RR') echo 'selected'; ?>>Roraima</option>
                                      <option value="RS" <?php if ($rows_consultaFuncionario['estado'] == 'RS') echo 'selected'; ?>>Rio Grande do Sul</option>
                                      <option value="SC" <?php if ($rows_consultaFuncionario['estado'] == 'SC') echo 'selected'; ?>>Santa Catarina</option>
                                      <option value="SE" <?php if ($rows_consultaFuncionario['estado'] == 'SE') echo 'selected'; ?>>Sergipe</option>
                                      <option value="SP" <?php if ($rows_consultaFuncionario['estado'] == 'SP') echo 'selected'; ?>>São Paulo</option>
                                      <option value="TO" <?php if ($rows_consultaFuncionario['estado'] == 'TO') echo 'selected'; ?>>Tocantins</option>
                                    </select>

                                    <label>Cidade</label>
                                    <input type="text" class="form-control" required name="cidade" id="cidade" value="<?php echo $rows_consultaFuncionario['cidade']; ?>">

                                    <label>Rua</label>
                                    <input type="text" class="form-control" required name="rua" id="rua" value="<?php echo $rows_consultaFuncionario['rua']; ?>">

                                    <label>Número</label>
                                    <input type="text" class="form-control" required name="numero" value="<?php echo $rows_consultaFuncionario['numero']; ?>">

                                    <label>Bairro</label>
                                    <input type="text" class="form-control" required id="bairro" name="bairro" required="required" value="<?php echo $rows_consultaFuncionario['bairro']; ?>">

                                    <label>Telefone</label>
                                    <input type="text" class="form-control" required name="telefone" value="<?php echo $rows_consultaFuncionario['telefone']; ?>" onkeyup="mascara('(##)####-####',this,event,true)">

                                    <label>Celular</label>
                                    <input type="text" class="form-control" required name="celular" value="<?php echo $rows_consultaFuncionario['celular']; ?>" onkeyup="mascara('(##)#####-####',this,event,true)">

                                    <label>Email</label>
                                    <input type="text" class="form-control" required name="email" value="<?php echo $rows_consultaFuncionario['email']; ?>">

                                    <label>Cargo</label>
                                    <select class="form-control" required name="cargos">
                                      <option value="">Selecione o Cargo</option>
                                      <?php
                                        $resultado_cargos = mysqli_query($con, "SELECT * FROM cargo");
                                        while ($row_cargos = mysqli_fetch_assoc($resultado_cargos)) { ?>
                                        <option value="<?php echo $row_cargos['idCargo']; ?>" <?php if ($rows_consultaFuncionario['idCargo'] == $row_cargos['idCargo']) echo 'selected'; ?>><?php echo $row_cargos['descricao']; ?></option>
                                      <?php } ?> } ?>
                                    </select>

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


                        <div class="modal fade" id="ModalMaisInfo<?php echo $rows_consultaFuncionario['idFuncionario']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                  <input type="text" disabled class="form-control" name="nomeFuncionario" value="<?php echo $rows_consultaFuncionario['nomeFuncionario']; ?>">

                                  <label>RG</label>
                                  <input type="text" disabled class="form-control" name="rg" value="<?php echo $rows_consultaFuncionario['rg']; ?>">

                                  <label>CPF</label>
                                  <input type="text" disabled class="form-control" name="cpf" value="<?php echo $rows_consultaFuncionario['cpf']; ?>">

                                  <label>Data de Nascimento</label>
                                  <input type="text" disabled class="form-control" name="dtNascimento" value="<?php echo $rows_consultaFuncionario['dtNascimento']; ?>">

                                  <label>Data de Admissão</label>
                                  <input type="text" disabled class="form-control" name="dtAdmissao" value="<?php echo $rows_consultaFuncionario['dtAdmissao']; ?>">

                                  <label>Data de Desligamento</label>
                                  <input type="text" disabled class="form-control" name="dtDesligamento" value="<?php echo $rows_consultaFuncionario['dtDesligamento']; ?>">

                                  <label>Rua</label>
                                  <input type="text" disabled class="form-control" name="rua" value="<?php echo $rows_consultaFuncionario['rua']; ?>">

                                  <label>Número</label>
                                  <input type="text" disabled class="form-control" name="numero" value="<?php echo $rows_consultaFuncionario['numero']; ?>">

                                  <label>Bairro</label>
                                  <input type="text" disabled class="form-control" name="bairro" value="<?php echo $rows_consultaFuncionario['bairro']; ?>">

                                  <label>Cidade</label>
                                  <input type="text" disabled class="form-control" name="cidade" value="<?php echo $rows_consultaFuncionario['cidade']; ?>">

                                  <label>Estado</label>
                                  <input type="text" disabled class="form-control" name="estado" value="<?php echo $rows_consultaFuncionario['estado']; ?>">

                                  <label>CEP</label>
                                  <input type="text" disabled class="form-control" name="cep" value="<?php echo $rows_consultaFuncionario['cep']; ?>">

                                  <label>Telefone</label>
                                  <input type="text" disabled class="form-control" name="telefone" value="<?php echo $rows_consultaFuncionario['telefone']; ?>">

                                  <label>Celular</label>
                                  <input type="text" disabled class="form-control" name="celular" value="<?php echo $rows_consultaFuncionario['celular']; ?>">

                                  <label>Email</label>
                                  <input type="text" disabled class="form-control" name="email" value="<?php echo $rows_consultaFuncionario['email']; ?>">

                                  <label>Cargo</label>
                                  <input type="text" disabled class="form-control" name="estado" value="<?php echo $rows_consultaFuncionario['descricao']; ?>">




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
      $('#basic-datatables').DataTable({
        "language": {
          "sEmptyTable": "Nenhum registro encontrado",
          "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
          "sInfoFiltered": "(Filtrados de _MAX_ registros)",
          "sInfoPostFix": "",
          "sInfoThousands": ".",
          "sLengthMenu": "_MENU_ resultados por página",
          "sLoadingRecords": "Carregando...",
          "sProcessing": "Processando...",
          "sZeroRecords": "Nenhum registro encontrado",
          "sSearch": "Pesquisar",
          "oPaginate": {
            "sNext": "Próximo",
            "sPrevious": "Anterior",
            "sFirst": "Primeiro",
            "sLast": "Último"
          },
          "oAria": {
            "sSortAscending": ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
          }
        }
      });
    });
  </script>