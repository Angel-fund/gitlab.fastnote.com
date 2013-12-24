<?php

namespace Redwood\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Redwood\Service\Common\ServiceKernel;

abstract class BaseController extends Controller
{
	

    //页面中用到的 ajax 刷新页面，都是用这个方法的
    protected function createJsonResponse($data)
    {
        return new JsonResponse($data);
    }

    protected function getServiceKernel()
    {
        return ServiceKernel::instance();
    }

    protected function getUserService()
    {
        return $this->getServiceKernel()->createService('User.UserService');
    }
}
