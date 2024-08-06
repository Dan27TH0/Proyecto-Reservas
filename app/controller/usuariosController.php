<?php
include_once("app/model/usuariosModel.php");
class usuariosController
{
    private $usuario;

    public function indexClient()
    {
        if(session_status()===PHP_SESSION_NONE){
            session_start();
        }

        if( isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==true && $_SESSION['role'] == 2){
            $vista= "app/view/clientes/clientCatalogueView.php";
            include_once("app/view/clientes/clientIndexView.php");
        } else{
            header("location:http://localhost/proyecto-reservas/");
        }
    }

    public function indexAdmin()
    {
        if(session_status()===PHP_SESSION_NONE){
            session_start();
        }

        if( isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==true && $_SESSION['role'] == 1){
            $vista= "app/view/admin/adminCatalogueView.php";
            include_once("app/view/admin/adminIndexView.php");
        } else{
            header("location:http://localhost/proyecto-reservas/");
        }
    }

    public function callRegisterForm(){
        if(session_status()===PHP_SESSION_NONE){
            session_start();
        }
        $vista = "app/view/registerForm.php";
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true)
        {
            include_once("app/view/clientes/clientIndexView.php");
        }
        else
        {
            include_once("app/view/plantillaView2.php");
        }
    }

    public function registerUsers(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(!isset($data['Nombre'],$data['ApPaterno'],$data['ApMaterno'],$data['Email'],$data['Telefono'],$data['Contraseña'])){
                header("location:http://localhost/proyecto-reservas/");
            }
            $data=array(
                'Nombre'=>$_POST['Nombre'],
                'ApPaterno'=>$_POST['ApPaterno'],
                'ApMaterno'=>$_POST['ApMaterno'],
                'Email'=>$_POST['Email'],
                'Telefono'=>$_POST['Telefono'],
                'Contraseña'=>$_POST['Contraseña']
            );
            $usuario= new usuariosModel();
            $resultado=$usuario->registerUsers($data);
            if($resultado){
                header("location:http://localhost/proyecto-reservas/?C=usuariosController&M=index");
            }else{
                header("location:http://localhost/proyecto-reservas");
            }
        }
    }

    public function callLoginForm()
    {
        if(session_status()===PHP_SESSION_NONE){
            session_start();
        }
        $vista = "app/view/loginForm.php";
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true)
        {
            include_once("app/view/clientes/clientIndexView.php");
        }
        else
        {
            include_once("app/view/plantillaView2.php");
        }
    }

    public function loginUsers()
    {
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $tipo=$_POST['Tipo'];
            $user=$_POST['Email'];
            $password=$_POST['Contraseña'];
            $this -> usuario = new usuariosModel();
            $respuesta=$this->usuario->getCredentials($tipo, $user, $password);
            if($respuesta)
            {
                $usuario= new usuariosController();
                if(session_status()===PHP_SESSION_NONE){
                    session_start();
                }
                $_SESSION['loggedIn']=true;
                $_SESSION['role'] = $tipo;
                if ($_SESSION['role'] == 1) 
                {
                    $_SESSION['id'] = $respuesta['idAdmin'];
                    $_SESSION['name']=$respuesta['Nombre']. " " .$respuesta['ApPaterno']. " " .$respuesta['ApMaterno'];
                    include_once('app/controller/areasController.php');
                    // $area = new areasController();
                    $this -> indexAdmin();
                }
                elseif ($_SESSION['role'] == 2)
                {
                    $_SESSION['id'] = $respuesta['idCliente'];
                    $_SESSION['name'] = $respuesta['idCliente']. " " .$respuesta['Nombre']. " " .$respuesta['ApPaterno'];
                    include_once('app/controller/areasController.php');
                    // $area = new areasController();
                    $this -> indexClient();
                }
                else
                {
                    
                }
            }
            else
            {
                $vista="app/view/errorView.php";
                include_once("app/view/plantillaView2.php");
            }
        }
    }

    public function viewProfileAdmin()
    {
        if(session_status()===PHP_SESSION_NONE)
        {
            session_start();
        }
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true && $_SESSION['role'] == 1)
        {
            $this -> usuario = new usuariosModel();
            $datos_Clase = $this -> usuario -> classInscriptions();
            $datos_Eventos = $this -> usuario -> eventInscriptions();
            $datos_Areas = $this -> usuario -> areaReservation();
            $vista = "app/view/perfilView.php";
            include_once("app/view/admin/adminPerfilView.php");
        }
        else
        {
            header("location:http://localhost/proyecto-reservas/");

        }
    }

    public function viewProfileClient()
    {
        if(session_status()===PHP_SESSION_NONE)
        {
            session_start();
        }
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true && $_SESSION['role'] == 2)
        {
            $this -> usuario = new usuariosModel();
            $datos_Clase = $this -> usuario -> classInscriptions();
            $datos_Eventos = $this -> usuario -> eventInscriptions();
            $datos_Areas = $this -> usuario -> areaReservation();
            $vista = "app/view/perfilView.php";
            include_once("app/view/clientes/perfilIndexView.php");

        }
        else
        {
            header("location:http://localhost/proyecto-reservas/");
        }
    }

    public function logedout(){
        if(session_status()===PHP_SESSION_NONE){
            session_start();
            $_SESSION['loggedIn']=false;
            header("location:http://localhost/proyecto-reservas/");
        }

    }
}
?>