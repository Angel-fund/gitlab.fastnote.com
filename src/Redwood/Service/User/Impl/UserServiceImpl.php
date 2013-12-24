<?php
namespace Redwood\Service\User\Impl;

use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Redwood\Service\Common\BaseService;
use Redwood\Service\User\UserService;

class UserServiceImpl extends BaseService implements UserService
{
    public function getUserByEmail($email)
    {
        if (empty($email)) {
            return null;
        }
        $user = $this->getUserDao()->findUserByEmail($email);
        return $user;
        // if(!$user){
        //     return null;
        // } else {
        //     return UserSerialize::unserialize($user);
        // }
    }

    public function getUserByUsername($username){
        $user = $this->getUserDao()->findUserByUsername($username);
        return $user;
        // if(!$user){
        //     return null;
        // } else {
        //     return UserSerialize::unserialize($user);
        // }
    }

    public function register($registration, $type = 'default')
    {
        if (!$this->validateEmail($registration['email'])) {
            throw $this->createServiceException('email error!');
        }
        if (!$this->validateUsername($registration['username'])) {
            throw $this->createServiceException('username error!');
        }

        if (!$this->isEmailAvailable($registration['email'])) {
            throw $this->createServiceException('Email已存在');
        }

        if (!$this->isUsernameAvailable($registration['username'])) {
            throw $this->createServiceException('用户名已存在');
        }
        $user = array();
        $user['email'] = $registration['email'];
        $user['username'] = $registration['username'];
        $user['roles'] =  'ROLE_USER';
        $user['createdTime'] = time();
        //salt 加密
        $user['salt'] = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $user['password'] = $this->getPasswordEncoder()->encodePassword($registration['password'], $user['salt']);
        var_dump($user);
        $user = $this->getUserDao()->addUser($user);
        return $user;
    }

    private function getPasswordEncoder()
    {
        return new MessageDigestPasswordEncoder('sha256');
    }

    /**
    * 校验是否为邮箱
    */
    private function validateEmail($data)
    {
        $data = (string) $data;
        $valid = filter_var($data, FILTER_VALIDATE_EMAIL);
        return $valid !== false ;
    }

    /**
    * 校验Username是否为真
    */
    private function validateUsername($value, array $option = array())
    {
        $option = array_merge(
            array('minLength' => 4, 'maxLength' => 14),
            $option
        );

        $len = (strlen($value) + mb_strlen($value, 'utf-8')) / 2;
        if ($len > $option['maxLength'] or $len < $option['minLength']) {
        return false;
        }

        return !!preg_match('/^[\x{4e00}-\x{9fa5}a-zA-z0-9_]+$/u', $value);
    }

    public function isUsernameAvailable($username) {
        if (empty($username)) {
            return false;
        }
        $user = $this->getUserDao()->findUserByUsername($username);
        return empty($user) ? true : false;
    }

    public function isEmailAvailable($email) {
        if (empty($email)) {
            return false;
        }
          $user = $this->getUserDao()->findUserByEmail($email);
          return empty($user) ? true : false;
    }

    private function getUserDao()
    {
        return $this->createDao('User.UserDao');
    }

}