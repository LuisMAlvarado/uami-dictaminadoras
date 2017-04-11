<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Division;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Division controller.
 *
 * @Route("division")
 */
class DivisionController extends Controller
{
    /**
     * Lists all division entities.
     *
     * @Route("/", name="division_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $divisions = $em->getRepository('AppBundle:Division')->findAll();

        return $this->render('division/index.html.twig', array(
            'divisions' => $divisions,
        ));
    }

    /**
     * Finds and displays a division entity.
     *
     * @Route("/{id}", name="division_show")
     * @Method("GET")
     */
    public function showAction(Division $division)
    {

        return $this->render('division/show.html.twig', array(
            'division' => $division,
        ));
    }
}
