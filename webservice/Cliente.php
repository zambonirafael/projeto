<?php

require_once 'Crud.php';

class Cliente extends Crud{

	protected $table = 'cliente';

	private $nome;
	private $cnpj;
	private $endereco;

	public function setNome($nome){

		$this->nome = $nome;
	}
	public function setCnpj($cnpj){

		$this->cnpj = $cnpj;
	}
	public function setEndereco($endereco){

		$this->endereco = $endereco;
	}
	public function getNome(){
		return $this->nome;
	}
	public function getEndereco(){
		return $this->endereco;
	}
	public function getCnpj(){
		return $this->cnpj;
	}

	public function insert(){

		$sql = "

			INSERT INTO $this->table (nome, cnpj, endereco) VALUES (:nome, :cnpj, :endereco)

		";

		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':cnpj', $this->cnpj);
		$stmt->bindParam(':endereco', $this->endereco);

		return $stmt->execute();
	}

	public function update($id){

		$sql = "

			UPDATE $this->table SET nome = :nome, cnpj = :cnpj, endereco = :endereco WHERE id = :id
		";

		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':cnpj', $this->cnpj);
		$stmt->bindParam(':endereco', $this->endereco);
		$stmt->bindParam(':id', $id);

		return $stmt->execute();
		}
}