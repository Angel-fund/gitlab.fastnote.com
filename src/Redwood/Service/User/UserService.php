<?php
namespace Redwood\Service\User;

interface UserService
{
    
	public function getUser($id);

    /**
     * 用户注册
     * @param  [type] $registration 用户注册信息
     * @return array 用户信息
     */
    public function register($registration, $type = 'default');

}