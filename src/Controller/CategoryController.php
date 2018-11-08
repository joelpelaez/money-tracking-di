<?php
/**
 * Created by PhpStorm.
 * User: joel
 * Date: 06/11/2018
 * Time: 07:57 PM
 */

namespace App\Controller;


use App\Core\AppController;
use App\Core\View;
use App\Model\CategoryModel;

/**
 * Class CategoryController
 * @package App\Controller
 */
class CategoryController extends AppController
{
    /**
     * Modelo de categorias
     * @var CategoryModel
     */
    protected $categoryModel;

    /**
     * CategoryController constructor.
     * @param CategoryModel $categoryModel
     */
    public function __construct(CategoryModel $categoryModel) {
        $this->categoryModel = $categoryModel;
    }

    /**
     * Accion de inicio
     */
    public function index() {
        $categories = $this->categoryModel->findAll();
        $this->render('category.index', ['categories' => $categories]);
    }

    /**
     * Agrega una nueva categoria
     */
    public function add() {
        if ($_POST) {
            $values = [];
            $values['name'] = $_POST['name'];
            $this->categoryModel->add($values);
            $this->redirect(['controller' => 'category']);
            return;
        }

        $this->render('category.add');
    }


    /**
     * Edita una categoria existente
     * @param $id
     */
    public function edit($id) {
        if ($_POST) {
            $values = [];
            $values['id'] = $id;
            $values['name'] = $_POST['name'];

            $this->categoryModel->update($values);
            $this->redirect(['controller' => 'category']);
            return;
        }

        $category = $this->categoryModel->find($id);
        $this->render('category.edit', ['category' => $category]);
    }

    /**
     * Elimina una categoría existente, avisa si esta no se puede eliminar.
     * @param $id
     */
    public function delete($id)
    {
        try {
            $this->categoryModel->delete($id);
        } catch (\PDOException $e) {
            View::action('Error al eliminar, la categoría esta en uso');
            $this->redirect(['controller' => 'category']);
            return;
        }
        View::action('Se ha eliminado la categoría');
        $this->redirect(['controller' => 'category']);
    }
}