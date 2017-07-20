<?php
/**
 * Created by PhpStorm.
 * User: LuisM
 * Date: 18/04/2017
 * Time: 05:16 PM
 */

namespace AppBundle\Form\EventListener;
use Symfony\Component\Security\Core\User\UserInterface;

use AppBundle\Entity\Departamento;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;




class AddConcursoAsisDivSubscriber implements EventSubscriberInterface
{

    private $em, $security, $user;
    public function __construct($security, $em, $user)
    {
        $this->security = $security;
        $this->em      = $em;
        $this->user =$user;

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

        $departamentos =array();
        if ($this->security->isGranted('ROLE_ASISTENTEDIV')) {


            $usuario= $this->user->getToken()->getUser();

            $departamentos = $this->em->getRepository('AppBundle:Departamento')->getByDivisionId($usuario->getDivision()->getId());
            //dump($departamentos);exit();
            $form->add('departamento', EntityType::class, array(
                'class' => 'AppBundle\Entity\Departamento',
               'choices' => $departamentos,
                'required'   => true,
                'placeholder' => '',
            ));
            $form->add('pdfConcurso');
            $form->add('fechaPublicacion', DateType::class, array(
                'format' => 'dd-MM-yyyy',
            ));
            //$form->add('numConcurso');
                    }
        if ($this->security->isGranted('ROLE_ASISTENTEDEP')){
            $form->add('departamento', null, array(
                'disabled' => true,
            ));
        }

        if ($this->security->isGranted('ROLE_ADMINISTRADOR')){
            $form->add('estatus');
            $form->add('departamento');
        }

    }

}