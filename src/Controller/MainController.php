<?php
/**
 * Created by PhpStorm.
 * User: joel
 * Date: 05/11/2018
 * Time: 09:35 PM
 */

namespace App\Controller;

use App\Core\AppController;

/**
 * Class MainController
 * @package App\Controller
 */
class MainController extends AppController {

    /**
     * Acción de inicio
     */
    public function index() {
        $this->render('main.index', ['message' => 'hello']);
    }

}