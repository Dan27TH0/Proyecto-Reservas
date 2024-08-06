<?php
class clasesModel{
    private $connection;

    public function __construct()
    {
        require_once("app/config/DBConnection.php");
        $this -> connection = new DBConnection();
    }

    public function getClases()
    {
        $consulta = "SELECT idClase, Nombre, Descripcion, Hora_Inicio, Hora_Fin, Organizador, Tipo_Deporte FROM Lista_Clases";
        $conexion = $this -> connection -> getConnection();
        $resultado = $conexion -> query($consulta);
        $clases = array();
        while($clase = $resultado -> fetch_assoc())
        {
            $clases[] = $clase;
        }
        $this -> connection -> closeConnection();
        return $clases;
    }

    public function getDeporte()
    {
        $consulta = "SELECT idDeporte AS id, Descripcion AS tipo FROM deporte";
        $conexion = $this->connection->getConnection();
        $resultado = $conexion->query($consulta);
        $deporte = [];

        while ($deport = $resultado->fetch_assoc()) {
            $deporte[] = $deport;
        }

        // $this->connection->closeConnection();
        return $deporte;
    }

    public function getById($id)
    {
        $consulta="SELECT * FROM lista_clases WHERE idClase = $id";
        //paso 2
        $conexion = $this->connection->getConnection();
        //paso 3 
        $resultado = $conexion->query($consulta);
        //paso 4
        if($resultado && $resultado->num_rows > 0){
            $clase= $resultado->fetch_assoc();
        }else{
            $clase=false;
        }
        //paso 5
        // $this->connection->closeConnection();
        //paso 6
        return $clase;
    }
    
    public function createClass($data)
    {
        if(!isset($data['Nombre'],$data['Descripcion'],$data['Hora_Inicio'],$data['Hora_Fin'],$data['id'],$data['idDeporte']))
        {
            return false;
        }
        $nombre=$data['Nombre'];
        $descripcion=$data['Descripcion'];
        $hora_inicio=$data['Hora_Inicio'];
        $hora_fin=$data['Hora_Fin'];
        $id=$data['id'];
        $iddeporte=$data['idDeporte'];

        if ($_SESSION['role'] == 1)
        {
            $consulta = "CALL CrearClase (1, '$nombre', '$descripcion', '$hora_inicio', '$hora_fin', $id, 'NULL', 'NULL', $iddeporte)";
            $conexion = $this -> connection -> getConnection();
            $resultado = $conexion -> query($consulta);
            $respuesta = $resultado ? true:false;
            $this->connection->closeConnection();
            return $respuesta;
            
        }
        elseif ($_SESSION['role'] == 2)
        {
            $consulta = "CALL CrearClase (2, '$nombre', '$descripcion', '$hora_inicio', '$hora_fin', 'NULL', $id, 'NULL', $iddeporte)";
            $conexion = $this -> connection -> getConnection();
            $resultado = $conexion -> query($consulta);
            $respuesta = $resultado ? true:false;
            $this->connection->closeConnection();
            return $respuesta;
        }
        else
        {
            $consulta = "CALL CrearClase (3, '$nombre', '$descripcion', '$hora_inicio', '$hora_fin', 'NULL', 'NULL', $id, $iddeporte)";$conexion = $this -> connection -> getConnection();
            $resultado = $conexion -> query($consulta);
            $respuesta = $resultado ? true:false;
            $this->connection->closeConnection();
            return $respuesta;
        }
    }

    public function editClass($datoClase)
    {
        if(!isset($datoClase['idClase'], $datoClase['Nombre'], $datoClase['Descripcion'], $datoClase['Hora_Inicio'], $datoClase['Hora_Fin'],$datoClase['id'], $datoClase['idDeporte'])){
            return false;
        }

        $idclase = $datoClase['idClase'];
        $nombre = $datoClase['Nombre'];
        $descripcion = $datoClase['Descripcion'];  // Corrección del campo aquí
        $hora_inicio = $datoClase['Hora_Inicio'];
        $hora_fin = $datoClase['Hora_Fin'];
        $iddeporte = $datoClase['idDeporte'];
        $idorg = $datoClase['id'];

        $consulta = "UPDATE lista_clases SET Nombre = '$nombre', Descripcion = '$descripcion', Hora_Inicio = '$hora_inicio', Hora_Fin = '$hora_fin', Organizador = '$idorg', Tipo_Deporte = '$iddeporte' WHERE idClase = '$idclase'";
        $conexion = $this->connection->getConnection();
        $resultado = $conexion->query($consulta);
        $respuesta = $resultado ? true : false;
        $this->connection->closeConnection();
        return $respuesta;
    }


    public function delete($id)
    {
        $consulta = "DELETE FROM clase WHERE idClase = $id";
        $conexion = $this->connection->getConnection();
        $resultado = $conexion->query($consulta);
        $respuesta = $resultado ? true : false;
        $this->connection->closeConnection();
        return $respuesta;
    }

    public function inscription($id, $idCliente)
    {
        $consulta = "CALL inscripcion (1, '$id', '$idCliente')";
        $conexion = $this->connection->getConnection();
        $resultado = $conexion->query($consulta);
        $respuesta = $resultado ? true : false;
        $this->connection->closeConnection();
        return $respuesta;
    }
}
?>