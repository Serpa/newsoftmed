<?php
include_once "dao/conexao.php";
include_once "header.php";
$profile = mysqli_query($con,"SELECT * FROM funcionario WHERE idFuncionario = $_SESSION[idFuncionario]");
$result_profile = mysqli_fetch_array($profile);
?>
<div class="main-panel">
  <div class="content">
    <div class="page-inner">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <!-- Start Content -->
              <div class="card-title">Meu Perfil</div>
            </div>
            <form class="form-horizontal style-form" action="envio_funcionarios.php" method="post">
              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                  <input type="text" class="form-control" name="nome" required="required" value="<?php echo $result_profile['nomeFuncionario'];?>">
              </div>

              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">RG</label>
                  <input type="text" class="form-control" name="rg" required="required" value="<?php echo $result_profile['rg'];?>">
              </div>

              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">CPF</label>
                  <input type="text" class="form-control" name="cpf" required="required" value="<?php echo $result_profile['cpf'];?>" onkeyup="mascara('###.###.###-##',this,event,true)">
              </div>

              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Data de Nascimento</label>
                  <input type="date" class="form-control" name="dtnascimento" required="required" value="<?php echo $result_profile['dtNascimento'];?>">
              </div>

              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Data de Admissão</label>
                  <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" name="dtadmissao" required="required" value="<?php echo $result_profile['dtNascimento'];?>">
              </div>

              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">E-Mail</label>
                  <input type="mail" class="form-control" name="email" required="required" value="<?php echo $result_profile['email'];?>">
              </div>

              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Telefone</label>
                  <input type="tel" class="form-control" name="tel" required="required" onkeyup="mascara('(##)####-####',this,event,true)" value="<?php echo $result_profile['telefone'];?>">
              </div>


              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Celular</label>
                  <input type="tel" class="form-control" name="cel" required="required" onkeyup="mascara('(##)#####-####',this,event,true)" value="<?php echo $result_profile['celular'];?>">
              </div>

              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">CEP</label>
                  <input type="text" class="form-control" id="cep" name="cep" required="required" onkeyup="mascara('##.###-###',this,event,true)" value="<?php echo $result_profile['cep'];?>">
              </div>

              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Rua</label>
                  <input type="text" class="form-control" id="rua" name="rua" required="required" value="<?php echo $result_profile['rua'];?>">
              </div>

              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Número</label>
                  <input type="text" class="form-control" id="num" name="num" required="required" value="<?php echo $result_profile['numero'];?>">
              </div>

              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Bairro</label>
                  <input type="text" class="form-control" id="bairro" name="bairro" required="required" value="<?php echo $result_profile['bairro'];?>">
              </div>

              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Estados</label>
				  <select class="form-control" id="estado" name="estado" onchange="buscaCidades(this.value)">
				  <?php if($result_profile['estado']==AC)echo 'selected';?>
                    <option value="">Selecione o Estado</option>
                    <option value="AC" <?php if($result_profile['estado']=='AC')echo 'selected';?>>Acre</option>
                    <option value="AL" <?php if($result_profile['estado']=='AL')echo 'selected';?>>Alagoas</option>
                    <option value="AM" <?php if($result_profile['estado']=='AM')echo 'selected';?>>Amazonas</option>
                    <option value="AP" <?php if($result_profile['estado']=='AP')echo 'selected';?>>Amapá</option>
                    <option value="BA" <?php if($result_profile['estado']=='BA')echo 'selected';?>>Bahia</option>
                    <option value="CE" <?php if($result_profile['estado']=='CE')echo 'selected';?>>Ceará</option>
                    <option value="DF" <?php if($result_profile['estado']=='DF')echo 'selected';?>>Distrito Federal</option>
                    <option value="ES" <?php if($result_profile['estado']=='ES')echo 'selected';?>>Espírito Santo</option>
                    <option value="GO" <?php if($result_profile['estado']=='GO')echo 'selected';?>>Goiás</option>
                    <option value="MA" <?php if($result_profile['estado']=='MA')echo 'selected';?>>Maranhão</option>
                    <option value="MG" <?php if($result_profile['estado']=='MG')echo 'selected';?>>Minas Gerais</option>
                    <option value="MS" <?php if($result_profile['estado']=='MS')echo 'selected';?>>Mato Grosso do Sul</option>
                    <option value="MT" <?php if($result_profile['estado']=='MT')echo 'selected';?>>Mato Grosso</option>
                    <option value="PA" <?php if($result_profile['estado']=='PA')echo 'selected';?>>Pará</option>
                    <option value="PB" <?php if($result_profile['estado']=='PB')echo 'selected';?>>Paraíba</option>
                    <option value="PE" <?php if($result_profile['estado']=='PE')echo 'selected';?>>Pernambuco</option>
                    <option value="PI" <?php if($result_profile['estado']=='PI')echo 'selected';?>>Piauí</option>
                    <option value="PR" <?php if($result_profile['estado']=='PR')echo 'selected';?>>Paraná</option>
                    <option value="RJ" <?php if($result_profile['estado']=='RJ')echo 'selected';?>>Rio de Janeiro</option>
                    <option value="RN" <?php if($result_profile['estado']=='RN')echo 'selected';?>>Rio Grande do Norte</option>
                    <option value="RO" <?php if($result_profile['estado']=='RO')echo 'selected';?>>Rondônia</option>
                    <option value="RR" <?php if($result_profile['estado']=='RR')echo 'selected';?>>Roraima</option>
                    <option value="RS" <?php if($result_profile['estado']=='RS')echo 'selected';?>>Rio Grande do Sul</option>
                    <option value="SC" <?php if($result_profile['estado']=='SC')echo 'selected';?>>Santa Catarina</option>
                    <option value="SE" <?php if($result_profile['estado']=='SE')echo 'selected';?>>Sergipe</option>
                    <option value="SP" <?php if($result_profile['estado']=='SP')echo 'selected';?>>São Paulo</option>
                    <option value="TO" <?php if($result_profile['estado']=='TO')echo 'selected';?>>Tocantins</option>
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
                  <select class="form-control" name="cargos" disabled>
                    <option value="">Selecione o Cargo</option>
                    <?php
                    $resultado_cargos = mysqli_query($con, "SELECT * FROM cargo");
                    while ($row_cargos = mysqli_fetch_assoc($resultado_cargos)) { ?>
                      <option value="<?php echo utf8_encode($row_cargos['idCargo']); ?>"<?php if($result_profile['idCargo']==$row_cargos['idCargo'])echo 'selected';?>><?php echo $row_cargos['descricao']; ?></option>
                    <?php } ?> } ?>
                  </select>
                </div>
              <div class="card-action">
                <button type="submit" class="btn btn-danger" onClick="window.location.href='Index.php'">Cancelar</button>

                <button type="submit" class="btn btn-theme">Salvar</button>
              </div>
            </form>
            <!-- End Content -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
window.onload = function(){
	document.getElementById("cep").focus();
	document.getElementById("cep").blur();
}
</script>

<script src="jquery/jquery-3.4.1.min.js"></script>
<script src="js/states.js"></script>
<script src="js/mascaras.js"></script>

<?php
include_once "footer.php";
?>