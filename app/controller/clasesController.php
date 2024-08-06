<?php
    include_once("app/model/clasesModel.php");
    class clasesController
    {
        private $clase;

        public function indexClient()
        {
            if(session_status()===PHP_SESSION_NONE){
                session_start();
            }
            if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==true && $_SESSION['role'] == 2){
                $this -> clase = new clasesModel();
                $clases = $this -> clase -> getClases();
                $vista = "app/view/clases/verClases.php";
                include_once("app/view/clientes/clasesIndexView.php");
            }
            else
            {
                header("location:http://localhost/proyecto-reservas/");
            }
        }
        public function indexAdmin()
        {
            if(session_status()===PHP_SESSION_NONE){
                session_start();
            }
            if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==true && $_SESSION['role'] == 1){
                $this -> clase = new clasesModel();
                $clases = $this -> clase -> getClases();
                $vista = "app/view/clases/verClases.php";
                include_once("app/view/admin/adminClassView.php");
            }
            else
            {
                header("location:http://localhost/proyecto-reservas/");
            }
        }

        public function callRegisterClassForm(){
            if(session_status()===PHP_SESSION_NONE){
                session_start();
            }
            $this -> clase = new clasesModel();
            $deporte = $this -> clase -> getDeporte();
            $vista = "app/view/clases/createClassForm.php";
            if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true && $_SESSION['role'] == 1)
            {
                include_once("app/view/admin/adminClassView.php");
            }
            else
            {
                include_once("app/view/clientes/clasesIndexView.php");
            }
        }

        public function registerClass()
        {
            if($_SERVER['REQUEST_METHOD']=='POST'){
                if(!isset($_POST['Nombre'], $_POST['Descripcion'], $_POST['Hora_Inicio'], $_POST['Hora_Fin'], $_POST['idDeporteSeleccion'])){
                    header("location:http://localhost/proyecto-reservas/");
                }
                if(session_status()===PHP_SESSION_NONE){
                    session_start();
                }
                $data=array(
                    'Nombre'=>$_POST['Nombre'],
                    'Descripcion'=>$_POST['Descripcion'],
                    'Hora_Inicio'=>$_POST['Hora_Inicio'],
                    'Hora_Fin'=>$_POST['Hora_Fin'],
                    'id'=>$_SESSION['id'],
                    'idDeporte'=>$_POST['idDeporteSeleccion']
                );
                error_log("Datos recibidos: " . print_r($data, true));

                $clase = new clasesModel();
                $resultado=$clase->createClass($data);
                if($resultado){
                    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==true && $_SESSION['role'] == 1)
                    {
                        header("location:http://localhost/proyecto-reservas/?C=clasesController&M=indexAdmin");
                    }
                    else
                    {
                        header("location:http://localhost/proyecto-reservas/?C=clasesController&M=indexClient");
                    }
                }else{
                    header("location:http://localhost/php-3c");
                }
            }
        }

        public function callEditClassForm()
        {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true && $_SESSION['role'] == 1) {
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    if (isset($_GET['idClase'])) {
                        $id = $_GET['idClase'];
                        $this->clase = new clasesModel();
                        $deporte = $this -> clase -> getDeporte();            
                        $data = $this->clase->getById($id);
                        if ($data) {
                            $vista = "app/view/clases/alterClassForm.php";
                            include_once("app/view/admin/adminClassView.php");
                        } else {
                            // Manejar el caso donde el clase no existe
                            echo "Error: El clase no se encontró.";
                        }
                    } else {
                        // Manejar el caso donde no se pasa idClase
                        echo "Error: idClase no está definido.";
                    }
                }
            } else {
                header("location:http://localhost/proyecto-reservas");
            }
        }

        public function editClass()
        {
            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $datoClase = array(
                    'idClase' => $_POST['idClase'],
                    'Nombre' => $_POST['Nombre'],
                    'Descripcion' => $_POST['Descripcion'],
                    'Hora_Inicio' => $_POST['HoraI'],
                    'Hora_Fin' => $_POST['HoraF'],
                    'id' => $_SESSION['id'],
                    'idDeporte' => $_POST['idDeporteSeleccion']
                );

                $this->clase = new clasesModel();
                $respuesta = $this->clase->editEvent($datoClase);
                if($respuesta){
                    header("location: http://localhost/proyecto-reservas/?C=clasesController&M=indexAdmin&success=true");
                }else{
                    header("location: http://localhost/proyecto-reservas/?C=clasesController&M=callEditClassForm&idClase=" . $datoClase['idClase'] . "&success=false");
                }
            }
        }

        public function deleteClass()
        {
            if($_SERVER['REQUEST_METHOD'] == 'GET')
            {
                $id = $_GET['idClase'];
                $this->clase = new clasesModel();
                $respuesta = $this->clase->delete($id);
                if($respuesta)
                {
                    header("location:http://localhost/proyecto-reservas/?C=clasesController&M=indexAdmin&success=true");
                }
                else{
                    header("location:http://localhost/proyecto-reservas/?C=clasesController&M=indexAdmin&success=false");
                }
            }
        }

        public function inscription()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                
                $id = $_GET['idClase'];
                $idCliente = $_SESSION['id'];
                $this->clase = new clasesModel();
                $respuesta = $this->clase->inscription($id, $idCliente);
                
                header('Content-Type: application/json');
                if ($respuesta) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false]);
                }
            }
        } 
    }
?>