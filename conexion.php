<?php 
class Conexion
{
	private $host = "localhost";
    private $basededatos = "caicetravel02";
    private $usuario = "root";
    private $password = "";
    public $conn;

	public function conexionBD()
	{
		$this->conn = null;
		try {
			$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->basededatos, $this->usuario, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); //pdo medio de peticion de datos

		} 
		catch (PDOException $exception) 
		{
			echo "error de conexion ".$exception->getMessage();
		}
		return $this->conn;
	}
}

?>