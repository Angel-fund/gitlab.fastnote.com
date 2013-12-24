<?php 

namespace Redwood\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Redwood\WebBundle\Form\RegisterForm;
use Redwood\Service\Common\ServiceKernel;

class RegisterController extends BaseController
{
    public function indexAction(Request $request)
    {

		$form = $this->createForm(new RegisterForm());

		if ($request->isMethod('POST')) 
		{
		   $form->bind($request);
		   if ($form->isValid()) {

				$registration = $form->getData();
				$currentUser = array('name'=>'heijude');
				ServiceKernel::instance()->setCurrentUser($currentUser);
				$user = $this->getUserService()->register($registration);
				// $this->authenticateUser($user);
				// // $this->sendVerifyEmail($user);
				return $this->redirect($this->generateUrl('register_success'));
		   }

		}
		return $this->render('RedwoodWebBundle:Register:index.html.twig', array(
			'form' => $form->createView(),
		));
     }

}
