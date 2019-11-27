<?php
include_once "dao/conexao.php";
include_once "header.php";
if ($_SESSION['idCargo']  != 3 && $_SESSION['idCargo'] != 2) {
    echo "<script>alert('Você não tem acesso ao cadastro de pacientes!');window.location='index.php'</script>";
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
                            <div class="card-title">Cadastro de Paciente</div>
                        </div>
                        <form class="form-horizontal style-form" action="envio_paciente.php" method="post">
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
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" name="dtnascimento" required="required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Nome da Mãe</label>
                                    <input type="text" class="form-control" name="nomeMae" required="required">
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Nome do Pai</label>
                                    <input type="text" class="form-control" name="nomePai" required="required">
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">E-Mail</label>
                                    <input type="mail" class="form-control" name="email" required="required">
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Telefone</label>
                                <div class="col-sm-4">
                                    <input type="tel" class="form-control" name="tel" required="required" onkeyup="mascara('(##)####-####',this,event,true)">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Celular</label>
                                <div class="col-sm-4">
                                    <input type="tel" class="form-control" name="cel" required="required" onkeyup="mascara('(##)#####-####',this,event,true)">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">CEP</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="cep" name="cep" required="required" onkeyup="mascara('##.###-###',this,event,true)">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Rua</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="rua" name="rua" required="required">
                                </div>
                                <label class="col-sm-1 control-label">Número</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="num" name="num" required="required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Bairro</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="bairro" name="bairro" required="required">
                                </div>
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
                                <label class="col-sm-2 col-sm-2 control-label">Tipo Sanguíneo</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="tipoSanguineo" required="required">
                                        <option value="">Selecione o Tipo Sanguíneo</option>
                                        <option value="O-">O-</option>
                                        <option value="O+">O+</option>
                                        <option value="A-">A-</option>
                                        <option value="A+">A+</option>
                                        <option value="B-">B-</option>
                                        <option value="B+">B+</option>
                                        <option value="AB-">AB-</option>
                                        <option value="AB+">AB+</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Altura</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control" id="altura" name="altura" min="50" max="250" required="required">
                                    <span>*Em centimetros</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Peso</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control" id="peso" name="peso" min="2" max="250" required="required">
                                    <span>*Em Quilogramas</span>
                                </div>
                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-danger" onClick="window.location.href='index.php'">Cancelar</button>

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