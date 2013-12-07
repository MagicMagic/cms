<?php

namespace Cms\CoreBundle\Controller;

use Cms\CoreBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class LoginController extends Controller
{

    public function indexAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        $user = new User();
        $factory  = $this->get('security.encoder_factory');
        $encoder  = $factory->getEncoder($user);
        $password = $encoder->encodePassword('test', $user->getSalt());

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        var_dump($password, $user->getSalt(), $error);

        return $this->render(
            'CmsCoreBundle:Login:admin.html.twig',
            array(
                'error'         => $error,
            )
        );
    }

}
