<?php

namespace App\Core;

use DI\Container;

/**
 * Class Bootstrap
 *
 * Realiza la inicialización de la aplicación basado en la solicitud URL
 * hecha al servidor.
 *
 * @package App\Core
 */
class Bootstrap
{
    /**
     * Inicializa el trabajo de ejecución de la solicitud Web
     * @param Request $peticion Objeto global de petición.
     * @param Container $container Contenedir de inyección de dependencias.
     * @throws \DI\DependencyException Si durante la ejecución de la solicitud existe una dependencia no resuelta.
     * @throws \DI\NotFoundException Si la clase o interfaz solicitada no existe.
     */
    public static function run(Request $peticion, Container $container){
        $controller = "App\\Controller\\".$peticion->getControlador()."Controller";
        $metodo = $peticion->getMetodo();
        $args = $peticion->getArgs();
        $controller = $container->get($controller);

        if (is_callable(array($controller, $metodo))) {
            $metodo = $peticion->getMetodo();
        }else{
            $metodo = "index";
        }

        if (isset($args)) {
            call_user_func_array(array($controller, $metodo), $peticion->getArgs());
        }else{
            call_user_func(array($controller, $metodo));
        }
    }
}

