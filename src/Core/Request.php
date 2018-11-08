<?php

namespace App\Core;

class Request{
    private $_controlador;
    private $_metodo;
    private $_argumentos;

    /**
     * Request constructor.
     *
     * Construye la solicitud a traves de la URL.
     */
    public function __construct(){
        if (isset($_GET['url'])) {
            $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
            $url = explode("/", $url);
            $url = array_filter($url);

            $this->_controlador = strtolower(array_shift($url));
            $this->_metodo = strtolower(array_shift($url));
            $this->_argumentos = $url;
        }

        if (!$this->_controlador) {
            $this->_controlador = DEFAULT_CONTROLLER;
        }
        if (!$this->_metodo) {
            $this->_metodo = "index";
        }
        if (!$this->_argumentos) {
            $this->_argumentos = array();
        }
    }

    /**
     * Obtiene el nombre del controlador.
     * @return string
     */
    public function getControlador(){
        return $this->_controlador;
    }

    /**
     * Obtiene el nombre del metodo
     * @return string
     */
    public function getMetodo(){
        return $this->_metodo;
    }

    /**
     * Obtiene los parametros lazados en la URL
     * @return array
     */
    public function getArgs(){
        return $this->_argumentos;
    }
}
