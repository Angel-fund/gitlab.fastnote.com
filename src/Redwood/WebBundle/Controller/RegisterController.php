<?php 

namespace Redwood\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Redwood\WebBundle\Form\RegisterForm;

class RegisterController extends BaseController
{

    public function successAction(Request $request, $id, $hash) {
        $user = $this->checkHash($id, $hash);
        if (empty($user)) {
            throw $this->createNotFoundException();
        }
        // var_dump($this->getCurrentUser());
        return $this->render('RedwoodWebBundle:Register:success.html.twig', array(
            'user' => $user,
            'hash' => $hash,
            // 'emailLoginUrl' => $this->getEmailLoginUrl($user['email']),
        ));
    }

    public function indexAction(Request $request)
    {

		$form = $this->createForm(new RegisterForm());

		if ($request->isMethod('POST')) 
		{
		   $form->bind($request);
		   if ($form->isValid()) {

				$registration = $form->getData();
				$user = $this->getUserService()->register($registration);
				$this->authenticateUser($user);
				// // $this->sendVerifyEmail($user);
				return $this->redirect($this->generateUrl('register_success', array(
                    'id' => $user['id'], 
                    'hash' => $this->makeHash($user),
                )));
		   }

		}
		return $this->render('RedwoodWebBundle:Register:index.html.twig', array(
			'form' => $form->createView(),
		));
	}

	private function makeHash($user)
    {
        $string = $user['id'] . $user['email'] . $this->container->getParameter('secret');
        return md5($string);
    }

    private function checkHash($userId, $hash)
    {
        $user = $this->getUserService()->getUser($userId);
        if (empty($user)) {
            return false;
        }

        if ($this->makeHash($user) !== $hash) {
            return false;
        }

        return $user;
    }

}
