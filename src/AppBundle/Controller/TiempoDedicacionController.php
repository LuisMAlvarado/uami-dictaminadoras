<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TiempoDedicacion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Tiempodedicacion controller.
 *
 * @Route("tiempodedicacion")
 */
class TiempoDedicacionController extends Controller
{
    /**
     * Lists all tiempoDedicacion entities.
     *
     * @Route("/", name="tiempodedicacion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tiempoDedicacions = $em->getRepository('AppBundle:TiempoDedicacion')->findAll();

        return $this->render('tiempodedicacion/index.html.twig', array(
            'tiempoDedicacions' => $tiempoDedicacions,
        ));
    }

    /**
     * Finds and displays a tiempoDedicacion entity.
     *
     * @Route("/{id}", name="tiempodedicacion_show")
     * @Method("GET")
     */
    public function showAction(TiempoDedicacion $tiempoDedicacion)
    {

        return $this->render('tiempodedicacion/show.html.twig', array(
            'tiempoDedicacion' => $tiempoDedicacion,
        ));
    }
}
