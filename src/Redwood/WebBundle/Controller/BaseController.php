<?php

namespace Redwood\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class BaseController extends Controller
{
	

    //页面中用到的 ajax 刷新页面，都是用这个方法的
    protected function createJsonResponse($data)
    {
        return new JsonResponse($data);
    }
}
