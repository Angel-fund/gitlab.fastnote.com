<?php
namespace Redwood\WebBundle\Controller;

use Symfony\Component\Security\Core\SecurityContext;

class LoginController extends BaseController
{

    public function indexAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $str = 'apiKey=yourApiKey&accessToken=yourAccessToken&redirectUri=port_enterprise_comment_add&content=Z2VocnVnZSUyMCUyNCUyNSUyMyolMjYlMjAlRTUlODUlQUMlRTUlOEYlQjglRTUlQkYlQUIlMjAlRTQlQkMlQkMlRTYlODclODIlRTklOUQlOUUlRTYlODclODIlRTQlQjglODklRTklODAlOUYlRTUlQjAlQjElRTglQjQlQTclMjAlRTUlOEYlOTElRTclQUMlQUMlRTQlQjglODklRTYlOTYlQjklMjAlRUYlQkMlODgqJTI2JUU1JTg4JUIwJUU0JUI4JThEJTIwJUU0JUJCJTk4JUU2JUFDJUJFJTIwJTIzJUVGJUJGJUE1JTI1JUUyJTgwJUE2JUUyJTgwJUE2JTI2KiUyMCUyRiU1Qw&param=dfsfsdfdsfdsfdsf&enterpriseId=11945546';
        // $arr = array(
        //     'apiKey' => '3af667a6e5fc6391f65313322d1e865a0315ce7b',
        //     'accessToken' => 'ea50d58ccdecb2208f93df68dd681c16',
        //     'redirectUri' => 'port_enterprise_comment_add',
        //     'content' => 'Z2VocnVnZSUyMCUyNCUyNSUyMyolMjYlMjAlRTUlODUlQUMlRTUlOEYlQjglRTUlQkYlQUIlMjAlRTQlQkMlQkMlRTYlODclODIlRTklOUQlOUUlRTYlODclODIlRTQlQjglODklRTklODAlOUYlRTUlQjAlQjElRTglQjQlQTclMjAlRTUlOEYlOTElRTclQUMlQUMlRTQlQjglODklRTYlOTYlQjklMjAlRUYlQkMlODgqJTI2JUU1JTg4JUIwJUU0JUI4JThEJTIwJUU0JUJCJTk4JUU2JUFDJUJFJTIwJTIzJUVGJUJGJUE1JTI1JUUyJTgwJUE2JUUyJTgwJUE2JTI2KiUyMCUyRiU1Qw',
        //     'enterpriseId' => '1245173',
        // );
        $pos = null;
        $arr = explode('&', $str);
        foreach ($arr as $key => $value) {
            if(preg_match('/^param=/i',$value)) {
                $pos = $key;
            }
        }
        if (!empty($pos)) {
            var_dump($arr[$pos]);
            unset($arr[$pos]);
            $str = implode('&', $arr);
        }

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('RedwoodWebBundle:Login:index.html.twig',array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }
}