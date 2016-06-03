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
		<div class="btn-group">
		  	<ul class="nav nav-pills">
			  <li role="presentation"><a href="home.php">Home</a></li>
			  <li role="presentation"><a href="cliente.php">Clientes</a></li>
			  <li role="presentation"><a href="servicos.php">Servicos</a></li>
			  <li role="presentation"><a href="contratos.php">Contratos</a></li>
			  <li role="presentation" class="active"><a href="json.php">Json</a></li>
			  <li role="presentation"><a href="sair.php">Sair</a></li>
			</ul>
			<div class='row' style="padding: 50px;">
				<div class="col-md-12">
					<?php 
				$servico = new Servico();

				$json = array();
				$json['servicos'] = json_decode($servico->json());
				echo $json['servicos'];
			?>		
				</div>
				
			</div>
			
		
	</body>
</html>
