<?php
/**
 * Created by PhpStorm.
 * User: joel
 * Date: 05/11/2018
 * Time: 10:47 PM
 */

namespace App\Model;

use App\Core\Database;

class TransactionModel
{
    /**
     * @var Database
     */
    private $db;

    public function __construct(Database $database) {
        $this->db = $database;
    }

    public function findAll() {
        return $this->db->query(
            "SELECT t.*, a.name as account, c.name as category FROM transactions AS t JOIN accounts a ON t.account_id = a.id JOIN categories c ON t.category_id = c.id"
        )->fetchAll();
    }

    public function find($id) {
        $query = $this->db->prepare("SELECT * FROM transactions WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch();
    }

    public function add($data) {
        $query = $this->db->prepare(
            'INSERT INTO transactions (account_id, category_id, description, date, amount) '.
            'VALUES (:account_id, :category_id, :description, :date, :amount)'
        );
        $query->bindParam(':account_id', $data['account_id']);
        $query->bindParam(':category_id', $data['category_id']);
        $query->bindParam(':description', $data['description']);
        $query->bindParam(':date', $data['date']);
        $query->bindParam(':amount', $data['amount']);
        return $query->execute();
    }

    public function update($data) {
        $query = $this->db->prepare(
            'UPDATE transactions SET account_id = :account_id, category_id = :category_id, '.
            'description = :description, date = :date, amount = :amount WHERE id = :id'
        );
        $query->bindParam(':id', $data['id']);
        $query->bindParam(':account_id', $data['account_id']);
        $query->bindParam(':category_id', $data['category_id']);
        $query->bindParam(':description', $data['description']);
        $query->bindParam(':date', $data['date']);
        $query->bindParam(':amount', $data['amount']);
        return $query->execute();
    }

    public function delete($id) {
        $query = $this->db->prepare('DELETE FROM transactions WHERE id = :id');
        $query->bindParam(':id', $id);
        return $query->execute();
    }
}