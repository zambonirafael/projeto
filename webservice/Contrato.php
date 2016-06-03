<?php

require_once 'Crud.php';

class Contrato extends Crud{

	protected $table = 'servico_cliente';

	private $id_cliente;
	private $id_servico;
	private $data_contratacao;
	private $data_inicio;
	private $data_fim;
	private $valor;

	public function setIdCliente($id_cliente){

		$this->id_cliente = $id_cliente;
	}
	public function setIdServico($id_servico){

		$this->id_servico = $id_servico;
	}
	public function setDataContratacao($data_contratacao){

		$this->data_contratacao = $data_contratacao;
	}
	public function setDataInicio($data_inicio){

		$this->data_inicio = $data_inicio;
	}
	public function setDataFim($data_fim){

		$this->data_fim = $data_fim;
	}
	public function setValor($valor){

		$this->valor = $valor;
	}

	public function getIdCliente($id_cliente){

		return $this->id_cliente;
	}
	public function getIdServico($id_servico){

		return $this->id_servico;
	}
	public function getDataContratacao($data_contratacao){

		return $this->data_contratacao;
	}
	public function getDataInicio($data_inicio){

		return $this->data_inicio;
	}
	public function getDataFim($data_fim){

		return $this->data_fim;
	}
	public function getValor($valor){

		return $this->valor;
	}
	

	public function insert(){

		$sql = "

			INSERT INTO $this->table (id_cliente, id_servico, data_contratacao, data_inicio, data_fim, valor) VALUES (:id_cliente, :id_servico, :data_contratacao, :data_inicio, :data_fim, :valor)

		";

		$id =  $this->id_servico;

		$duracao = "SELECT duracao FROM servico WHERE id =".$id;

		$stmt = DB::prepare($duracao);
		$data = $stmt->execute();

		$data_fim = date('Y-m-d', strtotime(+$data." days", strtotime($this->data_inicio)));

		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id_cliente', $this->id_cliente);
		$stmt->bindParam(':id_servico', $this->id_servico);
		$stmt->bindParam(':data_contratacao', $this->data_contratacao);
		$stmt->bindParam(':data_inicio', $this->data_inicio);
		$stmt->bindParam(':data_fim', $data_fim);
		$stmt->bindParam(':valor', $this->valor);

		return $stmt->execute();
	}

	public function update($id){

		$sql = "

			UPDATE $this->table SET id_cliente = :id_cliente, id_servico = :id_servico, data_contratacao = :data_contratacao, data_inicio = :data_inicio, data_fim = :data_fim, valor = :valor WHERE id = :id
		";

		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id_cliente', $this->id_cliente);
		$stmt->bindParam(':id_servico', $this->id_servico);
		$stmt->bindParam(':data_contratacao', $this->data_contratacao);
		$stmt->bindParam(':data_inicio', $this->data_inicio);
		$stmt->bindParam(':data_fim', $this->data_fim);
		$stmt->bindParam(':valor', $this->valor);
		$stmt->bindParam(':id', $id);

		return $stmt->execute();
		
	}

	public function listar_todos(){

		$sql = "

			SELECT 
				servico_cliente.id AS id_contrato,
		    	servico_cliente.id_cliente,
		    	servico_cliente.id_servico,
		    	servico.nome AS nome_servico,
		    	cliente.nome AS nome_cliente,
		    	servico_cliente.data_contratacao,
		    	servico_cliente.data_inicio,
		    	servico_cliente.data_fim,
		    	servico_cliente.valor,
		    	servico_cliente.excluido
			FROM servico_cliente
			INNER JOIN cliente ON (cliente.id = servico_cliente.id_cliente)
			INNER JOIN servico ON (servico.id = servico_cliente.id_servico)
			WHERE servico_cliente.excluido = 'N' ORDER BY servico_cliente.id;

		";
		
		$stmt = DB::prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll();
	}
}