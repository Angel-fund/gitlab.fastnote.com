<?php

namespace Redwood\Service\User\Dao;

interface UserDao
{
	public function getUser($id);

    public function addUser($user);

}