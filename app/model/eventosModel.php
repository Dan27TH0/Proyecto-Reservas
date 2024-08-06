<?php
class eventosModel{
    private $connection;

    public function __construct()
    {
        require_once("app/config/DBConnection.php");
        $this -> connection = new DBConnection();
    }

    public function getEventos()
    {
        $consulta = "SELECT idEvento, Nombre, Descripcion, Hora_Inicio, Hora_Fin, Organizador, Tipo_Deporte, Fecha FROM Lista_eventos";
        $conexion = $this -> connection -> getConnection();
        $resultado = $conexion -> query($consulta);
        $eventos = array();
        while($evento = $resultado -> fetch_assoc())
        {
            $eventos[] = $evento;
        }
        $this -> connection -> closeConnection();
        return $eventos;
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
        $consulta="SELECT * FROM lista_eventos WHERE idEvento = $id";
        //paso 2
        $conexion = $this->connection->getConnection();
        //paso 3 
        $resultado = $conexion->query($consulta);
        //paso 4
        if($resultado && $resultado->num_rows > 0){
            $evento= $resultado->fetch_assoc();
        }else{
            $evento=false;
        }
        //paso 5
        // $this->connection->closeConnection();
        //paso 6
        return $evento;
    }

    public function createEvent($dato)
    {
        if(!isset($dato['Nombre'], $dato['Descripcion'], $dato['Hora_Inicio'], $dato['Hora_Fin'], $dato['Fecha'], $dato['id'], $dato['idDeporte'], $dato['CantidadParticipantes']))
        {
            return false;
        }
        $nombre = $dato['Nombre'];
        $descripcion = $dato['Descripcion'];
        $hora_inicio = $dato['Hora_Inicio'];
        $hora_fin = $dato['Hora_Fin'];
        $fecha = $dato['Fecha'];
        $id = $dato['id'];
        $iddeporte = $dato['idDeporte'];
        $cantidad = $dato['CantidadParticipantes'];
        
        if ($_SESSION['role'] == 1) 
        {
            $consulta = "CALL CrearEvento(1, '$nombre', '$descripcion', '$hora_inicio', '$hora_fin', $id,'NULL', 'NULL', $iddeporte, '$fecha', $cantidad)";
            $conexion = $this -> connection -> getConnection();
            $resultado = $conexion -> query($consulta);
            $respuesta = $resultado ? true:false;
            $this -> connection -> closeConnection();
            return $respuesta;
        }
        elseif ($_SESSION['role'] == 2) 
        {
            $consulta = "CALL CrearEvento(2, '$nombre', '$descripcion', '$hora_inicio', '$hora_fin','NULL', $id, 'NULL', $iddeporte, '$fecha', $cantidad)";
            $conexion = $this -> connection -> getConnection();
            $resultado = $conexion -> query($consulta);
            $respuesta = $resultado ? true:false;
            $this -> connection -> closeConnection();
            return $respuesta;
        }
        else
        {
            $consulta = "CALL CrearEvento(3, '$nombre', '$descripcion', '$hora_inicio', '$hora_fin','NULL', 'NULL', $id, $iddeporte, '$fecha', $cantidad)";
            $conexion = $this -> connection -> getConnection();
            $resultado = $conexion -> query($consulta);
            $respuesta = $resultado ? true:false;
            $this -> connection -> closeConnection();
            return $respuesta;
        }
    }

    public function editEvent($datoEvento)
    {
        if(!isset($datoEvento['idEvento'], $datoEvento['Nombre'], $datoEvento['Descripcion'], $datoEvento['Hora_Inicio'], $datoEvento['Hora_Fin'], $datoEvento['Fecha'], $datoEvento['id'], $datoEvento['idDeporte'])){
            return false;
        }

        $idevento = $datoEvento['idEvento'];
        $nombre = $datoEvento['Nombre'];
        $descripcion = $datoEvento['Descripcion'];  // Corrección del campo aquí
        $hora_inicio = $datoEvento['Hora_Inicio'];
        $hora_fin = $datoEvento['Hora_Fin'];
        $fecha = $datoEvento['Fecha'];
        $iddeporte = $datoEvento['idDeporte'];
        $idorg = $datoEvento['id'];

        $consulta = "UPDATE lista_eventos SET Nombre = '$nombre', Descripcion = '$descripcion', Hora_Inicio = '$hora_inicio', Hora_Fin = '$hora_fin', Organizador = '$idorg', Tipo_Deporte = '$iddeporte', Fecha = '$fecha' WHERE idEvento = '$idevento'";
        $conexion = $this->connection->getConnection();
        $resultado = $conexion->query($consulta);
        $respuesta = $resultado ? true : false;
        $this->connection->closeConnection();
        return $respuesta;
    }


    public function delete($id)
    {
        $consulta = "DELETE FROM eventos WHERE idEvento = $id";
        $conexion = $this->connection->getConnection();
        $resultado = $conexion->query($consulta);
        $respuesta = $resultado ? true : false;
        $this->connection->closeConnection();
        return $respuesta;
    }
}
?>