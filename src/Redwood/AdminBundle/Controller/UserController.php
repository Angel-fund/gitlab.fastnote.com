<?php

namespace Redwood\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Redwood\Common\Paginator;

class UserController extends BaseController
{
	public function indexAction(Request $request)
	{
		$fields = $request->query->all();

		$conditions = array(
			'roles' => '',
			'keywordType' => '',
			'keyword' => ''
		);

		if(!empty($fields)){
            $conditions =$fields;
        }

		$paginator = new Paginator(
			$this->get('request'),
			$this->getUserService()->searchUserCount($conditions),
			10
		);

		$users = $this->getUserService()->searchUsers(
			$conditions,
            array('createdTime', 'DESC'),
            $paginator->getOffsetCount(),
            $paginator->getPerPageCount()
		);

		return $this->render('RedwoodAdminBundle:User:index.html.twig', array(
			'users' => $users,
			'paginator' => $paginator,
		));
	}
}