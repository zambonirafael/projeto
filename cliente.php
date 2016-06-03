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
			$cliente = new Cliente();

			if(isset($_POST['enviar'])){

				$nome = $_POST['nome_cliente'];
				$cnpj = $_POST['cnpj_cliente'];
				$endereco = $_POST['endereco_cliente'];

				$cliente->setNome($nome);
				$cliente->setEndereco($endereco);
				$cliente->setCnpj($cnpj);

				$cliente->insert();
			}
		?>
 		<div class="btn-group" style="margin-left:10px;">
		  	<ul class="nav nav-pills">
			  <li role="presentation"><a href="home.php">Home</a></li>
			  <li role="presentation" class="active"><a href="cliente.php">Clientes</a></li>
			  <li role="presentation"><a href="servicos.php">Servicos</a></li>
			  <li role="presentation"><a href="contratos.php">Contratos</a></li>
			  <li role="presentation"><a href="json.php">Json</a></li>
			  <li role="presentation"><a href="sair.php">Sair</a></li>
			</ul>
		</div>
		<div>
			<button class='novo_cliente btn btn-info' style="margin-top: 15px; margin-left:10px;">Novo</button>
			<?php 
				if(isset($_POST['atualizar'])){

					$id = $_POST['id'];
					$nome = $_POST['nome_cliente'];
					$cnpj = $_POST['cnpj_cliente'];
					$endereco = $_POST['endereco_cliente'];

					$cliente->setNome($nome);
					$cliente->setEndereco($endereco);
					$cliente->setCnpj($cnpj);

					$cliente->update($id);
				}
			?>

			<?php 
				if(isset($_GET['acao'])){
					if($_GET['acao'] == 'deletar'){
						$id = (int)$_GET['id'];
						$cliente->delete($id);
					}
				}
			?>

			<?php 
			if(isset($_GET['acao'])){
			if($_GET['acao'] == 'editar'){

				$id = (int)$_GET['id'];
				$resultado = $cliente->find($id);
		?>

		<form action="" method="post" class="form_cliente_atualizar" style="margin-left: 10px; margin-left:10px;">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					    <label for="exampleInputEmail1">Nome Cliente</label>
					    <input type="text" name="nome_cliente" value="<?php echo $resultado->nome; ?>" class="form-control edt_usuario" placeholder="Nome Cliente">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					    <label for="exampleInputPassword1">CNPJ</label>
					    <input type="text" name="cnpj_cliente" value="<?php echo $resultado->cnpj; ?>" class="form-control edt_senha" placeholder="CNPJ">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					    <label for="exampleInputPassword1">Endereço</label>
					    <input type="text" name="endereco_cliente" value="<?php echo $resultado->endereco; ?>" class="form-control edt_senha" placeholder="Endereço">
					</div>
				</div>
				<div class="col-md-6 btn-group">
					<input type="hidden" name="id" value="<?php echo $resultado->id; ?>">
					<button type="submit" name="atualizar" class="btn btn-default btn_enviar_atualizar btn-success">Enviar</button>
					<button type="submit" name="cancelar" class="btn btn-default btn_cancelar_editar btn-danger">Cancelar</button>
				</div>
			</div>
		</form>
		<?php 
			}
			} ?>
			<form action="" method="post" class=" form_cliente hidden" style="margin-left: 10px; margin-left:10px;">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
						    <label for="exampleInputEmail1">Nome Cliente</label>
						    <input type="text" name="nome_cliente" class="form-control edt_usuario" placeholder="Nome Cliente">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						    <label for="exampleInputPassword1">CNPJ</label>
						    <input type="text" name="cnpj_cliente" class="form-control edt_senha" placeholder="CNPJ">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
						    <label for="exampleInputPassword1">Endereço</label>
						    <input type="text" name="endereco_cliente" class="form-control edt_senha" placeholder="Endereço">
						</div>
					</div>
					<div class="col-md-6 btn-group">
						<button type="submit" name="enviar" class="btn btn-default btn_enviar btn-success">Enviar</button>
						<button type="submit" name="cancelar" class="btn btn-default btn_cancelar btn-danger">Cancelar</button>
					</div>
				</div>
			</form>
		</div>
		<script type="text/javascript">
			var btn_novo = $('.novo_cliente');
			var btn_cancelar = $('.btn_cancelar');
			var form_cliente = $('.form_cliente');

			btn_novo.unbind('click');
			btn_novo.click(function(){
				if(form_cliente.hasClass('hidden')){
					form_cliente.removeClass('hidden');
				}
			});

			btn_cancelar.unbind('click');
			btn_cancelar.click(function(){
				form_cliente.addClass('hidden');
			});
		</script>
		<table class="table table-hover">
			
			<thead>
				<tr>
					<th>#</th>
					<th>Nome:</th>
					<th>Cnpj:</th>
					<th>Ações:</th>
				</tr>
			</thead>
			
			<?php foreach($cliente->findAll() as $key => $value): ?>

			<tbody>
				<tr>
					<td><?php echo $value->id; ?></td>
					<td><?php echo $value->nome; ?></td>
					<td><?php echo $value->cnpj; ?></td>
					<td>
						<?php echo "<a class='btn_editar' href='cliente.php?acao=editar&id=" . $value->id . "'>Editar</a>"; ?>
						<?php echo "<a href='cliente.php?acao=deletar&id=" . $value->id . "' onclick='return confirm(\"Deseja realmente deletar?\")'>Deletar</a>"; ?>
					</td>
				</tr>
			</tbody>

			<?php endforeach; ?>

		</table>
	</body>
</html>
