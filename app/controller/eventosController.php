<?php
    include_once("app/model/eventosModel.php");
    class eventosController
    {
        private $evento;

        public function indexClient()
        {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true && $_SESSION['role'] == 2) {
                $this->evento = new eventosModel();
                $datoEvento = $this->evento->getEventos(); // Cambia $eventos a $datoEvento
                $vista = "app/view/eventos/verEventos.php";
                include_once("app/view/clientes/eventosIndexView.php");
            } else {
                header("location:http://localhost/proyecto-reservas/");
            }
        }

        public function indexAdmin()
        {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true && $_SESSION['role'] == 1) {
                $this->evento = new eventosModel();
                $datoEvento = $this->evento->getEventos(); // Cambia $eventos a $datoEvento
                $vista = "app/view/eventos/verEventos.php";
                include_once("app/view/admin/adminEventView.php");
            } else {
                header("location:http://localhost/proyecto-reservas/");
            }
        }

        public function callRegisterEventForm()
        {
            if(session_status()===PHP_SESSION_NONE){
                session_start();
            }
            $this -> evento = new eventosModel();
            $deporte = $this -> evento -> getDeporte();
            $vista = "app/view/eventos/createEventForm.php";
            if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] = true && $_SESSION['role'] == 1)
            {
                include_once ("app/view/admin/adminEventView.php");
            }
            else
            {
                include_once("app/view/clientes/eventosIndexView.php");
            }
        }

        public function registerEvent()
        {
            if($_SERVER['REQUEST_METHOD']=='POST'){
                if(!isset($_POST['Nombre'], $_POST['Descripcion'], $_POST['Hora_Inicio'], $_POST['Hora_Fin'], $_POST['Fecha'],$_POST['idDeporteSeleccion'],$_POST['CantidadParticipantes'])){
                    header("location:http://localhost/proyecto-reservas/");
                }
                if(session_status()===PHP_SESSION_NONE){
                    session_start();
                }
                $dato=array(
                    'Nombre'=>$_POST['Nombre'],
                    'Descripcion'=>$_POST['Descripcion'],
                    'Hora_Inicio'=>$_POST['Hora_Inicio'],
                    'Hora_Fin'=>$_POST['Hora_Fin'],
                    'Fecha'=>$_POST['Fecha'],
                    'id'=>$_SESSION['id'],
                    'idDeporte'=>$_POST['idDeporteSeleccion'],
                    'CantidadParticipantes'=>$_POST['CantidadParticipantes']
                );
                
                $evento = new eventosModel();
                $resultado=$evento->createEvent($dato);
                if($resultado){
                    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==true && $_SESSION['role'] == 1)
                    {
                        header("location:http://localhost/proyecto-reservas/?C=eventosController&M=indexAdmin");
                    }
                    else
                    {
                        header("location:http://localhost/proyecto-reservas/?C=eventosController&M=indexClient");
                    }
                }else{
                    header("location:http://localhost/php-3c");
                }
            }
        }

        public function callEditEventForm()
        {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true && $_SESSION['role'] == 1) {
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    if (isset($_GET['idEvento'])) {
                        $id = $_GET['idEvento'];
                        $this->evento = new eventosModel();
                        $deporte = $this -> evento -> getDeporte();
                        $dato = $this->evento->getById($id);
                        if ($dato) {
                            $vista = "app/view/eventos/alterEventForm.php";
                            include_once("app/view/admin/adminEventView.php");
                        } else {
                            // Manejar el caso donde el evento no existe
                            echo "Error: El evento no se encontró.";
                        }
                    } else {
                        // Manejar el caso donde no se pasa idEvento
                        echo "Error: idEvento no está definido.";
                    }
                }
            } else {
                header("location:http://localhost/proyecto-reservas");
            }
        }

        public function editEvent()
        {
            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $datoEvento = array(
                    'idEvento' => $_POST['idEvento'],
                    'Nombre' => $_POST['Nombre'],
                    'Descripcion' => $_POST['Descripcion'],
                    'Hora_Inicio' => $_POST['HoraI'],
                    'Hora_Fin' => $_POST['HoraF'],
                    'Fecha' => $_POST['Fecha'],
                    'id' => $_SESSION['id'],
                    'idDeporte' => $_POST['idDeporteSeleccion']
                );

                $this->evento = new eventosModel();
                $respuesta = $this->evento->editEvent($datoEvento);
                if($respuesta){
                    header("location: http://localhost/proyecto-reservas/?C=eventosController&M=indexAdmin&success=true");
                }else{
                    header("location: http://localhost/proyecto-reservas/?C=eventosController&M=callEditEventForm&idEvento=" . $datoEvento['idEvento'] . "&success=false");
                }
            }
        }

        public function deleteEvent()
        {
            if($_SERVER['REQUEST_METHOD'] == 'GET')
            {
                $id = $_GET['idEvento'];
                $this->evento = new eventosModel();
                $respuesta = $this->evento->delete($id);
                if($respuesta)
                {
                    header("location:http://localhost/proyecto-reservas/?C=eventosController&M=indexAdmin&success=true");
                }
                else{
                    header("location:http://localhost/proyecto-reservas/?C=eventosController&M=indexAdmin&success=false");
                }
            }
        }  
    }
?>