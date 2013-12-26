<?php

namespace Redwood\Service\User\Dao;

interface UserDao
{
	public function getUser($id);

	public function findUserByEmail($email);

	public function findUserByUsername($username);

    public function addUser($user);

    public function updateUser($id, $fields);

    

}