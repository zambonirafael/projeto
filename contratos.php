<?php 

session_start(); 

if((!isset ($_SESSION['logado']) == true))
{
	unset($_SESSION['logado']);
	unset($_SESSION['id']);
	unset($_SESSION['usuario']);
	header('location:index.php');
	}
?>
<?php 

	function __autoload($class_name){
		require_once 'webservice/' . $class_name . '.php';
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Projeto</title>
		<link href="js/libs/bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="js/libs/font-awesome-4.6.3/css/font-awesome.min.css">

		<script src="js/libs/jquery-1.12.3.min.js"></script>
		<script src="js/libs/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>

	</head>
	<body>
		<?php

			$contrato = new Contrato();
			$servico = new Servico();
			$cliente = new Cliente();

			if(isset($_POST['enviar'])){
				
				$id_cliente = $_POST['cliente'];
				$id_servico = $_POST['servico'];
				$data_inicio = $_POST['data_inicio'];
				$data_contratacao = $_POST['data_contratacao'];
				$valor =$_POST['valor'];

				$contrato->setIdCliente($id_cliente);
				$contrato->setIdServico($id_servico);
				$contrato->setDataInicio($data_inicio);
				$contrato->setDataContratacao($data_contratacao);
				$contrato->SetValor($valor);

				$contrato->insert();
			}
		?>
 		<div class="btn-group" style="margin-left:10px;">
		  	<ul class="nav nav-pills">
			  <li role="presentation"><a href="home.php">Home</a></li>
			  <li role="presentation"><a href="cliente.php">Clientes</a></li>
			  <li role="presentation"><a href="servicos.php">Servicos</a></li>
			  <li role="presentation" class="active"><a href="contratos.php">Contratos</a></li>
			  <li role="presentation"><a href="json.php">Json</a></li>
			  <li role="presentation"><a href="sair.php">Sair</a></li>
			</ul>
		</div>
		<div>
		<button class='novo_cliente btn btn-info' style="margin-top: 15px; margin-left:10px;">Novo</button>

		<?php 
			if(isset($_POST['atualizar'])){
				
				$id = $_POST['id'];
				$id_cliente = $_POST['cliente'];
				$id_servico = $_POST['servico'];
				$data_inicio = $_POST['data_inicio'];
				$data_contratacao = $_POST['data_contratacao'];
				$data_fim = $_POST['data_fim'];
				$valor =$_POST['valor'];

				$contrato->setIdCliente($id_cliente);
				$contrato->setIdServico($id_servico);
				$contrato->setDataInicio($data_inicio);
				$contrato->setDataContratacao($data_contratacao);
				$contrato->setDataFim($data_fim);
				$contrato->SetValor($valor);

				$contrato->update($id);
			}
		?>

		<?php 
			if(isset($_GET['acao'])){
				if($_GET['acao'] == 'deletar'){
					$id = (int)$_GET['id'];
					$contrato->delete($id);
				}
			}
		?>

		<?php 
			if(isset($_GET['acao'])){
			if($_GET['acao'] == 'editar'){

			$id = (int)$_GET['id'];
			$resultado = $contrato->find($id);
		?>
		<form action="" method="post" class="form_contratos_atualizar" style="margin-left: 10px; margin-left:10px;">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					    <label for="exampleInputEmail1">Nome Cliente</label>
					    <select name="cliente">
					    	<option></option>
					    	<?php foreach($cliente->findAll() as $key => $value): ?>
					    		<option value="<?php echo $value->id ?><?php $resultado->id_cliente == $value->id ? 'selected = "selected"': '' ?>"><?php echo $value->nome ?></option>
					    	<?php endforeach; ?>
					    </select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					    <label for="exampleInputEmail1">Nome Serviço</label>
					    <select name="servico"> 
					    	<option></option>
					    	<?php foreach($servico->findAll() as $key => $value): ?>
					  
					    		<option value="<?php echo $value->id ?>"><?php echo $value->nome ?></option>
					    	<?php endforeach; ?>
					    </select>
					</div>
				</div>
				<div class="col-md-6">
					<label>Data Contratação</label>
					<input type="date" name="data_contratacao" value="<?php echo $resultado->data_contratacao; ?>">
				</div>
				<div class="col-md-6">
					<label>Data Início</label>
					<input type="date" name="data_inicio" value="<?php echo $resultado->data_inicio; ?>">
				</div>
				<div class="col-md-6">
					<label>Data Fim</label>
					<input type="date" name="data_fim" value="<?php echo $resultado->data_fim; ?>">
				</div>
				<div class="col-md-6">
					<label>valor</label>
					<input type="text" name="valor"value="<?php echo $resultado->valor; ?>">
				</div>
				<div class="col-md-12 btn-group">
					<input type="hidden" name="id" value="<?php echo $resultado->id; ?>">
					<button type="submit" name="atualizar" class="btn btn-default btn_enviar_atualizar btn-success">Enviar</button>
					<button type="submit" name="cancelar" class="btn btn-default btn_cancelar_editar btn-danger">Cancelar</button>
				</div>
			</div>
		</form>
		<?php 
			}
			}
		?> 
		<form action="" method="post" class="form_contratos hidden" style="margin-left: 10px; margin-left:10px;">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					    <label for="exampleInputEmail1">Nome Cliente</label>
					    <select name="cliente">
					    	<option></option>
					    	<?php foreach($cliente->findAll() as $key => $value): ?>
					    		<option value="<?php echo $value->id ?>"><?php echo $value->nome ?></option>
					    	<?php endforeach; ?>
					    </select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					    <label for="exampleInputEmail1">Nome Serviço</label>
					    <select name="servico"> 
					    	<option></option>
					    	<?php foreach($servico->findAll() as $key => $value): ?>
					  
					    		<option value="<?php echo $value->id ?>"><?php echo $value->nome ?></option>
					    	<?php endforeach; ?>
					    </select>
					</div>
				</div>
				<div class="col-md-6">
					<label>Data Contratação</label>
					<input type="date" name="data_contratacao">
				</div>
				<div class="col-md-6">
					<label>Data Início</label>
					<input type="date" name="data_inicio">
				</div>
				<div class="col-md-6">
					<label>valor</label>
					<input type="text" name="valor">
				</div>
				<div class="col-md-12 btn-group">
					<button type="submit" name="enviar" class="btn btn-default btn_enviar_atualizar btn-success">Enviar</button>
					<button type="submit" name="cancelar" class="btn btn-default btn_cancelar_editar btn-danger">Cancelar</button>
				</div>
			</div>
		</form>
			
		<script type="text/javascript">
			var btn_novo = $('.novo_cliente');
			var btn_cancelar = $('.btn_cancelar');
			var form_contratos = $('.form_contratos');

			btn_novo.unbind('click');
			btn_novo.click(function(){
				if(form_contratos.hasClass('hidden')){
					form_contratos.removeClass('hidden');
				}
			});

			btn_cancelar.unbind('click');
			btn_cancelar.click(function(){
				form_contratos.addClass('hidden');
			});
		</script>
		<table class="table table-hover">
			
			<thead>
				<tr>
					<th>#</th>
					<th>Cliente</th>
					<th>Serviço:</th>
					<th>Data Contratacao</th>
					<th>Data Fim</th>
					<th>Valor</th>
				</tr>
			</thead>
			
			<?php 
			foreach($contrato->listar_todos() as $key => $value): 
			?>

			<tbody>
				<tr>
					<td><?php echo $value->id_contrato; ?></td>
					<td><?php echo $value->nome_cliente; ?></td>
					<td><?php echo $value->nome_servico; ?></td>
					<td><?php echo $value->data_contratacao; ?></td>
					<td><?php echo $value->data_fim; ?></td>
					<td><?php echo $value->valor; ?></td>
					<td>
						<?php echo "<a class='btn_editar' href='contratos.php?acao=editar&id=" . $value->id_contrato . "'>Editar</a>"; ?>
						<?php echo "<a href='contratos.php?acao=deletar&id=" . $value->id_contrato . "' onclick='return confirm(\"Deseja realmente deletar?\")'>Deletar</a>"; ?>
					</td>
				</tr>
			</tbody>

			<?php endforeach; ?>

		</table>
	</body>
</html>
