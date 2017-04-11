<?php

namespace AppBundle\Controller;

use AppBundle\Entity\FactorTippa;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Factortippa controller.
 *
 * @Route("factortippa")
 */
class FactorTippaController extends Controller
{
    /**
     * Lists all factorTippa entities.
     *
     * @Route("/", name="factortippa_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $factorTippas = $em->getRepository('AppBundle:FactorTippa')->findAll();

        return $this->render('factortippa/index.html.twig', array(
            'factorTippas' => $factorTippas,
        ));
    }

    /**
     * Finds and displays a factorTippa entity.
     *
     * @Route("/{id}", name="factortippa_show")
     * @Method("GET")
     */
    public function showAction(FactorTippa $factorTippa)
    {

        return $this->render('factortippa/show.html.twig', array(
            'factorTippa' => $factorTippa,
        ));
    }
}
