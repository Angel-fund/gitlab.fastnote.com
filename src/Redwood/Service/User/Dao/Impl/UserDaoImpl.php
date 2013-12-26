<?php

namespace Redwood\Service\User\Dao\Impl;

use Redwood\Service\Common\BaseDao;
use Redwood\Service\User\Dao\UserDao;
use Redwood\Common\DaoException;

class UserDaoImpl extends BaseDao implements UserDao
{
    protected $table = 'user';

    public function getUser($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ? LIMIT 1";
        return $this->getConnection()->fetchAssoc($sql, array($id)) ? : null;
    }

    public function findUserByEmail($email)
    {
        $sql = "SELECT * FROM {$this->table} WHERE email = ? LIMIT 1";
        return $this->getConnection()->fetchAssoc($sql, array($email));
    }

    public function findUserByUsername($username)
    {
        $sql = "SELECT * FROM {$this->table} WHERE username = ? LIMIT 1";
        return $this->getConnection()->fetchAssoc($sql, array($username));
    }

    public function addUser($user)
    {
        $affected = $this->getConnection()->insert($this->table, $user);
        if ($affected <= 0) {
            throw $this->createDaoException('Insert user error.');
        }
        return $this->getUser($this->getConnection()->lastInsertId());
    }

    public function updateUser($id, $fields)
    {
        $this->getConnection()->update($this->table, $fields, array('id' => $id));
        return $this->getUser($id);
    }

}