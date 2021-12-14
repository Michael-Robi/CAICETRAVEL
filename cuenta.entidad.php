<?php 
class cuenta
{
	private $idUsuarios;
	private $nombre;
	private $email;
	private $password;
	private $joining_date;


	//MÉTODOS MÁGICOS EN PHP
	//SELECT idUsuarios, nombre, email, password, joining_date FROM usuarios

	public function __GET($valor)
	{
		return $this->$valor;
	}

	public function __SET($vari,$nue)
	{
		$this->$vari=$nue;
	}
}
?>
