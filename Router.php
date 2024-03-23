<?php

namespace MVC;

class Router {

    public $rutasGET = []; 
    public $rutasPOST = [];

    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn; //array(1) {["/nosotros"]=> string(16) "funcion_nosotros"}
    }

    public function comprobarRutas() {
        $urlActual = $_SERVER['PATH_INFO'] ?? '/'; // /propiedades/crear
        $metodo = $_SERVER['REQUEST_METHOD']; //GET

        if($metodo === 'GET') {
            $fn=$this->rutasGET[$urlActual] ?? null; // funcion_nosotros
        }

        if($fn) {
            //debuguear($fn); //array(2) {[0]=> string(31) "Controllers\PropiedadController"[1]=>string(5) "index"}
            call_user_func($fn, $this); //La URL existe y hay una función asociada
        }else{
            echo "Página No Encontrada";
        }
    }

    //Muestra una vista
    public function render($view){
        include __DIR__ . "/views/$view.php";
    }
}