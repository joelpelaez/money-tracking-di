<?php

namespace App\Core;

/**
 * Class AppError
 *
 * Muestra de manera estructurada los errores encontrados en la aplicación
 * para ser visalizados en una página definida.
 *
 * @package App\Core
 */
class AppError {
    public $name;
    public $info;
    public $code;
    public $file;
    public $line;
}