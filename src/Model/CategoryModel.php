<?php
/**
 * Created by PhpStorm.
 * User: joel
 * Date: 05/11/2018
 * Time: 09:46 PM
 */

namespace App\Model;


use App\Core\Database;

class CategoryModel
{
    /**
     * @var Database
     */
    private $db;

    public function __construct(Database $database) {
        $this->db = $database;
    }

    public function findAll() {
        return $this->db->query("SELECT * FROM categories")->fetchAll();
    }

    public function find($id) {
        $query = $this->db->prepare("SELECT * FROM categories WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch();
    }

    public function add($data) {
        $query = $this->db->prepare('INSERT INTO categories (name) VALUES (:name)');
        $query->bindParam(':name', $data['name']);
        return $query->execute();
    }

    public function update($data) {
        $query = $this->db->prepare('UPDATE categories SET name = :name WHERE id = :id');
        $query->bindParam(':id', $data['id']);
        $query->bindParam(':name', $data['name']);
        return $query->execute();
    }

    public function delete($id) {
        $query = $this->db->prepare('DELETE FROM categories WHERE id = :id');
        $query->bindParam(':id', $id);
        return $query->execute();
    }
}