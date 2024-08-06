<?php
    include_once("app/model/areasModel.php");
    class areasController
    {
        private $area;

        public function indexClient()
        {
            if(session_status()===PHP_SESSION_NONE){
                session_start();
            }
            if( isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==true && $_SESSION['role'] == 2){
                $this -> area = new areasModel();
                $datos_Area = $this -> area -> getAreas();
                $vista = "app/view/areas/verAreas.php";
                include_once("app/view/clientes/areasIndexView.php");
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
            if( isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==true && $_SESSION['role'] == 1){
                $this -> area = new areasModel();
                $datos_Area = $this -> area -> getAreas();
                $vista = "app/view/areas/verAreas.php";
                include_once("app/view/admin/adminAreaView.php");
            }
            else
            {
                header("location:http://localhost/php-3c/"); 
            }
        }
        
        public function callRegisterAreaForm()
        {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $this -> area = new areasModel();
            $areas = $this -> area -> getTipoAreas();
            $ubicaciones = $this -> area -> getUbicaciones();
            $vista = "app/view/areas/createAreaForm.php";
            if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true && $_SESSION['role'] == 1) {
                include_once("app/view/admin/adminAreaView.php");
            } else {
                include_once("app/view/clientes/areasIndexView.php");
            }
        }

        public function registerArea()
        {
            if(session_status()===PHP_SESSION_NONE){
                session_start();
            }
            if($_SERVER['REQUEST_METHOD']=='POST'){
                if(!isset($_POST['Nombre'], $_POST['Area'], $_POST['Descripcion'], $_POST['Ubicacion'], $_FILES['Imagen']['tmp_name'])){
                    header("location:http://localhost/proyecto-reservas/");
                }
                $dato=array(
                    'Nombre'=>$_POST['Nombre'],
                    'Area'=>$_POST['Area'],
                    'Descripcion'=>$_POST['Descripcion'],
                    'Ubicacion'=>$_POST['Ubicacion'],
                    'Imagen'=>addslashes(file_get_contents($_FILES['Imagen']['tmp_name']))
                );
                $area = new areasModel();
                $resultado=$area->publishArea($dato);
                if($resultado){
                    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==true && $_SESSION['role'] == 1)
                    {
                        header("location:http://localhost/proyecto-reservas/?C=areasController&M=indexAdmin");
                    }
                    else
                    {
                        header("location:http://localhost/proyecto-reservas/?C=areasController&M=indexClient");
                    }
                }else{
                    header("location:http://localhost/php-3c");
                }
            }
        }
        public function callEditAreaForm()
        {
            if(session_status()===PHP_SESSION_NONE){
                session_start();
            }
            if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==true && $_SESSION['role'] == 1){
                if($_SERVER['REQUEST_METHOD']=='GET'){
                    if (isset($_GET['idArea']))
                    {
                        $id=$_GET['idArea'];
                        $this->area=new areasModel();
                        $dato = $this->area->getById($id);
                        $areas = $this -> area -> getTipoAreas();
                        $ubicaciones = $this -> area -> getUbicaciones();
                        $vista="app/view/areas/alterAreaForm.php";
                        include_once("app/view/admin/adminAreaView.php");
                    } else {
                        // Manejar el caso donde no se pasa idArea
                        echo "Error: idArea no está definido.";
                    }
                }
            }else{
                header("location:http://localhost/proyecto-reservas");
            }
        }

        public function editArea(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $datoArea = array(
                    'idArea' => $_POST['idArea'],
                    'NombreArea' => $_POST['NombreArea'],
                    'TipoArea' => $_POST['TipoArea'],
                    'Descripcion' => $_POST['Descripcion'],
                    'Ubicacion' => $_POST['Ubicacion'],
                );
        
                $this->area = new areasModel();
                $respuesta = $this->area->editArea($datoArea);
                if($respuesta){
                    header("Location: http://localhost/proyecto-reservas/?C=areasController&M=indexAdmin");
                }else{
                    header("Location: http://localhost/proyecto-reservas/?C=areasController&M=callEditAreaForm&idArea=" . $datoArea['idArea']);
                }
            }
        }

        public function deleteArea(){
            if($_SERVER['REQUEST_METHOD'] == 'GET'){
                $id=$_GET['idArea'];
                $this->area=new areasModel();
                $respuesta=$this->area->delete($id);
                if($respuesta){
                    header("location:http://localhost/proyecto-reservas/?C=areasController&M=indexAdmin&success=true");
                }else{
                    header("location:http://localhost/proyecto-reservas/?C=areasController&M=indexAdmin&success=false");
                }
            }
        }
        
    }
?>

