<?php
  error_reporting(0);
  require("conexion.php");

  class cargarBD{

      public $conn;
   
        public function __construct()
      {
          $database = new Conexion();
          $db = $database->conexionBD();
          $this->conn = $db;
      }

    function crearXMLSitios(){

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
      $sql1 = "SELECT codigo, descripcion, detalle, ubicacion, TO_BASE64(imagen) as imagen, latitud, longitud, tipo FROM hotel";
      $sql2 = "SELECT codigo, descripcion, detalle, ubicacion, TO_BASE64(imagen) as imagen, latitud, longitud, tipo FROM restaurante";
      $sql3 = "SELECT codigo, descripcion, detalle, ubicacion, TO_BASE64(imagen) as imagen, latitud, longitud, tipo FROM bar";
      $sql4 = "SELECT codigo, descripcion, detalle, ubicacion, TO_BASE64(imagen) as imagen, latitud, longitud, tipo FROM lugar";
      $sql5 = "SELECT codigo, descripcion, detalle, ubicacion, TO_BASE64(imagen) as imagen, latitud, longitud, tipo FROM transporte";

      // mostrar el contenido php en xml
      header("Content-type: text/xml; Content-language: es");

      // inicio de etiqueta markers
      echo '<markers>';

      // While para devolver los campos de la consulta
      foreach ($this->conn->query($sql1) as $row)
      {
        // inicio de etiqueta marker para devolver cada campo de la consulta
        echo '<marker ';
        echo 'codigo="'.parseToXML($row['codigo']).'" ';
        echo 'descripcion="'.parseToXML($row['descripcion']).'" ';
        echo 'detalle="'.parseToXML($row['detalle']).'" ';
        echo 'ubicacion="'.parseToXML($row['ubicacion']).'" ';
        echo 'imagen="'.$row['imagen'].'" ';
        echo 'lat="'.$row['latitud'].'" ';
        echo 'lng="'.$row['longitud'].'" ';
        echo 'tipo="'.$row['tipo'].'" ';
        echo '/>';
      }

      // While para devolver los campos de la consulta
      foreach ($this->conn->query($sql2) as $row)
      {
        // inicio de etiqueta marker para devolver cada campo de la consulta
        echo '<marker ';
        echo 'codigo="'.parseToXML($row['codigo']).'" ';
        echo 'descripcion="'.parseToXML($row['descripcion']).'" ';
        echo 'detalle="'.parseToXML($row['detalle']).'" ';
        echo 'ubicacion="'.parseToXML($row['ubicacion']).'" ';
        echo 'imagen="'.$row['imagen'].'" ';
        echo 'lat="'.$row['latitud'].'" ';
        echo 'lng="'.$row['longitud'].'" ';
        echo 'tipo="'.$row['tipo'].'" ';
        echo '/>';
      }

      // While para devolver los campos de la consulta
      foreach ($this->conn->query($sql3) as $row)
      {
        // inicio de etiqueta marker para devolver cada campo de la consulta
        echo '<marker ';
        echo 'codigo="'.parseToXML($row['codigo']).'" ';
        echo 'descripcion="'.parseToXML($row['descripcion']).'" ';
        echo 'detalle="'.parseToXML($row['detalle']).'" ';
        echo 'ubicacion="'.parseToXML($row['ubicacion']).'" ';
        echo 'imagen="'.$row['imagen'].'" ';
        echo 'lat="'.$row['latitud'].'" ';
        echo 'lng="'.$row['longitud'].'" ';
        echo 'tipo="'.$row['tipo'].'" ';
        echo '/>';
      }

      // While para devolver los campos de la consulta
      foreach ($this->conn->query($sql4) as $row)
      {
        // inicio de etiqueta marker para devolver cada campo de la consulta
        echo '<marker ';
        echo 'codigo="'.parseToXML($row['codigo']).'" ';
        echo 'descripcion="'.parseToXML($row['descripcion']).'" ';
        echo 'detalle="'.parseToXML($row['detalle']).'" ';
        echo 'ubicacion="'.parseToXML($row['ubicacion']).'" ';
        echo 'imagen="'.$row['imagen'].'" ';
        echo 'lat="'.$row['latitud'].'" ';
        echo 'lng="'.$row['longitud'].'" ';
        echo 'tipo="'.$row['tipo'].'" ';
        echo '/>';
      }

      // While para devolver los campos de la consulta
      foreach ($this->conn->query($sql5) as $row)
      {
        // inicio de etiqueta marker para devolver cada campo de la consulta
        echo '<marker ';
        echo 'codigo="'.parseToXML($row['codigo']).'" ';
        echo 'descripcion="'.parseToXML($row['descripcion']).'" ';
        echo 'detalle="'.parseToXML($row['detalle']).'" ';
        echo 'ubicacion="'.parseToXML($row['ubicacion']).'" ';
        echo 'imagen="'.$row['imagen'].'" ';
        echo 'lat="'.$row['latitud'].'" ';
        echo 'lng="'.$row['longitud'].'" ';
        echo 'tipo="'.$row['tipo'].'" ';
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
  $nuevaCN->crearXMLSitios();

?>