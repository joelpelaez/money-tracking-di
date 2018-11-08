<?php
/**
 * Created by PhpStorm.
 * User: joel
 * Date: 06/11/2018
 * Time: 12:15 PM
 */

namespace App\Controller;


use App\Core\AppController;
use App\Core\View;
use App\Model\AccountModel;

/**
 * Class AccountController
 * @package App\Controller
 */
class AccountController extends AppController
{
    /**
     * Modelo de las cuentas
     * @var AccountModel
     */
    protected $accountModel;

    /**
     * AccountController constructor.
     * @param AccountModel $accountModel
     */
    public function __construct(AccountModel $accountModel) {
        $this->accountModel = $accountModel;
    }

    /**
     * Accion incial
     */
    public function index() {
        $accounts = $this->accountModel->findAll();
        $this->render('account.index', ['accounts' => $accounts]);
    }

    /**
     * Agrega una nueva cuenta
     */
    public function add() {
        if ($_POST) {
            $values = [];
            $values['name'] = $_POST['name'];
            $values['user_id'] = USER_ID;
            $this->accountModel->add($values);
            View::action('Se ha creado la cuenta');
            $this->redirect(['controller' => 'account']);
            return;
        }

        $this->render('account.add');
    }

    /**
     * Edita una cuenta existente
     * @param $id
     */
    public function edit($id) {
        if ($_POST) {
            $values = [];
            $values['id'] = $id;
            $values['user_id'] = USER_ID;
            $values['name'] = $_POST['name'];

            $this->accountModel->update($values);
            View::action('Se ha actualizado la cuenta');
            $this->redirect(['controller' => 'account']);
            return;
        }

        $account = $this->accountModel->find($id);
        $this->render('account.edit', ['account' => $account]);
    }

    /**
     * Elimina una cuenta
     * @param $id
     */
    public function delete($id) {
        try {
            $this->accountModel->delete($id);
        } catch (\PDOException $e) {
            View::action('Error al eliminar, la cuenta esta en uso');
            $this->redirect(['controller' => 'account']);
            return;
        }
        View::action('Se ha eliminado la cuenta');
        $this->redirect(['controller' => 'account']);
    }
}