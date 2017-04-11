<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 07/11/2016
 * Time: 10:57 AM
 */

namespace AppBundle\Listener;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;



class LoginListener
{
   private $em, $checker, $router, $eco0rfc =null;
   public function __construct(AuthorizationChecker $checker, Router $router, Doctrine $doctrine)
   {
      $this->checker = $checker;
      $this-> router = $router;
      $this->em      = $doctrine->getManager();

      //$this->em      = $doctrine->getEntityManager();
      // $this->getDoctrine()->getManager();

   }

   public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
   {
      $token = $event->getAuthenticationToken();

      if($this->checker->isGranted('ROLE_ASPIRANTE')){
        $this ->eco0rfc= $token->getUser()->getRfc();

         //se guarda la ultima conexion del ASPIRANTE
         $usuario = $event->getAuthenticationToken()->getUser();
         $usuario->setUltimaConexion(new \DateTime('now'));

         $this->em->persist($usuario);
         $this->em->flush();
      }
      else
      {
         $this->eco0rfc= $token->getUser()->getNumeroEconomico();
      }

   }

   public function onKernelResponse(FilterResponseEvent $event)
   {
      if (null === $this->eco0rfc) {
         return;
      }
      if($this->checker->isGranted('ROLE_ASPIRANTE')){
         $urlLogin = $this ->router->generate('aspirante_aspshow', array(
              'id' => $this->eco0rfc));
      }

      else {
         $urlLogin = $this->router->generate('homepage');
      }
      $event->setResponse(new RedirectResponse($urlLogin));
      $event->stopPropagation();

   }
}