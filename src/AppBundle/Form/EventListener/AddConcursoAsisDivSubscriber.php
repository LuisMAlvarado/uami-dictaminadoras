<?php
/**
 * Created by PhpStorm.
 * User: LuisM
 * Date: 18/04/2017
 * Time: 05:16 PM
 */

namespace AppBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;




class AddConcursoAsisDivSubscriber implements EventSubscriberInterface
{

    private $em, $security;
    public function __construct($security, $em)
    {
        $this->security = $security;
        $this->em      = $em;

    }



    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::POST_SET_DATA => 'postSetData',
        );

    }

    public function postSetData(FormEvent $event)
    {

        // SE PUEDE USAR PROPIEDADES DE FORM Y "DEJAR FUNCION DE EDIT POR EJEMPLO"
       //$data = $event->getData();
       $form = $event->getForm();
        // POR EJEMPLO PUEDE IR EN EL if($data->getId())

       // if ($this->security->isGranted('ROLE_X'))
       // {
       //     echo 'si lo contien';
       // } else {
       //     echo 'no lo contien';
       // }

        
        if ($this->security->isGranted('ROLE_ASISTENTEDIV')) {

            //$form->add('estatus');
            $form->add('pdfConcurso');
            //$form->add('numConcurso');
                    }

        if ($this->security->isGranted('ROLE_ADMINISTRADOR')){
            $form->add('estatus');
        }

    }

}