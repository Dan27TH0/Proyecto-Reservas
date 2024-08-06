<?php
    class defaultController{
        private $vista;

        public function index(){
            $vista = "app/view/homeView.php";
            include_once("app/view/plantillaView2.php");
        }
    }
?>