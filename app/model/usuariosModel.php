<?php
class usuariosModel
{
    private $connection;

    public function __construct()
    {
        require_once("app/config/DBConnection.php");
        $this -> connection = new DBConnection();
    }

    public function registerUsers($data)
    {
        if(!isset($data['Nombre'],$data['ApPaterno'],$data['ApMaterno'],$data['Email'],$data['Telefono'],$data['Contraseña'])){
            return false;
        }
        
        $nombre=$data['Nombre'];
        $appaterno=$data['ApPaterno'];
        $apmaterno=$data['ApMaterno'];
        $email=$data['Email'];
        $telefono=$data['Telefono'];
        $contraseña=$data['Contraseña'];

        $consulta = "INSERT INTO cliente (Nombre, ApPaterno, ApMaterno, Email, Telefono, Contraseña) VALUES ('$nombre', '$appaterno', '$apmaterno', '$email', $telefono, '$contraseña')";
        $conexion = $this -> connection -> getConnection();
        $resultado = $conexion -> query($consulta);
        $respuesta = $resultado ? true:false;
        $this->connection->closeConnection();
        return $respuesta;
    }

    public function getCredentials($tipo, $user, $password)
    {
        $consulta = "CALL iniciarSesion ($tipo,'$user','$password')";
        $conexion = $this -> connection -> getConnection();
        $resultado = $conexion -> query($consulta);
        $respuesta=$resultado->num_rows>=1?$resultado->fetch_assoc():false;
        $this -> connection -> closeConnection();
        return $respuesta;
    }

    public function classInscriptions()
    {
        if ($_SESSION['role'] == 1)
        {
            $consulta = "SELECT NombreClase, Entrenador FROM inscripciones WHERE idAdmin = ". $_SESSION['id'] ." AND NombreClase IS NOT NULL";
            $conexion = $this -> connection -> getConnection();
            $resultado = $conexion -> query($consulta);
            $respuesta = [];
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    $respuesta[] = $fila;
                }
            } else {
                $respuesta = false;
            }
            // $this -> connection -> closeConnection();
            return $respuesta;
        }
        else
        {
            $consulta = "SELECT NombreClase, Entrenador FROM inscripciones WHERE idCliente = ". $_SESSION['id'] ." AND NombreClase IS NOT NULL";
            $conexion = $this -> connection -> getConnection();
            $resultado = $conexion -> query($consulta);
            $respuesta = [];
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    $respuesta[] = $fila;
                }
            } else {
                $respuesta = false;
            }
            // $this -> connection -> closeConnection();
            return $respuesta;
        }
    }

    public function eventInscriptions()
    {
        if ($_SESSION['role'] == 1)
        {
            $consulta = "SELECT NombreEvento, Entrenador FROM inscripciones WHERE idAdmin = ". $_SESSION['id'] ." AND NombreEvento IS NOT NULL";
            $conexion = $this -> connection -> getConnection();
            $resultado = $conexion -> query($consulta);
            $respuesta = [];
            if ($resultado -> num_rows > 0)
            {
                while ($fila = $resultado -> fetch_assoc())
                {
                    $respuesta[] = $fila;
                }
            }
            else
            {
                $respuesta = false;
            }
            // $this -> connection -> closeConnection();
            return $respuesta;
        }
        else
        {
            $consulta = "SELECT NombreEvento, Entrenador FROM inscripciones WHERE idCliente = ". $_SESSION['id'] ." AND NombreEvento IS NOT NULL";
            $conexion = $this -> connection -> getConnection();
            $resultado = $conexion -> query($consulta);
            $respuesta = [];
            if ($resultado -> num_rows > 0)
            {
                while ($fila = $resultado -> fetch_assoc())
                {
                    $respuesta[] = $fila;
                }
            }
            else
            {
                $respuesta = false;
            }
            // $this -> connection -> closeConnection();
            return $respuesta;
        }
    }

    public function areaReservation()
    {
        if ($_SESSION['role'] == 1)
        {
            $consulta = "SELECT Area_Reservada, CantidadParticipantes FROM Reservas WHERE idAdmin = ". $_SESSION['id'] ." AND Area_Reservada IS NOT NULL";
            $conexion = $this -> connection -> getConnection();
            $resultado = $conexion -> query($consulta);
            $respuesta = [];
            if ($resultado -> num_rows > 0)
            {
                while ($fila = $resultado -> fetch_assoc())
                {
                    $respuesta[] = $fila;
                }
            }
            else
            {
                $respuesta = false;
            }
            // $this -> connection -> closeConnection();
            return $respuesta;
        }
        else
        {
            $consulta = "SELECT Area_Reservada, CantidadParticipantes FROM Reservas WHERE idCliente = ". $_SESSION['id'] ." AND Area_Reservada IS NOT NULL";
            $conexion = $this -> connection -> getConnection();
            $resultado = $conexion -> query($consulta);
            $respuesta = [];
            if ($resultado -> num_rows > 0)
            {
                while ($fila = $resultado -> fetch_assoc())
                {
                    $respuesta[] = $fila;
                }
            }
            else
            {
                $respuesta = false;
            }
            // $this -> connection -> closeConnection();
            return $respuesta;
        }
    }
}
?>