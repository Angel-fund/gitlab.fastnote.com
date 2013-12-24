<?php

namespace Redwood\Service\User\Dao\Impl;

use Redwood\Service\Common\BaseDao;
use Redwood\Service\User\Dao\UserDao;
use Redwood\Common\DaoException;
use PDO;

class UserDaoImpl extends BaseDao implements UserDao
{
    protected $table = 'user';

    public function getUser($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ? LIMIT 1";
        return $this->getConnection()->fetchAssoc($sql, array($id)) ? : null;
    }

    public function addUser($user)
    {
        $affected = $this->getConnection()->insert($this->table, $user);
        if ($affected <= 0) {
            throw $this->createDaoException('Insert user error.');
        }
        return $this->getUser($this->getConnection()->lastInsertId());
    }

}