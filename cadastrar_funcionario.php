<?php
include_once "dao/conexao.php";
include_once "header.php";
if ($_SESSION['idCargo']  != 1) {
  echo "<script>alert('Você não tem acesso ao cadastro de funcionários!');window.location='index.php'</script>";
}
?>
<div class="main-panel">
  <div class="content">
    <div class="page-inner">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <!-- Start Content -->
              <div class="card-title">Cadastro de Funcionário</div>
            </div>
            <form class="form-horizontal style-form" action="envio_funcionarios.php" method="post">
              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                  <input type="text" class="form-control" name="nome" required="required">
              </div>

              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">RG</label>
                  <input type="text" class="form-control" name="rg" required="required">
              </div>

              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">CPF</label>
                  <input type="text" class="form-control" name="cpf" required="required" onkeyup="mascara('###.###.###-##',this,event,true)">
              </div>

              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Data de Nascimento</label>
                  <input type="date" class="form-control" name="dtnascimento" required="required">
              </div>

              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Data de Admissão</label>
                  <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" name="dtadmissao" required="required">
              </div>

              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">E-Mail</label>
                  <input type="mail" class="form-control" name="email" required="required">
              </div>

              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Telefone</label>
                  <input type="tel" class="form-control" name="tel" required="required" onkeyup="mascara('(##)####-####',this,event,true)">
              </div>


              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Celular</label>
                  <input type="tel" class="form-control" name="cel" required="required" onkeyup="mascara('(##)#####-####',this,event,true)">
              </div>

              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">CEP</label>
                  <input type="text" class="form-control" id="cep" name="cep" required="required" onkeyup="mascara('##.###-###',this,event,true)">
              </div>

              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Rua</label>
                  <input type="text" class="form-control" id="rua" name="rua" required="required">
              </div>

              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Número</label>
                  <input type="text" class="form-control" id="num" name="num" required="required">
              </div>

              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Bairro</label>
                  <input type="text" class="form-control" id="bairro" name="bairro" required="required">
              </div>

              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Estados</label>
                  <select class="form-control" id="estado" name="estado" onchange="buscaCidades(this.value)">
                    <option value="">Selecione o Estado</option>
                    <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AM">Amazonas</option>
                    <option value="AP">Amapá</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Ceará</option>
                    <option value="DF">Distrito Federal</option>
                    <option value="ES">Espírito Santo</option>
                    <option value="GO">Goiás</option>
                    <option value="MA">Maranhão</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="MS">Mato Grosso do Sul</option>
                    <option value="MT">Mato Grosso</option>
                    <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piauí</option>
                    <option value="PR">Paraná</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RO">Rondônia</option>
                    <option value="RR">Roraima</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SE">Sergipe</option>
                    <option value="SP">São Paulo</option>
                    <option value="TO">Tocantins</option>
                  </select>
              </div>

              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Cidades</label>
                  <div id="wrapper-cities">
                    <select class="form-control" id="cidade" name="cidade">
                      <option value="">Selecione a Cidade</option>
                    </select>
                  </div>
                </div>

              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Cargo</label>
                  <select class="form-control" name="cargos">
                    <option value="">Selecione o Cargo</option>
                    <?php
                    $resultado_cargos = mysqli_query($con, "SELECT * FROM cargo");
                    while ($row_cargos = mysqli_fetch_assoc($resultado_cargos)) { ?>
                      <option value="<?php echo $row_cargos['idCargo']; ?>"><?php echo $row_cargos['descricao']; ?></option>
                    <?php } ?> } ?>
                  </select>
                </div>
              <div class="card-action">
                <button type="submit" class="btn btn-danger" onClick="window.location.href='Index.php'">Cancelar</button>

                <button type="submit" class="btn btn-theme">Cadastrar</button>
              </div>
            </form>
            <!-- End Content -->
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
include_once "footer.php";
?>