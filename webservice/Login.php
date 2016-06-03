<?php

require_once 'Db.php';

class Login extends Db{

	private $login;
	private $senha;

	protected $table = 'usuarios';

	public function setLogin($login){
		$this->login = $login;
	}
	public function setSenha($senha){
		$this->senha = $senha;
	}
	public function getLogin(){
		return $this->login;
	}
	public function getSenha(){
		return $this->senha;
	}

	public function logar(){

		$sql = "SELECT id, nome, senha FROM usuarios WHERE nome= :nome && senha= :senha" ;

		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->login);
		$stmt->bindParam(':senha', $this->senha);
		$stmt->execute();

		//return $stmt->fetch();

		if($stmt->rowCount() == 1){
			$dados = $stmt->fetch(PDO::FETCH_OBJ);
			session_cache_expire(525600);
			$_SESSION['usuario'] = $dados->nome;
			$_SESSION['logado'] = true;
			$_SESSION['id'] = $dados->id;
			return true;
		}
		else{
			return false;
		}
	}
}