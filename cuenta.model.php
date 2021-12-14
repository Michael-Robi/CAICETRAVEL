<?php
require_once('conexion.php');
class cuentaModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try 
		{
			$basededatos = new Conexion();
			$bd = $basededatos->conexionBD();
			$this->pdo = $bd;
		} 
		catch (Exception $e) 
		{
			die($e->getMessage()); //para mostrar el error en una exception es con die
			//SELECT idUsuarios, nombre, email, password, joining_date FROM usuarios
		}
	}

	public function Listar()
	{
		try {
			$result=array();
			$stm=$this->pdo->prepare("SELECT * from usuarios WHERE estado=1 ORDER BY (nombre)"); // stm preparar consulta
			$stm->execute();

			foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) //$r trae todos los registros
			{
				$usu= new cuenta(); //objeto usu
				$usu->__SET('idUsuarios',$r->idUsuarios); //Asigne lo que tenga $r en idUsuarios
				$usu->__SET('nombre',$r->nombre);
				$usu->__SET('email',$r->email);
				$usu->__SET('password',$r->password);
				$usu->__SET('joining_date',$r->joining_date);
				$result[]=$usu;
			}
			return $result;
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function listarUsuarios($idUsu)
	{
		try {
			$result=array();
			$stm=$this->pdo->prepare("SELECT * from usuarios WHERE idUsuarios=?"); // stm preparar consulta
			$stm->execute(array($idUsu));

			foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) //$r trae todos los registros
			{
				$usu= new cuenta(); //objeto usu
				$usu->__SET('nombre',$r->nombre);//Asigne lo que tenga $r en idUsuarios
				$usu->__SET('email',$r->email);
				$usu->__SET('password',$r->password);
				$usu->__SET('joining_date',$r->joining_date);
				$usu->__SET('idUsuarios',$r->idUsuarios);
				$result[]=$usu;
			}
			return $result;
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Obtener($idUsuarios)
	{
		try {
			$stm=$this->pdo->prepare("SELECT * from usuarios where idUsuarios=?");
			$stm->execute(array($idUsuarios)); //trae el array de un registro password,joining_date,descripcion
			$r=$stm->fetch(PDO::FETCH_OBJ);
			$usu= new cuenta();
			$usu->__SET('idUsuarios',$r->idUsuarios);
			$usu->__SET('nombre',$r->nombre);
			$usu->__SET('email',$r->email);
			$usu->__SET('password',$r->password);
			$usu->__SET('joining_date',$r->joining_date);
			
			return $usu;
		}
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($idUsuarios)
	{
		try {
			$stm=$this->pdo->prepare("DELETE from usuarios where idUsuarios=?");
			$stm->execute(array($idUsuarios));
			// retornar es solo para consultas
		}
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(cuenta $data) // $data trae de la interface cualquier dato que vaya a modificar el usuario password,joining_date,descripcion
	//SELECT idUsuarios, nombre, email, password, joining_date FROM usuarios
	{

		try {
			$sql="UPDATE usuarios set nombre=?, email=?, password=?, joining_date=? where idUsuarios=?";
			$this->pdo->prepare($sql)->execute(
				array(
					$data->__GET('nombre'),
					$data->__GET('email'),
					$new_password = password_hash($data->__GET('password'), PASSWORD_DEFAULT),
					$data->__GET('joining_date'),
					$data->__GET('idUsuarios')
					)
			);
		}
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(cuenta $data)
	{
		try {
			$sql="INSERT into usuarios (nombre,email,estado,password) values (?,?,1,?)";
			$this->pdo->prepare($sql)->execute(
				array(
					$data->__GET('nombre'),
					$data->__GET('email'),
					$new_password = password_hash($data->__GET('password'), PASSWORD_DEFAULT)
					)
			);

		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}

?>
