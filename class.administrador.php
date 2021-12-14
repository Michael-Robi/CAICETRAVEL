 <?php
require_once('conexion.php'); //abre solo 1 vez si esta abierto el php

class Administrador
{
	private $conn;

	public function __construct()
	{
		$basededatos = new Conexion();
		$bd = $basededatos->conexionBD();
		$this->conn = $bd;
	}

	public function runQuery($sql) //Metodos van con minuscula y mayuscula
	//Mi usuario que apunta a runQuery 
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}

	// public function registrar($nombre,$correo,$pass)
	// {
	// 	try {
	// 		$new_password = password_hash($pass, PASSWORD_DEFAULT); //password_hast() 2 parametro 1 lo que quiero encriptar 2 
	// 		$stmt = $this->conn->prepare("INSERT INTO usuarios(nombre,email,password) 
 //           	VALUES(:nombre, :correo, :pass, 0)");

	// 		$stmt->bindparam(":nombre", $nombre);//bindparam(?,$) para capturar valores en $
	// 		$stmt->bindparam(":correo", $correo);
	// 		$stmt->bindparam(":pass", $new_password);
	// 		$stmt->execute();
	// 		return $stmt;

	// 	} catch (PDOException $e) {
	// 		echo $e->getMessage();
	// 	}
	// }

	public function doLogin($nombre,$pass)
	{
		try {
			$stmt = $this->conn->prepare("SELECT idUsuarios, nombre, password, estado FROM usuarios WHERE nombre=:nombre AND estado=1");
			$stmt->execute(array(':nombre'=>$nombre));//en el array => asignele lo que traigan las variables $nombre,$correo,$pass
				$userRow=$stmt->fetch(PDO::FETCH_ASSOC); //muestra la forma como se pasaran los datos
				if ($stmt->rowCount() == 1 AND $userRow['estado'] == 1) 
				{
					if(password_verify($pass, $userRow['password'])) 
					{
						$_SESSION['user_session'] = $userRow['idUsuarios'];
						return true;
					}
					else
					{
						return false;
					}
				}

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function is_loggedin()
	{
		if(isset($_SESSION['user_session'])) //isset si tiene informacion
		{ 
			return true;
		}

		// else
		// {
		// 	return false;
		// }
	}

	public function redireccionar($url)
	{
		header("Location: $url");
		// header("location:".$url);
	}

	public function cerrarSesion()
	{
		unset($_SESSION['user_session']); //eliminar variable
		session_destroy($_SESSION['user_session']); //destruir seccion
		return true;
	}
}

	
?>