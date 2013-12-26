// <?php
 
// namespace Redwood\Service\Common;
 
// use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
// use Symfony\Component\Security\Core\SecurityContext;
// use Redwood\Service\Common\BaseService;
// use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
// use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\Security\Core\Exception\AuthenticationException;
// use Symfony\Component\HttpFoundation\RedirectResponse;


// /**
//  * Custom login listener.
//  */
// class LoginListener extends BaseService implements AuthenticationSuccessHandlerInterface
// {

// 	/**
// 	 * Do the magic.
// 	 * 
// 	 * @param InteractiveLoginEvent $event
// 	 */
// 	public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
// 	{
// 		var_dump("aaaaaaaaaaaaaaa");
// 		$user = $event->getAuthenticationToken()->getUser();
// 		$this->getLogService()->info('登陆模块','用户登陆',"用户登陆成功！");
// 	}

//     public function onAuthenticationSuccess(Request $request, TokenInterface $token)
//     {       
// 		$user = $token->getUser();
// 		$loginInfo = array('loginIp'=>$request->getClientIp(),'loginTime'=> time());
// 		$this->getUserService()->updateLoginInfo($user['id'],$loginInfo);
// 		$this->getLogService()->info('登陆模块','用户登陆',"用户登陆成功！");
// 		if ($request->isXmlHttpRequest()) {
// 			$result = array('success' => true);
// 			return new Response(json_encode($result));
// 		} else {
// 			$referer = $request->headers->get('referer');
// 		if(strpos($referer,'/login')){
// 			$referer =  str_replace('/login','/my',$referer);
// 		}
// 			return new RedirectResponse($referer);
// 		}			
//     }

//     private function getUserService()
//     {
//       	return $this->createService('User.UserService');
//     }

// 	protected function getLogService(){
// 		 return $this->createService('System.LogService');
// 	}    
// }