<?php

namespace App\Core;

abstract class AppController
{
    use ViewTrait;

    /**
     * Acción por defecto del controlador.
     *
     * Permite ejecutar la acción predeterminada de un controlador,
     * es requerido en cada implementación de la clase.
     *
     * @throws \Exception
     */
    abstract function index();


    /**
     * Realiza una redirección falsa a otro controlador.
     *
     * Permite obtener el destino del controlador y la acción definidas.
     *
     * @param array $url Un array con las clave 'action' y 'controller' con los respectivos valores.
     */
    public function redirect($url = array()) {
        $path = "";

        if (array_key_exists("controller", $url)) {
            $path .= $url['controller'];
        }

        if (array_key_exists("action", $url)) {
            $path .= $url['action'];
        }

        header('Location: '.APP_URL.$path);
    }
}
