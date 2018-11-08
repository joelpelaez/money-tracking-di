<?php

namespace App\Core;

class View {
    /**
     * @var PageInfo
     */
    public $page;

    /**
     * @var AppError
     */
    public $error;

    /**
     * @var string
     */
    public $title;

    /**
     * CSS Folder location
     * @var string
     */
    public $css_folder;

    /**
     * JavaScript Folder location
     * @var string
     */
    public $js_folder;

    /**
     * Images Folder location
     * @var string
     */
    public $img_folder;

    /**
     * Saved message for display in redirection.
     * @var string
     */
    protected $action;

    /**
     * Inserted data to view from controller.
     *
     * @see renderPage()
     * @see ViewTrait::render()
     * @var array
     */
    protected $data;

    /**
     * Render view and shows to client
     * @param string $view View name.
     * @param array $data Associative array with data objects.
     */
    public function renderPage($view, $data) {
        $_layoutParams = array(
            "ruta_css"=>APP_URL."views/layouts/".DEFAULT_LAYOUT."/css/",
            "ruta_img"=>APP_URL."views/layouts/".DEFAULT_LAYOUT."/img/",
            "ruta_js"=>APP_URL."views/layouts/".DEFAULT_LAYOUT."/js/"
        );

        $archivoVista = str_replace('.',DS, $view);
        $rutaVista = ROOT."views".DS.$archivoVista.".phtml";

        if (is_readable($rutaVista)) {
            //include_once(ROOT."views".DS."layouts".DS.DEFAULT_LAYOUT.DS."header.php");
            $errors = false;
            $isBuffering = false;
            try {
                $isBuffering = ob_start();
                $this->setData($data);
                include_once($rutaVista);
                $output = ob_get_clean();

                $isBuffering = false;
                $this->css_folder = $_layoutParams['ruta_css'];
                $this->img_folder = $_layoutParams['ruta_img'];
                $this->js_folder = $_layoutParams['ruta_js'];
                $this->page = new PageInfo();
                $this->page->title = $this->title;
                $this->page->content = $output;
                include_once(ROOT . "views" . DS . "layouts" . DS . DEFAULT_LAYOUT . DS . "template.php");
            } catch (\Throwable $e) {
                if ($isBuffering)
                    ob_end_clean();
                $this->error = new AppError;
                $this->error->code = $e->getCode();
                $this->error->name = $e->getMessage();
                include_once(ROOT . "views" . DS . "layouts" . DS . DEFAULT_LAYOUT . DS . "errors.php");
            }
            //include_once(ROOT."views".DS."layouts".DS.DEFAULT_LAYOUT.DS."footer.php");
        }else{
            throw new \RuntimeException("Vista no encontrada: " . $rutaVista);
        }
    }

    /**
     * Set view values passed by controller.
     * @param array $data An associative array wirh the values .
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Get the value from array given in view call.
     *
     * @param string $key Value key in the array.
     * @param null $default A default value if the key not exists in the array.
     * @return mixed
     * @throws \Exception If a value with a given key not exists and the default value is null.
     */
    public function get($key, $default = null) {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }
        if ($default == null)
            throw new \Exception("Value with key {$key} not exists and a default value is not given");
        return $default;
    }
    public function e($string) {
        return htmlspecialchars($string);
    }

    /**
     * Get action message from other request.
     * @return bool|string Return a message text from other request if exists, false otherwise.
     */
    public function getAction()
    {
        if (session_id()) {
            if (isset($_SESSION['action'])) {
                $this->action = $_SESSION['action'];
                unset($_SESSION['action']);
            }

            if (!empty($this->action))
                return $this->action;
        }

        return false;
    }

    /**
     * Saves action message to session.
     *
     * This version is for easy call from same object. Other calle must use {@see View::action}
     *
     * @param $action
     * @return bool
     */
    public function setAction($action) {
        return self::action($action);
    }

    /**
     * Saves action message to session.
     *
     * Saves a string for access from views.
     *
     * @param $action
     * @return bool
     */
    public static function action($action) {
        if (session_id()) {
            $_SESSION['action'] = $action;
            return true;
        }

        return false;
    }
}
