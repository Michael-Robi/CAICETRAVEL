<?php
  error_reporting(0);
  require_once('conexion.php');

  class cargarBD{
    
    public $conn;

    public function __construct()
    {
      $database = new Conexion();
      $db = $database->conexionBD();
      $this->conn = $db;
    }

    function crearXMLHotel(){

      function parseToXML($htmlStr)
      {
      $xmlStr=str_replace('<','&lt;',$htmlStr);
      $xmlStr=str_replace('>','&gt;',$xmlStr);
      $xmlStr=str_replace('"','&quot;',$xmlStr);
      $xmlStr=str_replace("'",'&#39;',$xmlStr);
      $xmlStr=str_replace("&",'&amp;',$xmlStr);
      return $xmlStr;
      }

      // Consultar los sitios en la base de datos
      $sql1 = "SELECT codigo, descripcion, detalle, ubicacion, TO_BASE64(imagen) as imagen, latitud, longitud, tipo FROM transporte";

      // mostrar el contenido php en xml
      header("Content-type: text/xml; Content-language: es");

      // inicio de etiqueta markers
      echo '<markers>';

      // While para devolver los campos de la consulta
      foreach ($this->conn->query($sql1) as $row)
      {
        // inicio de etiqueta marker para devolver cada campo de la consulta
        echo '<marker ';
        echo 'codigo_transporte="'.parseToXML($row['codigo']).'" ';
        echo 'descripcion_transporte="'.parseToXML($row['descripcion']).'" ';
        echo 'detalle_transporte="'.parseToXML($row['detalle']).'" ';
        echo 'ubicacion_transporte="'.parseToXML($row['ubicacion']).'" ';
        echo 'imagen_transporte="'.$row['imagen'].'" ';
        echo 'latitud_transporte="'.$row['latitud'].'" ';
        echo 'longitud_transporte="'.$row['longitud'].'" ';
        echo 'tipo_transporte="'.$row['tipo'].'" ';
        echo '/>';
      }

      // Fin de etiqueta markers
      echo '</markers>';

      // Cerrar Conexion
      $this->conn->closeCursor();
      $conn = null;
      $db = null;
    }
  }

  $nuevaCN = new cargarBD();
  $nuevaCN->crearXMLHotel();

?>