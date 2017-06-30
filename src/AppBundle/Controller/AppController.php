<?php

namespace AppBundle\Controller;

use FPDM\FPDM;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Form\UsuarioType;


class AppController extends Controller
{

   


    /**
     * @Route("/homepage", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        $em = $this->getDoctrine()->getManager();
        $usuario=$this->getUser();
        return $this->render('app/index.html.twig',array(
            'usuario' => $usuario,
            ));
    }

    /**
     * @Route("/", name="portada")
     *
     */
    public function portadaAction()
    {

        $em = $this->getDoctrine()->getManager();
        $dato=(new \DateTime());

        $concursop= $em->getRepository('AppBundle:Concurso')->findAllOrderedByFechaV($dato);

        return $this->render('concurso/portada.html.twig', array(
            'concursos' => $concursop,


        ));


    }



    /**
     * @Route("/login", name="login_form")
     */
    public function loginAction()
    {

//	$helper = $this->get('security.authentication_utils');

//	return $this->render('app/login.html.twig', array (
//  'last_username' => $helper->getLastUsername(),
//  'error' => $helper->getLastAuthenticationError(),));
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'app/login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );


    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction()
    {
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
    }



}
