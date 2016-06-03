<?php

require_once 'Db.php';

abstract class Crud extends DB{

	protected $table;

	abstract public function insert();

	abstract public function update($id);

	public function find($id){

		$sql = "SELECT * FROM $this->table WHERE id = :id AND excluido = 'N'";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetch();
	}

	public function findAll(){

		$sql = "SELECT * FROM $this->table WHERE excluido = 'N'";
		$stmt = DB::prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll();

	}

	public function delete($id){

		$sql = "UPDATE $this->table SET excluido = 'S'  WHERE id = :id";

		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->execute();;
	}
}