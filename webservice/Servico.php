<?php

require_once 'Crud.php';

class Servico extends Crud{

	protected $table = 'servico';

	private $nome;
	private $desc;
	private $duracao;

	public function setNome($nome){

		$this->nome = $nome;
	}
	public function setDesc($desc){

		$this->desc = $desc;
	}
	public function setDuracao($duracao){

		$this->duracao = $duracao;
	}
	public function getNome(){
		return $this->nome;
	}
	public function getDes(){
		return $this->desc;
	}
	public function getDuracao(){
		return $this->duracao;
	}

	public function insert(){

		$sql = "

			INSERT INTO $this->table (nome, descricao, duracao) VALUES (:nome, :descricao, :duracao)

		";

		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':descricao', $this->desc);
		$stmt->bindParam(':duracao', $this->duracao);

		return $stmt->execute();
	}

	public function update($id){

		$sql = "

			UPDATE $this->table SET nome = :nome, descricao = :descricao, duracao = :duracao WHERE id = :id
		";

		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':descricao', $this->desc);
		$stmt->bindParam(':duracao', $this->duracao);
		$stmt->bindParam(':id', $id);

		return $stmt->execute();
	}

	public function json(){
		$teste = array();
		$teste = json_encode($this->findAll());
		print_r($teste);
		
	}
}