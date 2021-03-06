<?php
/**
 * Created by PhpStorm.
 * User: joel
 * Date: 06/11/2018
 * Time: 11:07 AM
 */

namespace App\Model;


use App\Core\Database;

class UserModel
{
    /**
     * @var Database
     */
    private $db;

    public function __construct(Database $database)
    {
        $this->db = $database;
    }

    public function findAll() {
        return $this->db->query("SELECT * FROM users")->fetchAll();
    }

}