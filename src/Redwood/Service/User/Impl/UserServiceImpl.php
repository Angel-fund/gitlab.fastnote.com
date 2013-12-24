<?php
namespace Redwood\Service\User\Impl;

// use Redwood\Common\SimpleValidator;
use Redwood\Service\Common\BaseService;
use Redwood\Service\User\UserService;

class UserServiceImpl extends BaseService implements UserService
{
    public function getUser($id)
    {
        $user = $this->getUserDao()->getUser($id);
        if(!$user){
            return null;
        } else {
            return UserSerialize::unserialize($user);
        }
    }

    public function register($registration, $type = 'default')
    {
        var_dump($registration);
        $user = $this->getUserDao()->addUser($registration);
        var_dump($user);
        return $user;
    }

    private function getUserDao()
    {
        return $this->createDao('User.UserDao');
    }

}