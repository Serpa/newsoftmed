<?php
include_once "header.php";

include_once "dao/conexao.php";
$result_consultaCargo = "SELECT *
from cargo" ;
$resultado_consultaCargo = mysqli_query($con, $result_consultaCargo);

?>
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Consultar Cargos</h4>
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

									<?php while($rows_consultaCargo = mysqli_fetch_assoc($resultado_consultaCargo)){ 
 ?>
 <tr>
 <td><?php echo $rows_consultaCargo['descricao']; ?></td>

 <td>
          <?php echo "<a class='btn btn-default' href='consultar_cargo.php?id=".$rows_consultaCargo['idCargo'] ."' data-toggle='modal' data-target='#ModalAlterar".$rows_consultaCargo['idCargo']."'>" ?>Alterar<?php echo "</a>"; ?>

     
    <!-- Modal-->
    
	<div class="modal fade" id="ModalAlterar<?php echo $rows_consultaCargo['idCargo']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

        <input type="text" hidden name="idCargo"  class="form-control" value="<?php echo $rows_consultaCargo['idCargo'];?>">
    

        <label>Descrição</label>
        <input type="text" class="form-control" name="descricao" value="<?php echo $rows_consultaCargo['descricao']; ?>">

        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
          <input type="submit" name="enviar" class="btn btn-success" value="Salvar" >
          </form>

        </div>
      </div>
    </div>
  </div>
</td>
    
    </td>
    </tr>
                  <?php }?>
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