<?php
class areasModel{
    private $connection;

    public function __construct()
    {
        require_once("app/config/DBConnection.php");
        $this -> connection = new DBConnection();
    }

    public function getAreas()
    {
        $consulta = "SELECT idArea, NombreArea, TipoArea, Descripcion, Imagen_Area, Ubicacion FROM lista_areas
        INNER JOIN ubicaciones_areas
        ON lista_areas.idcalle = ubicaciones_areas.idcalle";
        $conexion = $this -> connection -> getConnection();
        $resultado = $conexion -> query($consulta);
        $areas = array();
        while($area = $resultado -> fetch_assoc())
        {
            $areas[] = $area;
        }
        $this -> connection -> closeConnection();
        return $areas;
    }
    
    public function getTipoAreas() {
        $consulta = "SELECT idTipo AS id, Descripcion AS nombre FROM tipo_area";
        $conexion = $this->connection->getConnection();
        $resultado = $conexion->query($consulta);
        $areas = [];

        while ($area = $resultado->fetch_assoc()) {
            $areas[] = $area;
        }

        // $this->connection->closeConnection();
        return $areas;
    }

    public function getUbicaciones() {
        $consulta = "SELECT idcalle AS id, ubicacion AS nombre FROM ubicaciones_areas";
        $conexion = $this->connection->getConnection();
        $resultado = $conexion->query($consulta);
        $ubicaciones = [];

        while ($ubicacion = $resultado->fetch_assoc()) {
            $ubicaciones[] = $ubicacion;
        }

        // $this->connection->closeConnection();
        return $ubicaciones;
    }

    public function getById($id){
        //paso 1
        $consulta="SELECT idArea, NombreArea, TipoArea, Descripcion, Imagen_Area, Ubicacion FROM lista_areas 
        INNER JOIN ubicaciones_areas 
        ON lista_areas.idcalle = ubicaciones_areas.idcalle 
        WHERE idArea = $id";
        //paso 2
        $conexion = $this->connection->getConnection();
        //paso 3 
        $resultado = $conexion->query($consulta);
        //paso 4
        if($resultado && $resultado->num_rows > 0){
            $area= $resultado->fetch_assoc();
        }else{
            $area=false;
        }
        //paso 5
        // $this->connection->closeConnection();
        //paso 6
        return $area;
    }

    public function publishArea($dato)
    {
        if(!isset($dato['Nombre'], $dato['Area'], $dato['Descripcion'], $dato['Ubicacion'], $dato['Imagen']))
        {
            return false;
        }
        $nombre = $dato['Nombre'];
        $area = $dato['Area'];
        $descripcion = $dato['Descripcion'];
        $ubicacion = $dato['Ubicacion'];
        $imagen = $dato['Imagen'];
        
        $consulta = "CALL publicarArea('$nombre', '$area', '$descripcion', '$ubicacion', '$imagen')";
        $conexion = $this -> connection -> getConnection();
        $resultado = $conexion -> query($consulta);
        $respuesta = $resultado ? true:false;
        $this -> connection -> closeConnection();
        return $respuesta;
    }

    public function editArea($datoArea)
    {
        if(!isset($datoArea['idArea'], $datoArea['NombreArea'], $datoArea['TipoArea'], $datoArea['Descripcion'], $datoArea['Ubicacion'])){
            return false;
        }

        $id = $datoArea['idArea'];
        $nombrearea = $datoArea['NombreArea'];
        $tipoarea = $datoArea['TipoArea'];
        $descripcion = $datoArea['Descripcion'];
        $ubicacion = $datoArea['Ubicacion'];

        $consulta = "UPDATE lista_areas SET NombreArea='$nombrearea', TipoArea='$tipoarea', Descripcion='$descripcion', Ubicacion='$ubicacion' WHERE idArea=$id";
        $conexion = $this->connection->getConnection();
        $resultado = $conexion->query($consulta);
        $respuesta = $resultado ? true : false;
        $this->connection->closeConnection();
        return $respuesta;
    }

    public function delete($id){
        $consulta="DELETE FROM area_deportiva WHERE idArea= $id";
        $conexion=$this->connection->getConnection();
        $resultado= $conexion->query($consulta);
        $respuesta= $resultado ? true:false;
        $this->connection->closeConnection();
        return $respuesta;
    }
}
?>