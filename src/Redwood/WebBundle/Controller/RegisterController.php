<?php 

namespace Redwood\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Redwood\WebBundle\Form\RegisterForm;

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
				// $user = $this->getUserService()->register($registration);
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
