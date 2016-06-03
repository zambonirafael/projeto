<?php session_start(); ?>
<?php 
	
	require_once "webservice/Login.php";

	if(isset($_POST['enviar'])){

		$login = $_POST['nome'];
		$senha = $_POST['senha'];

		$l = new login();
		$l->setLogin($login);
		$l->setSenha($senha);

		if($l->logar()){
			header("Location: home.php");
		}
		else{
			echo 'usuário ou senha errado';
		}
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
		<div class="row" style="padding-top: 100px; margin-left: 35%;">
			<div class="col-md-4">
				<form action="" method="post">
					<div class="form-group">
					    <label for="exampleInputEmail1">Nome Usuário</label>
					    <input type="text" name="nome" class="form-control edt_usuario" placeholder="Nome Usuário">
					</div>
					<div class="form-group">
					    <label for="exampleInputPassword1">Senha</label>
					    <input type="password" name="senha" class="form-control edt_senha" placeholder="Senha">
					</div>
					<button type="submit" name="enviar" class="btn btn-default btn_enviar">Enviar</button>
				</form>
			</div>
		</div>
		

	</body>
</html>	
</html>