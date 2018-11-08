<?php
/**
 * Created by PhpStorm.
 * User: joel
 * Date: 05/11/2018
 * Time: 09:02 PM
 */

namespace App\Model;


use App\Core\AppModel;
use App\Core\Database;

class AccountModel
{
    /**
     * @var Database
     */
    private $db;

    public function __construct(Database $database) {
        $this->db = $database;
    }

    public function findAll() {
        return $this->db->query("SELECT * FROM accounts")->fetchAll();
    }

    public function find($id) {
        $query = $this->db->prepare("SELECT * FROM accounts WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch();
    }

    public function add($data) {
        $query = $this->db->prepare('INSERT INTO accounts (user_id, name) VALUES (:user_id, :name)');
        $query->bindParam(':user_id', $data['user_id']);
        $query->bindParam(':name', $data['name']);
        return $query->execute();
    }

    public function update($data) {
        $query = $this->db->prepare('UPDATE accounts SET user_id = :user_id, name = :name WHERE id = :id');
        $query->bindParam(':id', $data['id']);
        $query->bindParam(':user_id', $data['user_id']);
        $query->bindParam(':name', $data['name']);
        return $query->execute();
    }

    public function delete($id) {
        $query = $this->db->prepare('DELETE FROM accounts WHERE id = :id');
        $query->bindParam(':id', $id);
        return $query->execute();
    }
}