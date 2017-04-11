<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Estatus;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Estatus controller.
 *
 * @Route("estatus")
 */
class EstatusController extends Controller
{
    /**
     * Lists all estatus entities.
     *
     * @Route("/", name="estatus_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $estatuses = $em->getRepository('AppBundle:Estatus')->findAll();

        return $this->render('estatus/index.html.twig', array(
            'estatuses' => $estatuses,
        ));
    }

    /**
     * Finds and displays a estatus entity.
     *
     * @Route("/{id}", name="estatus_show")
     * @Method("GET")
     */
    public function showAction(Estatus $estatus)
    {

        return $this->render('estatus/show.html.twig', array(
            'estatus' => $estatus,
        ));
    }
}
